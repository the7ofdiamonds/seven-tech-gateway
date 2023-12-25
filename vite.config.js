import dotenv from 'dotenv';
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import reactRefresh from '@vitejs/plugin-react-refresh';
import VitePluginBrowserSync from 'vite-plugin-browser-sync';
import browserSyncConfig from './bs-config.js';

dotenv.config();

export default defineConfig({
    server: {
        proxy: "https://the7ofdiamonds.development",
        hmr: {
            protocol: 'ws',
            host: 'the7ofdiamonds.development',
        },
        watch: {
            usePolling: true,
            interval: 100,
            include: '**/**.jsx', // Move the watch option here
        },
    },
    publicDir: false,
    build: {
        watch: {}, // Remove the watch option from here
        assetsDir: '',
        emptyOutDir: true,
        manifest: true,
        sourcemap: true,
        outDir: 'Assets/JS/dist',
        rollupOptions: {
            input: {
                main: 'src/index.jsx',
            },
            output: {
                format: 'es',
                entryFileNames: '[name].js',
                chunkFileNames: '[name].js',
                assetFileNames: '[name].[ext]',
            },
        },
        esbuild: {
            format: 'esm',
            loader: 'jsx',
        },
    },
    plugins: [
        react(),
        reactRefresh(),
        VitePluginBrowserSync(browserSyncConfig),
    ],
    resolve: {
        alias: {
            '/@/': new URL('src/', import.meta.url).pathname + '/',
        },
    },
});
