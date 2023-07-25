import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  root: 'resources',
  plugins: [vue()],
  resolve: {
    alias: {
      'laravel-nova': path.join(
        __dirname,
        'vendor/laravel/nova/resources/js/mixins/packages.js'
      ),
      '@': path.resolve(__dirname, 'resources/js'),
      '@root': path.resolve(__dirname),
      '@css': path.resolve(__dirname, 'resources/css'),
    },
  },
  define: {
    'process.env': process.env,
  },
  build: {
    outDir: path.resolve(__dirname, 'dist'),
    emptyOutDir: true,
    manifest: true,
    sourcemap: true,
    target: 'es2020',
    minify: true,
    lib: {
      entry: path.resolve(__dirname, 'resources/js/field.ts'),
      name: 'field',
      formats: ['umd'],
      fileName: 'js/field',
    },
    rollupOptions: {
      input: path.resolve(__dirname, 'resources/js/field.ts'),
      external: [
        'vue',
        '@inertiajs/inertia',
        '@inertiajs/inertia-vue3',
        'nova',
        'laravel-nova',
      ],
      output: {
        exports: 'named',
        globals: {
          vue: 'Vue',
          nova: 'Nova',
          'laravel-nova': 'LaravelNova',
        },
        entryFileNames: 'js/field.js',
        assetFileNames: 'css/field.css',
      },
    },
  },
});
