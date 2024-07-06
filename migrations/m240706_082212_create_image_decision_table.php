<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image_decision}}`.
 * This table stores decisions on images (approved or rejected).
 */
class m240706_082212_create_image_decision_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        // Создание таблицы image_decision
        $this->createTable('{{%image_decision}}', [
            'id' => $this->primaryKey()->comment('Primary key'),
            'image_id' => $this->integer()->notNull()->comment('ID of the image'),
            'decision' => $this->string()->notNull()->comment('Decision (approved/rejected)'),
        ]);

        // Создание индекса для поля image_id для производительности запросов
        $this->createIndex(
            '{{%idx-image_decision-image_id}}',
            '{{%image_decision}}',
            'image_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        // Удаление индекса для поля image_id
        $this->dropIndex(
            '{{%idx-image_decision-image_id}}',
            '{{%image_decision}}'
        );

        // Удаление таблицы image_decision
        $this->dropTable('{{%image_decision}}');
    }
}
