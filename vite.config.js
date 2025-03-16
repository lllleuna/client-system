import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/address-dropdown.js',
                'resources/js/modal.js',
		'resources/js/app.js',
		'resources/js/file-upload.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        manifestFileName: 'manifest.json', // Important!
        emptyOutDir: true,
        rollupOptions: {
            input: [
                'resources/css/app.css',
		'resources/js/file-upload.js',
                'resources/js/address-dropdown.js',
                'resources/js/modal.js',
		'resources/js/app.js'
            ],
        },
    },
});

