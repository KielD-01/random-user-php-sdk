<?php

use KielD01\RandomUser\RandomUser;

require_once('../vendor/autoload.php');

try {
    $randomUser = new RandomUser('1.1');

    $randomUser
        ->setNationalityOnly('us', true)
        ->setResultsCount(50)
        ->fetch()
        ->getResults();

    dd($randomUser);

} catch (Exception $e) {
    echo "<pre>{$e->getMessage()}</pre>";
}

