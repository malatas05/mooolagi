import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';

document.addEventListener('DOMContentLoaded', () => {
    const galleryLightbox = new PhotoSwipeLightbox({
        gallery: '.pswp-gallery',
        children: 'a',
        wheelToZoom: true,
        pswpModule: () => import('photoswipe'),
    });
    galleryLightbox.init();

    const contentLightbox = new PhotoSwipeLightbox({
        gallery: '.prose',
        children: 'img',
        wheelToZoom: true,
        pswpModule: () => import('photoswipe'),
    });
    contentLightbox.init();
});