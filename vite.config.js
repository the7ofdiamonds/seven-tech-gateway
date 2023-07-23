import dotenv from 'dotenv';
import { defineConfig } from 'vite';

dotenv.config();

export default defineConfig({
    publicDir: false,
    build: {
        assetsDir: '',
        emptyOutDir: true,
        manifest: true,
        outDir: 'JS/React',
        rollupOptions: {
            input: 'src/index.js',
        },
    },
    plugins: [
        {
            name: 'php',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.php')) {
                    server.ws.send({ type: 'full-reload', path: '*' });
                }
            },
        },
    ],
});