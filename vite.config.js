import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        }
    },
    resolve: {
        alias: {
            '~admin-lte': path.resolve(__dirname, 'node_modules/admin-lte'),
            '~bootstrap-icons': path.resolve(__dirname, 'node_modules/bootstrap-icons'),
            '~icheck-bootstrap': path.resolve(__dirname, 'node_modules/icheck-bootstrap'),
            '~datatables.net-dt': path.resolve(__dirname, 'node_modules/datatables.net-dt'),
            '~datatables.net-bs4': path.resolve(__dirname, 'node_modules/datatables.net-bs4'),
        }
    }
});
