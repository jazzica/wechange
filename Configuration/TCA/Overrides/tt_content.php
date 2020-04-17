<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JS.Wechange',
    'Projects',
    'LLL:EXT:wechange/Resources/Private/Language/locallang_db.xlf:plugin.projects'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['wechange_projects'] = 'recursive,select_key,pages';