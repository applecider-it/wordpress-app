import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: [
        // JS
        'resources/js/entrypoints/app.js',
        'resources/js/entrypoints/contact-form.js',

        // CSS
        'resources/css/app.css',
      ],
    },
  },
  server: {
    strictPort: true,
    port: 3000,
    origin: 'http://localhost:3000',
  },
});
