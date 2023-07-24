import dotenv from 'dotenv';
import { defineConfig } from 'vite';
import babel from '@rollup/plugin-babel';
import react from '@vitejs/plugin-react';

dotenv.config();

export default defineConfig({
    publicDir: false,
    build: {
        assetsDir: '',
        emptyOutDir: true,
        manifest: true,
        outDir: 'build',
        rollupOptions: {
            input: {
                main: 'src/index.js',
            }
        },
    },
    plugins: [
        babel({
            "presets": ["@babel/preset-env", "@babel/preset-react"]
          }
          ),
        react(),
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