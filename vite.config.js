import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'),
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@/assets/scss/_variables.scss";`
            }
        }
    },
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            input: resolve(__dirname, 'resources/js/app.js'), // Verifique se o caminho está correto
        },
    },
});
