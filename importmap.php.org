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
    '@C3/app' => [
        'path' => './vendor/chapter-three-company/c3-bundle/assets/app.js',
        'entrypoint' => true,
    ],
    '@fortawesome/fontawesome-free' => [
        'version' => '5.7.2',
    ],
    'bootstrap' => [
        'version' => '4.2.1',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '4.2.1',
        'type' => 'css',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'popper.js' => [
        'version' => '1.16.1',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'bootstrap-colorpicker' => [
        'version' => '3.0.3',
    ],
    'jsdom' => [
        'version' => '24.0.0',
    ],
    'xmlhttprequest' => [
        'version' => '1.8.0',
    ],
    'location' => [
        'version' => '0.0.1',
    ],
    'navigator' => [
        'version' => '1.0.1',
    ],
    'bootstrap-daterangepicker' => [
        'version' => '3.0.3',
    ],
    'bootstrap-daterangepicker/daterangepicker.min.css' => [
        'version' => '3.0.3',
        'type' => 'css',
    ],
    'moment' => [
        'version' => '2.24.0',
    ],
    'bootstrap-social' => [
        'version' => '5.1.1',
    ],
    'bootstrap-social/bootstrap-social.min.css' => [
        'version' => '5.1.1',
        'type' => 'css',
    ],
    'bootstrap-tagsinput' => [
        'version' => '0.7.1',
    ],
    'bootstrap-timepicker' => [
        'version' => '0.5.2',
    ],
    'chart.js' => [
        'version' => '2.7.3',
    ],
    'chartjs-color' => [
        'version' => '2.4.1',
    ],
    'chartjs-color-string' => [
        'version' => '0.6.0',
    ],
    'color-convert' => [
        'version' => '1.9.3',
    ],
    'color-name' => [
        'version' => '1.1.4',
    ],
    'chocolat' => [
        'version' => '0.4.21',
    ],
    'cleave.js' => [
        'version' => '1.4.7',
    ],
    'codemirror' => [
        'version' => '5.43.0',
    ],
    'codemirror/lib/codemirror.min.css' => [
        'version' => '5.43.0',
        'type' => 'css',
    ],
    'datatables' => [
        'version' => '1.10.18',
    ],
    'datatables.net-responsive-bs4' => [
        'version' => '2.2.3',
    ],
    'datatables.net-bs4' => [
        'version' => '1.13.11',
    ],
    'datatables.net-responsive' => [
        'version' => '2.2.3',
    ],
    'datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css' => [
        'version' => '2.2.3',
        'type' => 'css',
    ],
    'datatables.net' => [
        'version' => '1.13.10',
    ],
    'datatables.net-bs4/css/dataTables.bootstrap4.min.css' => [
        'version' => '1.13.11',
        'type' => 'css',
    ],
    'datatables.net-select-bs4' => [
        'version' => '1.2.7',
    ],
    'datatables.net-select' => [
        'version' => '1.2.7',
    ],
    'datatables.net-select-bs4/css/select.bootstrap4.min.css' => [
        'version' => '1.2.7',
        'type' => 'css',
    ],
    'dropzone' => [
        'version' => '5.5.1',
    ],
    'flag-icon' => [
        'version' => '2.5.0',
    ],
    '@polymer/polymer/polymer-legacy.js' => [
        'version' => '3.5.1',
    ],
    '@polymer/iron-image/iron-image.js' => [
        'version' => '3.0.2',
    ],
    '@polymer/iron-flex-layout/iron-flex-layout.js' => [
        'version' => '3.0.1',
    ],
    '@polymer/polymer/lib/legacy/polymer-fn.js' => [
        'version' => '3.5.1',
    ],
    '@polymer/polymer/lib/legacy/polymer.dom.js' => [
        'version' => '3.5.1',
    ],
    '@webcomponents/shadycss/entrypoints/apply-shim.js' => [
        'version' => '1.11.2',
    ],
    '@webcomponents/shadycss/entrypoints/custom-style-interface.js' => [
        'version' => '1.11.2',
    ],
    '@polymer/polymer/lib/utils/html-tag.js' => [
        'version' => '3.5.1',
    ],
    '@polymer/polymer/lib/utils/resolve-url.js' => [
        'version' => '3.5.1',
    ],
    'fullcalendar' => [
        'version' => '3.10.0',
    ],
    'gmaps' => [
        'version' => '0.4.24',
    ],
    'izitoast' => [
        'version' => '1.4.0',
    ],
    'jquery.nicescroll' => [
        'version' => '3.7.6',
    ],
    'nicescroll' => [
        'version' => '3.7.4',
    ],
    'owl.carousel' => [
        'version' => '2.3.4',
    ],
    'owl.carousel/dist/assets/owl.carousel.min.css' => [
        'version' => '2.3.4',
        'type' => 'css',
    ],
    'perfect-scrollbar' => [
        'version' => '1.4.0',
    ],
    'perfect-scrollbar/css/perfect-scrollbar.min.css' => [
        'version' => '1.4.0',
        'type' => 'css',
    ],
    'prismjs' => [
        'version' => '1.15.0',
    ],
    'prismjs/themes/prism.min.css' => [
        'version' => '1.15.0',
        'type' => 'css',
    ],
    'select2' => [
        'version' => '4.0.6-rc.1',
    ],
    'select2/dist/css/select2.min.css' => [
        'version' => '4.0.6-rc.1',
        'type' => 'css',
    ],
    'selectric' => [
        'version' => '1.13.0',
    ],
    'simpleweather' => [
        'version' => '3.1.0',
    ],
    'summernote' => [
        'version' => '0.8.11',
    ],
    'sweetalert' => [
        'version' => '2.1.2',
    ],
    'tooltip.js' => [
        'version' => '1.3.1',
    ],
    '@fortawesome/fontawesome-free/css/all.min.css' => [
        'version' => '6.5.1',
        'type' => 'css',
    ],
    'summernote/dist/summernote-bs4.css' => [
        'version' => '0.8.20',
        'type' => 'css',
    ],
    'lodash' => [
        'version' => '4.17.21',
    ],
    'bootstrap-datepicker' => [
        'version' => '1.10.0',
    ],
    'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' => [
        'version' => '1.10.0',
        'type' => 'css',
    ],
    'bootstrap-datepicker/dist/locales/bootstrap-datepicker.ja.min.js' => [
        'version' => '1.10.0',
    ],
];
