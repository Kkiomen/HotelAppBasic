import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
    server: {
        host: '54.38.55.58', // lub inny adres IP, np. '192.168.1.10'
        port: 5175,
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [...refreshPaths, 'app/Http/Livewire/**'],
        }),
    ],
})
