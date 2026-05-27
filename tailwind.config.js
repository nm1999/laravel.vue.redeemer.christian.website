import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    primary: '#dc2626',      // Professional red
                    secondary: '#1e40af',    // Accent blue
                    dark: '#0f172a',         // Very dark slate
                    light: '#f8fafc',        // Light background
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'xs': ['0.75rem', { lineHeight: '1rem' }],
                'sm': ['0.875rem', { lineHeight: '1.25rem' }],
                'base': ['1rem', { lineHeight: '1.5rem' }],
                'lg': ['1.125rem', { lineHeight: '1.75rem' }],
                'xl': ['1.25rem', { lineHeight: '1.75rem' }],
                '2xl': ['1.5rem', { lineHeight: '2rem' }],
                '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
                '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
                '5xl': ['3rem', { lineHeight: '1' }],
            },
            spacing: {
                'safe': 'max(1.5rem, env(safe-area-inset-bottom))',
            },
            boxShadow: {
                'sm': '0 1px 2px 0 rgba(15, 23, 42, 0.05)',
                'base': '0 4px 6px -1px rgba(15, 23, 42, 0.1)',
                'md': '0 10px 15px -3px rgba(15, 23, 42, 0.1)',
                'lg': '0 20px 25px -5px rgba(15, 23, 42, 0.1)',
                'xl': '0 25px 50px -12px rgba(15, 23, 42, 0.15)',
                'elevation': '0 8px 16px -3px rgba(15, 23, 42, 0.12), 0 4px 6px -2px rgba(15, 23, 42, 0.05)',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                'fade-in-up': {
                    '0%': { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'slide-left': {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                'gentle-pulse': {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.8' },
                },
            },
            animation: {
                float: 'float 6s ease-in-out infinite',
                'fade-in-up': 'fade-in-up 0.8s ease-out both',
                'slide-left': 'slide-left 22s linear infinite',
                'gentle-pulse': 'gentle-pulse 2s ease-in-out infinite',
            },
        },
    },

    plugins: [forms],
};
