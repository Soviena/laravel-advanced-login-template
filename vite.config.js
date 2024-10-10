import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import inject from "@rollup/plugin-inject";
import path from "path"

export default defineConfig({
    plugins: [
        // inject({   // => that should be first under plugins array
        //   $: 'jquery',
        //   jQuery: 'jquery',
        // }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/config.js', 'resources/js/app.js', 'resources/js/jquery.js', 'resources/js/bootstrap.js','resources/js/helpers.js', 'resources/js/menu.js', 'resources/js/apexcharts.js', 'resources/js/dashboards-analytics.js', 'resources/js/main.js', 'resources/js/masonry.js',  'resources/js/perfect-scrollbar.js', 'resources/js/popper.js'],
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
    resolve: {
        alias: {
            '@': '/resources/js',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
});
