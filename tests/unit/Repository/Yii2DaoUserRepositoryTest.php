<?php
namespace Repository;

class Yii2DaoUserRepositoryTest extends \RobotE13\UserAccount\Tests\UserRepositoryAbstractTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     *
     * @var \RobotE13\UserAccount\Repositories\UserRepository
     */
    protected $repository;

    protected function _before()
    {
        $this->repository = new \RobotE13\Yii2UserAccount\Repositories\Yii2DaoUserRepository();
    }

    protected function _after()
    {
    }

}