<?php

use yii\db\Migration;
use \yii\db\Schema;

/**
 * Class m200105_134800_create_table_correspondence
 */
class m200105_134800_create_table_correspondence extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('correspondence', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('correspondence');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200105_134800_create_table_correspondence cannot be reverted.\n";

        return false;
    }
    */
}
