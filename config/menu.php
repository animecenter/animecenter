<?php

return [
    'admin' => [
        'Anime' => [
            'name'               => 'Animes', 'slug' => 'animes', 'submenu' => [
                'Classification' => [
                    'name' => 'Classifications', 'slug' => 'classifications',
                ],
                'Episode' => [
                    'name' => 'Episodes', 'slug' => 'episodes',
                ],
                'Genre' => [
                    'name' => 'Genres', 'slug' => 'genres',
                ],
                'Producer' => [
                    'name' => 'Producers', 'slug' => 'producers',
                ],
                'Status' => [
                    'name' => 'Statuses', 'slug' => 'statuses',
                ],
                'Relation' => [
                    'name' => 'Relations', 'slug' => 'relations',
                ],
                'Relationship' => [
                    'name' => 'Relationships', 'slug' => 'relationships',
                ],
                'Title' => [
                    'name' => 'Titles', 'slug' => 'titles',
                ],
                'Type' => [
                    'name' => 'Types', 'slug' => 'types',
                ],
            ],
        ],
        'Banner' => [
            'name' => 'Banners', 'slug' => 'banners',
        ],
        'Image' => [
            'name' => 'Images', 'slug' => 'images',
        ],
        'Menu' => [
            'name' => 'Menus', 'slug' => 'menus',
        ],
        'Meta' => [
            'name' => 'Metas', 'slug' => 'metas',
        ],
        'Mirror' => [
            'name'             => 'Mirrors', 'slug' => 'mirrors', 'submenu' => [
                'MirrorReport' => [
                    'name' => 'Reports', 'slug' => 'mirror-reports',
                ],
                'MirrorSource' => [
                    'name' => 'Sources', 'slug' => 'mirror-sources',
                ],
            ],
        ],
        'Option' => [
            'name' => 'Options', 'slug' => 'options',
        ],
        'Page' => [
            'name' => 'Pages', 'slug' => 'pages',
        ],
        'User' => [
            'name'           => 'Users', 'slug' => 'users', 'submenu' => [
                'Permission' => [
                    'name' => 'Permissions', 'slug' => 'permissions',
                ],
                'Role' => [
                    'name' => 'Roles', 'slug' => 'roles',
                ],
            ],
        ],
    ],
];
