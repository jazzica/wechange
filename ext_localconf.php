<?php
defined('TYPO3_MODE') || die();
call_user_func(
    static function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JS.Wechange',
            'Projects',
            [
                'Project' => 'list'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JS.Wechange',
            'Map',
            [
                'Map' => 'show'
            ]
        );
    }
);
