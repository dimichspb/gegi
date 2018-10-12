<?php

use yii\db\Migration;

/**
 * Handles the creation of table `month`.
 */
class m181003_060033_create_month_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%month}}', [
            'id' => $this->string(36)->notNull()->unique(),
            'idx' => $this->integer(2)->notNull(),
            'name' => $this->string(12)->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_month', '{{%month}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%month}}');
    }
}
