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

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        projects {
                            iconIdentifier = wechange-plugin-projects
                            title = LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.projects
                            description = LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.projects.description
                            tt_content_defValues {
                                CType = list
                                list_type = wechange_projects
                            }
                        }
                        map {
                            iconIdentifier = wechange-plugin-map
                            title = LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.map
                            description = LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.map.description
                            tt_content_defValues {
                                CType = list
                                list_type = wechange_map
                            }
                        }
                    }
                    show = *
                }
           }'
        );

        /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Imaging\IconRegistry::class
        );

        foreach (['projects', 'map'] as $plugin) {
            $iconRegistry->registerIcon(
                'wechange-plugin-' . $plugin,
                \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
                ['source' => 'EXT:wechange/Resources/Public/Icons/wechange.png']
            );
        }

        if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['jswechange_projectList']) ||
            !is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['jswechange_projectList'])) {
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['jswechange_projectList'] = [];
        }
    }
);
