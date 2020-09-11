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

namespace RobotE13\Yii2UserAccount\Adapters;

use Yii;
use RobotE13\UserAccount\Entities\User;
use RobotR13\UserAccount\Repositories\{
    UserRepository,
    NotFoundException
};

/**
 * Description of IdentityAdapter
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class IdentityAdapter implements \yii\web\IdentityInterface
{

    /**
     *
     * @var UserRepository
     */
    private $repository;

    /**
     *
     * @var User
     */
    private $entity;

    public function __construct($id, UserRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = $this->repository->findById($id);
    }

    public static function findIdentity($id)
    {
        try {
            $identity = Yii::createObject(self::class, [$id]);
        } catch (NotFoundException $exc) {
            Yii::debug($exc->getMessage());
            return null;
        }
        return $identity;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \BadMethodCallException('Method not implemented yet.');
    }

    public function getAuthKey(): string
    {

    }

    public function getId()
    {
        return $this->entity->getUid()->getString();
    }

    public function validateAuthKey($authKey): bool
    {

    }

}
