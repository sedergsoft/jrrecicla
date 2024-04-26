<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notifications}}`.
 */
class m210927_150000_create_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notifications}}', [
            'id' => $this->primaryKey(),
            'usuario_id' => $this->integer()->notNull(),
            'mensaje' => $this->string(255)->notNull(),
            'fecha_creacion' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'leida' => $this->boolean()->defaultValue(false),
            'fecha_leida' => $this->timestamp(),
            'status' => $this->boolean()->defaultValue(true),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notifications}}');
    }
}