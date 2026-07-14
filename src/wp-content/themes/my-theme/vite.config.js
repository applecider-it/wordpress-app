import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: ['src/entrypoints/app.js', 'src/entrypoints/app.css'],
    },
  },
  server: {
    strictPort: true,
    port: 3000,
    origin: 'http://localhost:3000',
  },
});
