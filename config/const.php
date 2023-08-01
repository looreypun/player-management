<?php

return [
    'position' => [
        'Leader' => 1,
        'Manager' => 2,
        'Sponsor' => 3,
    ],
    'cards' => [
        [
            'icon' => 'fas fa-signature',
            'subtitle' => 'LEADERS',
            'number' => 0,
            'stats' => 'For this Week',
            'bg_color' => 'bg-dark',
        ],
        [
            'icon' => 'fas fa-user-cog',
            'subtitle' => 'MANAGERS',
            'number' => 0,
            'stats' => 'For this Month',
            'bg_color' => 'bg-info',
        ],
        [
            'icon' => 'fas fa-donate',
            'subtitle' => 'SPONSERS',
            'number' => 0,
            'stats' => 'For this Month',
            'bg_color' => 'bg-secondary',
        ],
        [
            'icon' => 'fas fa-users',
            'subtitle' => 'TOTAL USERS',
            'number' => 0,
            'stats' => 'For this week',
            'bg_color' => 'bg-danger',
        ],
    ],
    'charts' => [
        [
            'title' => 'Contribution',
            'description' => 'Current year contribution data',
            'chart_id' => 'contribution',
        ],
        [
            'title' => 'Position Overview',
            'description' => 'Current year position data',
            'chart_id' => 'position',
        ],
    ],
    'pages' => [
        [
            'page_name' => '/about.html',
            'visitors' => '8,340',
        ],
        [
            'page_name' => '/special-promo.html',
            'visitors' => '7,280',
        ],
        [
            'page_name' => '/products.html',
            'visitors' => '6,210',
        ],
        [
            'page_name' => '/documentation.html',
            'visitors' => '5,176',
        ],
        [
            'page_name' => '/customer-support.html',
            'visitors' => '4,276',
        ],
        [
            'page_name' => '/index.html',
            'visitors' => '3,176',
        ],
        [
            'page_name' => '/products-pricing.html',
            'visitors' => '2,176',
        ],
        [
            'page_name' => '/product-features.html',
            'visitors' => '1,886',
        ],
        [
            'page_name' => '/contact-us.html',
            'visitors' => '1,509',
        ],
        [
            'page_name' => '/terms-and-condition.html',
            'visitors' => '1,100',
        ],
    ]
];
