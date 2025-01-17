<?php

return [
    /**
     * Default route to see the UML diagram.
     */
    'route' => '/uml',

    /**
     * You can turn on or off the indexing of specific types
     * of classes. By default, LTU processes only controllers
     * and models.
     */
    'casts'         => false,
    'channels'      => false,
    'commands'      => false,
    'components'    => false,
    'controllers'   => true,
    'events'        => false,
    'exceptions'    => false,
    'jobs'          => false,
    'listeners'     => false,
    'mails'         => false,
    'middlewares'   => false,
    'models'        => true,
    'notifications' => false,
    'observers'     => false,
    'policies'      => false,
    'providers'     => false,
    'requests'      => false,
    'resources'     => false,
    'rules'         => false,

    /**
     * You can define specific nomnoml styling.
     * For more information: https://github.com/skanaar/nomnoml
     */
    'style' => [
        'background' => '#ffff',
        'stroke'     => '#000000',
        'arrowSize'  => 1,
        'bendSize'   => 0.3,
        'direction'  => 'right',
        'gutter'     => 5,
        'edgeMargin' => 0,
        'gravity'    => 5,
        'edgeMargin'  => 15,
        'edges'      => 'rounded',
        'fill'       => '#ffff',
        'fillArrows' => false,
        'font'       => 'Calibri',
        'fontSize'   => 14,
        'leading'    => 1.25,
        'lineWidth'  => 0.5,
        'padding'    => 8,
        'spacing'    => 40,
        'title'      => 'Filename',
        'zoom'       => 1,
        'acyclicer'  => 'greedy',
        'ranker'     => 'longest-path'
    ],

    // 'style' => [
    //     // Warna latar belakang diagram
    //     'background'  => '#F4F4F4',

    //     // Warna garis tepi node dan edge
    //     'stroke'      => '#333333',

    //     // Ukuran panah pada edge
    //     'arrowSize'   => 1.5,

    //     // Ukuran lengkungan panah
    //     'bendSize'    => 0.4,

    //     // Arah layout diagram: 'right', 'left', 'up', 'down'
    //     'direction'   => 'down',

    //     // Jarak antar elemen dalam node
    //     'gutter'      => 10,

    //     // Margin tepi antar edge
    //     'edgeMargin'  => 10,

    //     // Pengaruh gravitasi pada layout
    //     'gravity'     => 0.8,

    //     // Tipe garis edge: 'normal', 'dashed', 'dotted', 'rounded'
    //     'edges'       => 'dotted',

    //     // Warna isi node
    //     'fill'        => '#FFFFFF',

    //     // Apakah panah diisi warna
    //     'fillArrows'  => false,

    //     // Jenis font yang digunakan
    //     'font'        => 'Arial',

    //     // Ukuran font dalam node
    //     'fontSize'    => 14,

    //     // Spasi antar baris dalam teks node
    //     'leading'     => 1.5,

    //     // Ketebalan garis
    //     'lineWidth'   => 1,

    //     // Padding dalam node
    //     'padding'     => 10,

    //     // Jarak antar node
    //     'spacing'     => 60,

    //     // Judul diagram
    //     'title'       => 'UML Diagram',

    //     // Tingkat zoom awal
    //     'zoom'        => 1,

    //     // Metode pengurutan node untuk menghindari siklus
    //     'acyclicer'   => 'greedy',

    //     // Metode peringkat node: 'global', 'local', 'longest-path'
    //     'ranker'      => 'global',
    // ],
    /**
     * Specific files can be excluded if need be.
     * By default, all default Laravel classes are ignored.
     */
    'excludeFiles' => [
        'Http/Kernel.php',
        'Console/Kernel.php',
        'Exceptions/Handler.php',
        'Http/Controllers/Controller.php',
        'Http/Middleware/Authenticate.php',
        'Http/Middleware/EncryptCookies.php',
        'Http/Middleware/PreventRequestsDuringMaintenance.php',
        'Http/Middleware/RedirectIfAuthenticated.php',
        'Http/Middleware/TrimStrings.php',
        'Http/Middleware/TrustHosts.php',
        'Http/Middleware/TrustProxies.php',
        'Http/Middleware/VerifyCsrfToken.php',
        'Providers/AppServiceProvider.php',
        'Providers/AuthServiceProvider.php',
        'Providers/BroadcastServiceProvider.php',
        'Providers/EventServiceProvider.php',
        'Providers/RouteServiceProvider.php',
    ],

    /**
     * In case you changed any of the default directories
     * for different classes, please amend below.
     */
    'directories' => [
        'casts'         => 'Casts/',
        'channels'      => 'Broadcasting/',
        'commands'      => 'Console/Commands/',
        'components'    => 'View/Components/',
        'controllers'   => 'Http/Controllers/',
        'events'        => 'Events/',
        'exceptions'    => 'Exceptions/',
        'jobs'          => 'Jobs/',
        'listeners'     => 'Listeners/',
        'mails'         => 'Mail/',
        'middlewares'   => 'Http/Middleware/',
        'models'        => 'Models/',
        'notifications' => 'Notifications/',
        'observers'     => 'Observers/',
        'policies'      => 'Policies/',
        'providers'     => 'Providers/',
        'requests'      => 'Http/Requests/',
        'resources'     => 'Http/Resources/',
        'rules'         => 'Rules/',
    ],
];