import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import fs from 'fs';


const host = 'snippets.testtheweb.page';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        vue({
            template:{
                base: null,
                includeAbsolute: false
            }
        })
    ],
    server: {
        host,
        hmr: { host },
        https: {
            key: fs.readFileSync(`/etc/ssl/testtheweb/private.key`),
            cert: fs.readFileSync(`/etc/ssl/testtheweb/certificate.crt`),
        }
    }
});
