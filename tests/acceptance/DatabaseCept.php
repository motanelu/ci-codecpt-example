<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Play with the database settings');

$I->haveInDatabase(
    'item',
    ['id' => 1, 'name' => 'first item']
);

$I->amOnPage('/items/');
$I->see('first item');
$I->see('Add new item');
$I->click('Add new item');
$I->fillField('name','second item');
$I->click('Submit');

$I->seeInDatabase(
    'item',
    ['id' => 2, 'name' => 'second item']
);
