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
use RobotE13\DDD\Entities\Uuid\Id;
use RobotE13\UserAccount\Entities\User;
use RobotE13\Yii2UserAccount\Adapters\ContactsSerializer;
use RobotE13\UserAccount\Repositories\{
    UserRepository,
    NotFoundException
};

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

    public function add(User $user): void
    {
        $this->dbConnection->createCommand()
                ->insert('{{%user}}', $this->extract($user))
                ->execute();
    }

    public function findByEmail($email): User
    {

        return $this->populate($this->findRow(['registration_email' => $email]));
    }

    public function findById($id): User
    {
        return $this->populate($this->findRow(['uuid' => Id::fromString($id)->getBytes()]));
    }

    public function remove($id): void
    {
        $uid = Id::fromString($id)->getBytes();
        if((new \yii\db\Query())
                        ->from("{{%user}}")
                        ->where(['uuid' => $uid])
                        ->exists())
        {
            $this->dbConnection->createCommand()->delete('{{%user}}', ['uuid' => $uid])->execute();
        } else
        {
            throw new NotFoundException('User not found.');
        }
    }

    public function update(User $user): void
    {

    }

    private function findRow($condition): array
    {
        $row = (new \yii\db\Query())
                ->from("{{%user}}")
                ->where($condition)
                ->one();

        if(!$row)
        {
            throw new NotFoundException('User not found.');
        }

        return $row;
    }

    private function extract(User $user)
    {
        $hydrator = new Hydrator(['password_hash' => 'hash']);
        return array_merge([
            'uuid' => $user->getUid()->getBytes(),
            'registration_email' => $user->getRegistrationEmail(),
            'registration_phone' => '',
            'registered_on' => $user->getRegisteredOn()->format('Y-m-d H:i:s'),
            'status' => $user->getStatus()->getValue(),
            'contacts' => json_encode((new ContactsSerializer($user->getContacts()))->jsonSerialize()),
                ], $hydrator->extract($user->getPassword()));
    }

    private function populate($row): User
    {
        $row['uuid'] = Id::fromBytes($row['uuid']);
        $row['password_hash'] = (new Hydrator(['password_hash' => 'hash']))->hydrate(['password_hash' => $row['password_hash']], \RobotE13\UserAccount\Entities\Password::class);
        $row['registered_on'] = new \DateTimeImmutable($row['registered_on']);
        $row['contacts'] = new \RobotE13\UserAccount\Entities\Contact\ContactsCollection(json_decode($row['contacts'], true));
        $hydrator = new Hydrator([
            'uuid' => 'uid',
            'registration_email' => 'registrationEmail',
            'password_hash' => 'password',
            'registered_on' => 'registeredOn',
            'status' => 'status',
            'contacts' => 'contacts'
        ]);

        return $hydrator->hydrate($row, User::class);
    }

}
