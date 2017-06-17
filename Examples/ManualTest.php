<?php

use Scraper\Structure\RegexField;
use Scraper\Structure\TextField;

require_once(__DIR__ . '/../vendor/autoload.php');

$configurationManager = \Scraper\Scrape\ConfigurationManager::getInstance(
    __DIR__ . '/Data/test.json'
);
$configuration = $configurationManager->getOrCreateConfiguration();
$configuration->setTargetXPath('//div[@class="explore-content"]');
$configuration->setRowXPath('//*[contains(@class,"repo-list")]/li');
$configuration->setFields(
    [
        new TextField(
            [
                'name' => 'repo_name',
                'xpath' => './/div[1]/h3/a'
            ]
        ),
        new TextField(
            [
                'name' => 'repo_url',
                'xpath' => './/div[1]/h3/a',
                'property' => 'href'
            ]
        ),
        new TextField(
            [
                'name' => 'description',
                'xpath' => './/div[@class="py-1"]/p',
                'canBeEmpty'=> true
            ]
        ),
        new RegexField(
            [
                'name' => 'stars_today',
                'xpath' => './/div[4]/span[@class="float-right"]'
            ]
        ),
    ]
);
$configurationManager->save();
print_r($configurationManager->getConfiguration());


