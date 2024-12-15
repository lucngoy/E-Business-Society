import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Écouter les notifications
window.Echo.private(`App.Models.User.${userId}`) // Remplacez userId par l'ID de l'utilisateur connecté
    .notification((notification) => {
        console.log(notification.message); // Affichez ou mettez à jour l'interface
    });
