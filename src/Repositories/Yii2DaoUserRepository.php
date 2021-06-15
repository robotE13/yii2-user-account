<?php

/**
 * This file is part of the yii2-user-account.
 *
 * Copyright 2021 Evgenii Dudal <wolfstrace@gmail.com>.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * @package yii2-user-account
 */

namespace RobotE13\Yii2UserAccount\Repositories;

use Yii;
use yii\db\Connection;
use samdark\hydrator\Hydrator;
use RobotE13\UserAccount\Entities\User;
use RobotE13\UserAccount\Repositories\UserRepository;
use RobotE13\Yii2UserAccount\Adapters\ContactsSerializer;

/**
 * Description of Yii2DaoUserRepository
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class Yii2DaoUserRepository implements UserRepository
{

    /**
     * @var Connection
     */
    private $dbConnection;

    public function __construct(string $dbConnection = 'db')
    {
        $this->dbConnection = Yii::$app->get($dbConnection);
    }

    public function add(User $user)
    {
        $this->dbConnection->createCommand()
                ->insert('{{%user}}', $this->extract($user))
                ->execute();
    }

    public function findByEmail($email): User
    {

    }

    public function findById($id): User
    {

    }

    public function remove($id)
    {

    }

    public function update(User $user)
    {

    }

    private function extract(User $user)
    {
        $hydrator = new Hydrator(['password_hash' => 'hash']);
        return array_merge([
            'id' => $user->getUid()->getBytes(),
            'registration_email' => $user->getRegistrationEmail(),
            'registration_phone' => '',
            'registered_on' => $user->getRegisteredOn()->format('Y-m-d H:i:s'),
            'status' => $user->getStatus()->getValue(),
            'contacts' => json_encode((new ContactsSerializer($user->getContacts()))->jsonSerialize()),
                ], $hydrator->extract($user->getPassword()));
    }

}
