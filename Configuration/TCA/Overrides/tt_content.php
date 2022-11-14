<?php

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Wechange',
    'Projects',
    'LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.projects'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['wechange_projects'] =
    'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['wechange_projects'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'wechange_projects',
    'FILE:EXT:wechange/Configuration/FlexForms/flexform_projects.xml'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Wechange',
    'Events',
    'LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.events'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['wechange_events'] =
    'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['wechange_events'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'wechange_events',
    'FILE:EXT:wechange/Configuration/FlexForms/flexform_events.xml'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Wechange',
    'Map',
    'LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.map'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['wechange_map'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['wechange_map'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'wechange_map',
    'FILE:EXT:wechange/Configuration/FlexForms/flexform_map.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['wechange_map'] =
    'recursive,select_key,pages';
