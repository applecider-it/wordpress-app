# 設計

## 実装内容

- 独自テーマ
- 独自プラグイン（お問い合わせフォーム）

## 独自テーマで共通処理を管理

### 管理しているもの

- npmを使ったJS、CSS管理
- composerの管理
- 共通のPHP

## 構造

```
wp-content/
  plugins/
    my-plugin/
      src/  プラグインのPHP
      views/  プラグインのview
      my-plugin.php プラグイン管理
  themes/
    my-theme/
      config/ 共通の設定
      resources/ Vite管理ファイル
      shared/ 共通処理
      src/  テーマのPHP
      templates/  テーマのテンプレート
      functions.php テーマ管理
```

## Wordpress側で利用しているツール

- Vite
- Tailwind3
- Vue
- Axios
- Swiper

