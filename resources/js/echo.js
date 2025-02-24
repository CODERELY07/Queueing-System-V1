import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
// Test
// console.log('Reverb Key:', import.meta.env.VITE_REVERB_APP_KEY);
// console.log('Reverb Host:', import.meta.env.VITE_REVERB_HOST);
// console.log('Reverb Port:', import.meta.env.VITE_REVERB_PORT);


