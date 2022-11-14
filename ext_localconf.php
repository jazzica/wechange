<?php

defined('TYPO3_MODE') || die();
call_user_func(
    static function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wechange',
            'Projects',
            [
                \JS\Wechange\Controller\ProjectController::class => 'list'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wechange',
            'Events',
            [
                \JS\Wechange\Controller\EventController::class => 'list'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wechange',
            'Map',
            [
                \JS\Wechange\Controller\MapController::class => 'show'
            ]
        );

        /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Imaging\IconRegistry::class
        );
        $iconRegistry->registerIcon(
            'wechange-plugin',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:wechange/Resources/Public/Icons/wechange.png']
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:wechange/Configuration/TsConfig/All.tsconfig">'
        );

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['wechange_apirequests'] ??= [];
    }
);
