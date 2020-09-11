<?php

namespace RobotE13\Yii2UserAccount\Migrations;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200906_231853_create_user_table extends Migration
{

    private $table = '{{%user}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => "BINARY(16) NOT NULL",
            'registration_email' => $this->string()->notNull()->defaultValue(''),
            'registration_phone' => $this->string(24)->notNull()->defaultValue(''),
            'password_hash' => $this->string()->notNull(),
            'registered_on' => $this->timestamp()->notNull(),
            'status' => $this->tinyInteger()->notNull(),
            'auth_key' => $this->string(40)->notNull()->defaultValue(''),
        ], $this->tableOptions);
        $this->addPrimaryKey('', $this->table, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }

}
