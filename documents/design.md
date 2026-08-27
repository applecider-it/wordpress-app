# 設計

独自テーマ、独自プラグインは２つで１つ。

独自テーマでプラグインもすべて管理。

構造は、Laravelに寄せています。

かなり、一般的なアプリケーションに寄せたので、ある程度までは、普通の実装ができるかも。

ただし、wordpressで作りこむのは非推奨。

## 実装内容

- Tailwindを使ったテーマ
- お問い合わせフォーム

## 構造

```
wp-content/
  plugins/
    my-plugin/
      my-plugin.php プラグインブートストラップ
  themes/
    my-theme/
      app/  PHP
      bootstrap/
      config/ 設定
      resources/
      functions.php テーマブートストラップ
```

## Wordpress側で利用しているツール

- Vite
- Tailwind3
- Vue
- Axios
- Swiper

