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

namespace RobotE13\Yii2UserAccount\Migrations;

/**
 * Description of Migration
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class Migration extends \yii\db\Migration
{

    /**
     * @var string
     */
    protected $tableOptions;
    //protected $restrict = 'RESTRICT';
    //protected $cascade = 'CASCADE';
    protected $dbType;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        switch ($this->db->driverName)
        {
            case 'mysql':
                $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                $this->dbType = 'mysql';
                break;
            case 'pgsql':
                $this->tableOptions = null;
                $this->dbType = 'pgsql';
                break;
            case 'dblib':
            case 'mssql':
            case 'sqlsrv':
                $this->restrict = 'NO ACTION';
                $this->tableOptions = null;
                $this->dbType = 'sqlsrv';
                break;
            default:
                throw new \RuntimeException('Your database is not supported!');
        }
    }

}
