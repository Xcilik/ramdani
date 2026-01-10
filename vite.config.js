import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // TAMBAHKAN BAGIAN INI
    server: {
        cors: true,             // Izinkan akses dari domain manapun (shopiyt.com)
        host: '0.0.0.0',        // Izinkan server diakses dari luar localhost
        hmr: {
            host: 'localhost',  // Paksa HMR connect ke localhost (bukan [::1])
        },
    },
});