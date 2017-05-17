<?php
return array(
    'components'=>array(
        //Database of Magento1
        'mage1' => array(
            'connectionString' => 'mysql:host=localhost;dbname=cortecle_magento',
            'emulatePrepare' => true,
            'username' => 'cortecle_magento',
            'password' => 'LeapsEnsignPromAtrium',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'class' => 'CDbConnection'
        ),
        //Database of Magento2 beta
        'mage2' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=cortecle_mg_cleaner',
            'emulatePrepare' => true,
            'username' => 'cortecle_cleaner',
            'password' => 'SnazzyJoyousHawkLoaned88',
            'charset' => 'utf8',
            'tablePrefix' => 'mg_',
            'class' => 'CDbConnection'
        )
    ),

    'import'=>array(
        //This can change for your magento1 version if needed
        //'application.models.db.mage19x.*',
        'application.models.db.mage19x.*',
    )
);
