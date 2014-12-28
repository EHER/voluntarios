<?php

$set = new h4cc\AliceFixturesBundle\Fixtures\FixtureSet(array(
    'locale' => 'pt_BR',
    'seed' => 42,
    'do_drop' => false,
    'do_persist' => true,
    'order' => 5
));

$set->addFile(__DIR__.'/estado.yml', 'yaml');
$set->addFile(__DIR__.'/cidade.yml', 'yaml');

return $set;
