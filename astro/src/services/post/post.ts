import { createHash } from 'node:crypto';
import path from 'node:path';
import fs from 'node:fs/promises';

import pLimit from 'p-limit';

import { fileExists } from '@/services/data/file';
import { sleep } from '@/services/system/time';

import type { Post } from '@/types/types';
import * as cheerio from 'cheerio';

const baseUrl = 'http://localhost:8080/wp-json/wp/v2';

/** 記事一覧取得 */
export async function getPosts(forceDownload = false) {
  try {
    const response = await fetch(baseUrl + '/posts?per_page=100');

    if (!response.ok) {
      throw new Error(`HTTP Error: ${response.status}`);
    }

    const posts: Post[] = await response.json();

    console.log('posts.length', posts.length);

    const convertedPosts: Post[] = await convertPosts(posts, forceDownload);

    console.log('end convert');

    return convertedPosts;
  } catch (error) {
    console.error('取得失敗:', error);
    throw error;
  }
}

/** 画像変換 */
async function convertPosts(posts: Post[], forceDownload: boolean) {
  // 並列数を制限
  const limit = pLimit(5);

  return Promise.all(
    posts.map((post) =>
      limit(async () => {
        const $ = cheerio.load(post.content.rendered);

        console.log('convertPost', post.title.rendered)

        const images = $('img').toArray();

        for (const img of images) {
          const src = $(img).attr('src');
          if (!src) continue;

          const outputUri = await downloadImage(src, forceDownload);

          $(img).attr('src', outputUri);

          // 不要アトリビュート削除
          $(img).removeAttr('srcset');
          $(img).removeAttr('sizes');
        }

        post.content.rendered = $.html();

        //await sleep(1000);  // pLimit動作確認用

        return post;
      }),
    ),
  );
}

/** 画像ダウンロード */
async function downloadImage(imageUrl: string, forceDownload: boolean) {
  const pathname = new URL(imageUrl).pathname;
  const filename = pathname.split('/').pop()!;
  const hash = createHash('sha256').update(imageUrl).digest('hex');
  const savedFilename = hash + '__' + filename;
  const outputPath = path.join(
    process.cwd(),
    'public',
    'content-images',
    savedFilename,
  );

  if (!(await fileExists(outputPath)) || forceDownload) {
    console.log('画像をダウンロード', { imageUrl, outputPath });

    const response = await fetch(imageUrl);

    if (!response.ok) {
      throw new Error(`Failed to download: ${response.status}`);
    }

    const buffer = Buffer.from(await response.arrayBuffer());

    await fs.writeFile(outputPath, buffer);
  }

  const stat = await fs.stat(outputPath);

  const outputUri =
    path.join('/', 'content-images', savedFilename) + '?' + stat.mtimeMs;

  return outputUri;
}
