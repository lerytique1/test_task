<?php

namespace app\requests;

use yii\base\Model;

class ImageDecisionRequest extends Model
{
    public int $image_id;
    public string $decision;

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
}
