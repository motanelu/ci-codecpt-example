<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('See what the fuss is about');

$I->amOnPage('/');
$I->see('Hello there', 'h1');
$I->see('Click here', 'a');
$I->click('Click here');
$I->amOnPage('/login');
$I->see('Log in here');
$I->fillField('name','Tudor');
$I->fillField('password','1234');
$I->click('Submit');
$I->see('Welcome');
