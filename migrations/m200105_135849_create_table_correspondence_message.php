<?php

use yii\db\Migration;
use \yii\db\Schema;

/**
 * Class m200105_135849_create_table_correspondence_message
 */
class m200105_135849_create_table_correspondence_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('correspondence_message', [
            'id' => Schema::TYPE_PK,
            'user__id' => $this->integer()->notNull(),
            'correspondence__id' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'created_at' => $this->dateTime()
        ]);

        $this->createIndex(
            'idx-correspondence_message-user__id',
            'correspondence_message',
            'user__id'
        );

        $this->addForeignKey(
            'fk-correspondence_message-user__id',
            'correspondence_message',
            'user__id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-correspondence_message-correspondence__id',
            'correspondence_message',
            'correspondence__id'
        );

        $this->addForeignKey(
            'fk-correspondence_message-correspondence__id',
            'correspondence_message',
            'correspondence__id',
            'correspondence',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('correspondence_message');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200105_135849_create_table_correspondence_message cannot be reverted.\n";

        return false;
    }
    */
}
