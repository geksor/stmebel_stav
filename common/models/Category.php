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
 * @property string $meta_title
 * @property string $meta_description
 * @property string $description
 * @property string $alias
 * @property string $image
 * @property int $rank
 * @property int $publish
 * @property string $show_opt_to_product_list
 * @property string $show_opt_to_product_card
 * @property string $show_opt_to_cart
 * @property array $selectedAttrs
 * @property array $selectedOptions
 * @property array $catAttr
 * @property array $catOpt
 * @property array $uploadImage
 *
 * @property CategoryAttr[] $categoryAttrs
 * @property Attr[] $attrs
 * @property CategoryOptions[] $categoryOptions
 * @property Options[] $options
 * @property CategoryProduct[] $categoryProducts
 * @property Product[] $products
 * @property Category[] $parent
 * @property Category[] $child
 */
class Category extends \yii\db\ActiveRecord
{
    public $uploadImage;
    public $catAttr;
    public $catOpt;

    public function afterFind()
    {
        $this->catAttr = $this->selectedAttrs;
        $this->catOpt = $this->selectedOptions;
        parent::afterFind();
    }

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
            [['parent_id', 'rank', 'publish'], 'integer'],
            [['rank'], 'default', 'value' => 1],
            [['title'], 'required'],
            [['image'], 'string'],
            [['catAttr', 'catOpt'], 'safe'],
            [['uploadImage'], 'image', 'extensions' => ['svg']],
            [['description', 'show_opt_to_product_list', 'show_opt_to_product_card', 'show_opt_to_cart'], 'string'],
            [['title', 'meta_title', 'meta_description', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'description' => 'Description',
            'alias' => 'Alias',
            'image' => 'Image',
            'rank' => 'Rank',
            'publish' => 'Publish',
            'show_opt_to_product_list' => 'Show Opt To Product List',
            'show_opt_to_product_card' => 'Show Opt To Product Card',
            'show_opt_to_cart' => 'Show Opt To Cart',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttrs()
    {
        return $this->hasMany(CategoryAttr::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrs()
    {
        return $this->hasMany(Attr::className(), ['id' => 'attr_id'])->viaTable('category_attr', ['category_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getSelectedAttrs()
    {
        $selectedAttrs = $this->getAttrs()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedAttrs, 'id');
    }

    /**
     * @return array
     */
    public function getSelectedOptions()
    {
        $selectedOptions = $this->getOptions()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedOptions, 'id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryOptions()
    {
        return $this->hasMany(CategoryOptions::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['id' => 'options_id'])->viaTable('category_options', ['category_id' => 'id']);
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
        CategoryAttr::deleteAll(['category_id' => $this->id]);
        if (is_array($attrs))
        {
            foreach ($attrs as $attr_id)
            {
                $attr = Attr::findOne($attr_id);
                $this->link('attrs', $attr);
            }
        }
    }

    public function saveOpt($options)
    {
        CategoryOptions::deleteAll(['category_id' => $this->id]);
        if (is_array($options))
        {
            foreach ($options as $options_id)
            {
                $opt = Options::findOne($options_id);
                $this->link('options', $opt);
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

    /**
     * @return array
     */
    public static function getAttrFromDropDown()
    {
        return ArrayHelper::map(Attr::find()->all(), 'id', 'title');
    }

    /**
     * @return array
     */
    public static function getOptFromDropDown()
    {
        return ArrayHelper::map(Options::find()->all(), 'id', 'title');
    }

}
