<?php

/**
 * This file is part of the yii2-user-account.
 *
 * Copyright 2020 Evgenii Dudal <wolfstrace@gmail.com>.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * @package yii2-user-account
 */

namespace RobotE13\Yii2UserAccount\Forms;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{

    public $login;
    public $password;
    public $rememberMe = true;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
                // password is validated by validatePassword()
                //['password', 'validatePassword']
        ];
    }

}
