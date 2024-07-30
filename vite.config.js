import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css'
                    ],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    /*
    Important: The alias from vue to vue.esm-bundler.js 
    instructs Vite to use a version of Vue.js that also bundles 
    the compiler which will allow us to write HTML instead of render() functions (thankfully!).
    */
});
