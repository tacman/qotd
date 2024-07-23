<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@symfony/ux-live-component' => [
        'path' => './vendor/symfony/ux-live-component/assets/dist/live_controller.js',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    'chart.js/auto' => [
        'version' => '4.4.3',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.5',
    ],
    'stimulus-carousel' => [
        'version' => '5.0.1',
    ],
    'swiper/bundle' => [
        'version' => '11.1.5',
    ],
    'ssr-window' => [
        'version' => '4.0.2',
    ],
    'dom7' => [
        'version' => '4.0.6',
    ],
    'bootstrap' => [
        'version' => '5.3.3',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.3',
        'type' => 'css',
    ],
    'bootstrap-icons/font/bootstrap-icons.css' => [
        'version' => '1.11.3',
        'type' => 'css',
    ],
    'swiper/swiper-bundle.min.css' => [
        'version' => '11.1.5',
        'type' => 'css',
    ],
    'turbo-view-transitions' => [
        'version' => '0.3.0',
    ],
    'workbox-window' => [
        'version' => '7.1.0',
    ],
    '@kurkle/color' => [
        'version' => '0.3.2',
    ],
    'chart.js' => [
        'version' => '4.4.3',
    ],
];
