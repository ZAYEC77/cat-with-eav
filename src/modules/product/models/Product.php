<?php

namespace app\modules\product\models;

use app\models\Category;
use nullref\eav\behaviors\Entity;
use nullref\eav\models\attribute\Set;
use nullref\eav\models\Entity as EntityModel;
use voskobovich\linker\LinkerBehavior;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $price
 *
 * @property array $categoriesList
 * @property Category[] $categories
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['categoriesList'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            'eav' => [
                'class' => Entity::class,
                'entity' => function () {
                    return new EntityModel([
                        'sets' => [
                            Set::findOne(['code' => 'product']),
                        ],
                    ]);
                },
            ],
            'manyToMany' => [
                'class' => LinkerBehavior::class,
                'relations' => [
                    'categoriesList' => 'categories'
                ],
            ],
        ];
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->attachBehavior('eav', [
            'class' => Entity::class,
            'entity' => function () {
                $setIds = $this->getCategories()->select('set_id')->column();
                $setIds[] = Set::findOne(['code' => 'product'])->id;
                return new EntityModel([
                    'sets' => Set::findAll(['id' => array_unique($setIds)]),
                ]);
            },
        ]);
        parent::afterFind();
    }

    /**
     * @return ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('{{%product_has_category}}', ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'price' => Yii::t('product', 'Price'),
            'categoriesList' => Yii::t('app', 'Categories list'),
        ];
    }
}
