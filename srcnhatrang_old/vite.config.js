import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import sassGlob from 'vite-plugin-sass-glob-import';

export default defineConfig({
    plugins: [
        sassGlob(),
        laravel({
            input: [
                'resources/css/app.scss', 
                'resources/js/app.js',
                'resources/css/admin.scss', 
                'resources/js/admin.js'
            ],
            refresh: true,
        }),
    ],
});
