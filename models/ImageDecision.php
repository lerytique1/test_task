<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "image_decision".
 *
 * @property int $id
 * @property int $image_id
 * @property string $decision
 */
class ImageDecision extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%image_decision}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['image_id', 'decision'], 'required'],
            [['image_id'], 'integer'],
            [['decision'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'decision' => 'Decision',
        ];
    }
}
