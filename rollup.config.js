import babel from '@rollup/plugin-babel';

const rollupConfig = {
    output: {
        dir: 'Assets/JS/dist',
        format: 'es',
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
        cssCodeSplit: true,
        css: {
            input: 'Assets/CSS',
            outDir: 'Assets/CSS/dist',
        },
    },
    plugins: [babel({ babelHelpers: 'bundled' })],
};

export default rollupConfig;
