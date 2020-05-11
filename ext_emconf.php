<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'WECHANGE Integration',
    'description' => 'TYPO3 integration for the WECHANGE platform (https://wechange.de/)',
    'category' => 'plugin',
    'version' => '1.0.1',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => '',
    'clearcacheonload' => 1,
    'author' => 'Jessica Schlierenkamp',
    'author_email' => 'mail@schlierenkamp.de',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.9-10.4.99',
            'php' => '7.4.0-7.4.99'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ]
    ]
];
