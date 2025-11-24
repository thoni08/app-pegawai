import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';
import flowbiteReact from "flowbite-react/plugin/vite";

export default defineConfig({
    plugins: [laravel({
        input: ['resources/ts/app.tsx'],
        refresh: true,
    }), react(), tailwindcss(), flowbiteReact()],
    resolve: {
        alias: {
            '@': '/resources/ts'
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['react', 'react-dom']
                }
            }
        }
    }
});