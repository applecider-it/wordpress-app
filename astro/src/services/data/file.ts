import fs from 'node:fs/promises';

/** ファイルの存在チェック */
export async function fileExists(path: string): Promise<boolean> {
  try {
    await fs.access(path);
    return true;
  } catch {
    return false;
  }
}
