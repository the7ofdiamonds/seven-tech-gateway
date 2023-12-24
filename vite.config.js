import dotenv from 'dotenv';
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import reactRefresh from '@vitejs/plugin-react-refresh';
import VitePluginBrowserSync from 'vite-plugin-browser-sync'

import generateIndexAssetPHPFile from './generate-index-assets-php.js';

dotenv.config();

export default defineConfig({
    publicDir: false,
    build: {
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
                format: 'esm',
                entryFileNames: '[name].js',
                chunkFileNames: '[name].js',
                assetFileNames: '[name].[ext]',
            },
        },
        esbuild: {
            loader: 'jsx',
        },
    },
    babel: {
        configFile: '.babelrc',
    },
    plugins: [
        react(),
        reactRefresh(),
        {
            name: 'php',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.php')) {
                    server.ws.send({ type: 'full-reload', path: '*' });
                }
            },
        },
        // VitePluginBrowserSync({
        //     watch: true,
        //     cors: true,
        //     proxy: 'https://https://the7ofdiamonds.development',
        // }),
        generateIndexAssetPHPFile(),
    ],
    resolve: {
        alias: {
            '/@/': new URL('src/', import.meta.url).pathname + '/',
        },
    },
});