import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import reactRefresh from '@vitejs/plugin-react-refresh';

import rollupConfig from './rollup.config.js';

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
            include: ['src/**/*.jsx', 'src/**/*.js'],
            exclude: ['**/*.html']
        },
    },
    publicDir: false,
    build: {
        assetsDir: '',
        manifest: true,
        sourcemap: true,
        emptyOutDir: true,
        outDir: 'Assets/JS/dist',
        target: 'es2015',
        input: './src/index.jsx',
        rollupOptions: rollupConfig,
    },
    plugins: [
        react(),
        reactRefresh(),
    ],
    resolve: {
        alias: {
            '/@/': new URL('src/', import.meta.url).pathname + '/',
        },
    },
});
