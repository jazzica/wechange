<?php

defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'wechange',
    'Configuration/TypoScript',
    'Settings for the WECHANGE (required)'
);
