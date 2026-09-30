import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  plugins: [vue()],
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: [
        // JS
        'resources/js/entrypoints/app.js',
        'resources/js/entrypoints/slideshow.js',
        'resources/js/entrypoints/contact-form.js',

        // CSS
        'resources/css/app.css',
      ],
    },
  },
  server: {
    strictPort: true,
    port: 8081,
    origin: 'http://localhost:8081',
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
});
