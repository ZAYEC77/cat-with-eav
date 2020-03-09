<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%demo}}".
 *
 * @property int $id
 * @property string $filename
 * @property int $size
 * @property int $packed
 * @property int $invalid
 * @property string $createdAt
 */
class Demo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%demo}}';
    }

    /**
     * {@inheritdoc}
     * @return DemoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DemoQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getFileNameWithUrl()
    {
        return $this->filename;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size', 'packed', 'invalid'], 'integer'],
            [['createdAt'], 'safe'],
            [['filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'filename' => Yii::t('product', 'Filename'),
            'size' => Yii::t('product', 'Size'),
            'packed' => Yii::t('product', 'Packed'),
            'invalid' => Yii::t('product', 'Invalid'),
            'createdAt' => Yii::t('product', 'Created At'),
        ];
    }
}
