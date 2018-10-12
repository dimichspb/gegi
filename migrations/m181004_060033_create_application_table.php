<?php

use yii\db\Migration;

/**
 * Handles the creation of table `month`.
 */
class m181004_060033_create_application_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%application}}', [
            'id' => $this->string(36)->notNull()->unique(),
            'program_id' => $this->string(36)->notNull(),
            'month_id' => $this->string(36)->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->addPrimaryKey('pk_application', '{{%application}}', 'id');
        $this->createIndex('idx_program_month', '{{%application}}', ['program_id', 'month_id'], true);
        $this->addForeignKey('fk_application_program', '{{%application}}', 'program_id', '{{%program}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_application_month', '{{%application}}', 'month_id', '{{%month}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%application}}');
    }
}
