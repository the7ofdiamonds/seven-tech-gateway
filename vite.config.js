import dotenv from 'dotenv';
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import reactRefresh from '@vitejs/plugin-react-refresh';
import BasicSSL from '@vitejs/plugin-basic-ssl';

import generateIndexAssetPHPFile from './generate-index-assets-php.js';

dotenv.config();

export default defineConfig({
    server: {
        port: 3000
    },
    publicDir: false,
    build: {
        watch: {
            exclude: 'node_modules/**',
            include: 'src/**/*'
        },
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
        // BasicSSL({
        //     cert: '/Users/jamellyons/Documents/J_C_LYONS_ENTERPRISES_LLC/THE7OFDIAMONDS.TECH/Development/nginx/ssl/certs/nginx-selfsigned.crt',
        //     key: '/Users/jamellyons/Documents/J_C_LYONS_ENTERPRISES_LLC/THE7OFDIAMONDS.TECH/Development/nginx/ssl/private/nginx-selfsigned.key',
        // }),
        generateIndexAssetPHPFile(),
    ],
    resolve: {
        alias: {
            '/@/': new URL('src/', import.meta.url).pathname + '/',
        },
    },
});
