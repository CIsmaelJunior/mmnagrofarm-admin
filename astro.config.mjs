// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';

// https://astro.build/config
export default defineConfig({
  site: 'https://mmbagrofarm.com',
  integrations: [],

  // Configuration pour l'intégration avec Laravel
  output: 'static',
  outDir: './dist',
  base: '/',

  vite: {
    plugins: [tailwindcss()],
    ssr: {
      external: ['svgo'],
    },
    server: {
      proxy: {
        // Proxy vers l'API Laravel
        '/api': {
          target: 'http://localhost:8000',
          changeOrigin: true,
          secure: false
        }
      }
    }
  },
  build: {
    inlineStylesheets: 'auto',
  },
});
