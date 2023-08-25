import './bootstrap';

// FilePond
/* */ //Import the plugin code
/* */ import * as FilePond from 'filepond';
/* */ // Import the plugin styles
/* */ import 'filepond/dist/filepond.min.css';
/* */ // Import the Image Preview plugin styles
/* */ import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
/* */ // Import the Image Preview plugin styles
/* */ import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
// Import Alpine JS
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

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
