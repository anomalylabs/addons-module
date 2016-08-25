<?php

return [
    'modules'     => [
        'name'     => 'Modules',
        'option'   => [
            'read'      => 'Peut accèder aux modules ?',
            'install'   => 'Peut installer des modules ?',
            'uninstall' => 'Peut désinstaller mes modules ?',
            'disable'   => 'Peut désactiver les modules ?',
            'delete'    => 'Peut supprimer les modules ?',
        ],
    ],
    'themes'      => [
        'name'   => 'Thèmes',
        'option' => [
            'read'   => 'Peut accèder aux thèmes ?',
            'delete' => 'Peut supprimer les thèmes ?',
        ],
    ],
    'plugins'     => [
        'name'   => 'Plugins',
        'option' => [
            'read'   => 'Peut accèder aux plugins ?',
            'delete' => 'Peut supprimer les plugins ?',
        ],
    ],
    'extensions'  => [
        'name'     => 'Extensions',
        'option'   => [
            'read'      => 'Peut accèder aux extensions ?',
            'install'   => 'Peut installer des extensions ?',
            'uninstall' => 'Peut désinstaller des extensions ?',
            'disable'   => 'Peut désactiver les extensions ?',
            'delete'    => 'Peut supprimer les extensions ?',
        ],
    ],
    'field_types' => [
        'name'   => 'Types de champs',
        'option' => [
            'read'   => 'Peut accèder aux types de champs ?',
            'delete' => 'Peut supprimer les types de champs ?',
        ],
    ],
];
