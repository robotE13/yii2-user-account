<?php

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToLogin(FunctionalTester $I)
    {
        $I->amOnPage('/accounts/user/sign-in');
        $I->see('Login Form', 'h1');
//        $I->click('Login');
//        $I->fillField('Username', 'Miles');
//        $I->fillField('Password', 'Davis');
//        $I->click('Enter');
    }
}
