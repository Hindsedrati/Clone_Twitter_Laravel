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

const inputElement = document.querySelector('input[type="file"].filepond');
 
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.create(inputElement).setOptions({
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
