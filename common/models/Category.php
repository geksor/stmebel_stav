<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $description
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property int $publish
 * @property array $selectedAttributes
 * @property array $catAttr
 * @property int $rank
 * @property int $fromWidget
 *
 * @property CategoryAttributes[] $categoryAttributes
 * @property Attributes[] $attributes0
 * @property CategoryProduct[] $categoryProducts
 * @property Product[] $products
 * @property Category[] $parent
 * @property Category[] $child
 */
class Category extends \yii\db\ActiveRecord
{
    public $catAttr;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'publish', 'rank', 'fromWidget'], 'integer'],
            [['parent_id', 'rank',], 'default', 'value' => 0],
            [['description'], 'string'],
            [['catAttr'], 'safe'],
            [['title', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'title' => 'Название',
            'description' => 'Описание',
            'alias' => 'Псевдоним',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'publish' => 'Публикация',
            'catAttr' => 'Атрибуты',
            'rank' => 'Порядок вывода',
            'fromWidget' => 'Категория для виджета',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttributes()
    {
        return $this->hasMany(CategoryAttributes::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attributes::className(), ['id' => 'attributes_id'])->viaTable('category_attributes', ['category_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getSelectedAttributes()
    {
        $selectedAttributes = $this->getAttributes0()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedAttributes, 'id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryProducts()
    {
        return $this->hasMany(CategoryProduct::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('category_product', ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }


    /**
     * @return string
     */
    public function getParentName()
    {
        /* @var $parent Category */
        $parent = $this->parent;

        return $parent ? $parent->title : 'Верхний уровень';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getParentsList()
    {
        $parents = Category::find()
            ->select(['id', 'title'])
            ->where(['parent_id' => 0])
            ->asArray()
            ->all();

        $parents[] = ['id' => 0, 'title' => 'Верхний уровень'];

        ArrayHelper::multisort($parents, 'id');

        return ArrayHelper::map($parents, 'id', 'title');

    }

    public function saveAttr($attrs)
    {
        CategoryAttributes::deleteAll(['category_id' => $this->id]);
        if (is_array($attrs))
        {
            foreach ($attrs as $attr_id)
            {
                $attr = Attributes::findOne($attr_id);
                $this->link('attributes0', $attr);
            }
        }
    }

    /**
     * @return bool
     * For the Inflector to work, need an extension intl in php.ini
     */
    public function beforeValidate()
    {
        if (!$this->alias){
            $this->alias = $this->title;
        }

        $this->alias = Inflector::slug($this->alias);

        return parent::beforeValidate();
    }


}
