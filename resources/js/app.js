import './bootstrap';

/**************************
 *        Alpine JS      *
 * ***********************/
///// Import Alpine JS
/* */ import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**************************
 *         FilePond       *
 **************************/
/* */ //Import the plugin code
/* */ import * as FilePond from 'filepond';
/* */ // Import the plugin styles
/* */ import 'filepond/dist/filepond.min.css';
/* */ // Import the Image Preview plugin styles
/* */ import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
/* */ // Import the Image Preview plugin styles
/* */ import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

const inputElementTweet = document.querySelector('input[type="file"].filepond--tweet');
const inputElementProfile = document.querySelector('input[type="file"].filepond--profile');
const inputElementBanner = document.querySelector('input[type="file"].filepond--banner');

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.create(inputElementTweet).setOptions({
    server: {
        process: '/uploads/process',
        fetch: null,
        revert: null,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    },
    allowMultiple: true,
    acceptedFileTypes: ["image/*", "video/*"],
});
FilePond.create(inputElementProfile).setOptions({
    server: {
        process: '/uploads/process',
        fetch: null,
        revert: null,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    },
    allowMultiple: false,
    acceptedFileTypes: ["image/*"],
});
FilePond.create(inputElementBanner).setOptions({
    server: {
        process: '/uploads/process',
        fetch: null,
        revert: null,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    },
    allowMultiple: false,
    acceptedFileTypes: ["image/*"],
});

/**************************
 *        Pusher        *
 * ***********************/
///// Import Pusher
/* */ import Pusher from 'pusher-js';
/* */ import Echo from 'laravel-echo';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wsPort: import.meta.env.VITE_PUSHER_PORT,
    wssHost: import.meta.env.VITE_PUSHER_HOST,
    wssPort: import.meta.env.VITE_PUSHER_PORT,
    forceTLS: false,
    enabledTransports: ['ws'],
    disableStats: true,
});
