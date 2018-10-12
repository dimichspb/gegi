<?php

use yii\db\Migration;

/**
 * Handles the creation of table `program`.
 */
class m181001_064314_create_program_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%program}}', [
            'id' => $this->string(36)->notNull()->unique(),
            'code' => $this->string(5)->notNull()->unique(),
            'description' => $this->text()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_program', '{{%program}}', 'id');
    }
    public function safeDown()
    {
        $this->dropTable('{{%program}}');
    }
}
