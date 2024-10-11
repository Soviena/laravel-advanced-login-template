import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    resolve: {
        alias: {
            '@': '/resources/js',
            // '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/jquery.js', 'resources/js/app.js', 'resources/js/bootstrap.js','resources/js/helpers.js', 'resources/js/menu.js', 'resources/js/apexcharts.js', 'resources/js/dashboards-analytics.js', 'resources/js/main.js', 'resources/js/masonry.js',  'resources/js/perfect-scrollbar.js', 'resources/js/popper.js'],
            refresh: true,
        }),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        },
    ],
    // build: {
    //     rollupOptions: {
    //         external: ['jquery'],
    //         output: {
    //             jquery: "$"
    //         }
    //     }
    // }

});
