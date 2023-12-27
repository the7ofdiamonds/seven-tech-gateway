import babel from '@rollup/plugin-babel';

const rollupConfig = {
    input: './src/index.jsx',
    output: {
        dir: 'Assets/JS/dist',
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
    },
    plugins: [babel({ babelHelpers: 'bundled' })],
};

export default rollupConfig;
