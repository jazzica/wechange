<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'WECHANGE Integration',
    'description' => 'TYPO3 integration for the WECHANGE platform (https://wechange.de/)',
    'category' => 'plugin',
    'version' => '1.1.0',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => '',
    'clearcacheonload' => 1,
    'author' => 'Jessica Schlierenkamp',
    'author_email' => 'mail@schlierenkamp.de',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.5.99'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ]
    ]
];
