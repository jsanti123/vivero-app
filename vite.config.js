import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/home/showHome.css',
                'resources/js/home/showHome.js',
                'resources/css/finca/showFinca.css',
                'resources/js/finca/showFinca.js',
            ],
            refresh: true,
        }),
    ],
});
