<?php

use yii\db\Migration;
use \yii\db\Schema;

/**
 * Class m200105_144336_create_table_user_correspondence
 */
class m200105_144336_create_table_user_correspondence extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_correspondence', [
            'id' => Schema::TYPE_PK,
            'user__id' => $this->integer()->notNull(),
            'correspondence__id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-user_correspondence-user__id',
            'user_correspondence',
            'user__id'
        );

        $this->addForeignKey(
            'fk-user_correspondence-user__id',
            'user_correspondence',
            'user__id',
            'user',
            'id');

        $this->createIndex(
            'idx-user_correspondence-correspondence__id',
            'user_correspondence',
            'correspondence__id'
        );

        $this->addForeignKey(
            'fk-user_correspondence-correspondence__id',
            'user_correspondence',
            'correspondence__id',
            'correspondence',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_correspondence');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200105_144336_create_table_user_correspondence cannot be reverted.\n";

        return false;
    }
    */
}
