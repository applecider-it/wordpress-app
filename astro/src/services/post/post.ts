import type { Post } from '@/types/types';

const baseUrl = 'http://localhost:8080/wp-json/wp/v2'

/** 記事一覧取得 */
export async function getPosts() {
  try {
    const response = await fetch(baseUrl + '/posts?per_page=100');

    if (!response.ok) {
      throw new Error(`HTTP Error: ${response.status}`);
    }

    const posts: Post[] = await response.json();

    console.log(posts, posts.length);
    return posts;
  } catch (error) {
    console.error('取得失敗:', error);
    throw error;
  }
}
