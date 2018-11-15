<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $alias
 * @property int $rank
 * @property int $publish
 * @property string $viewAttr
 * @property string $addBlockTitle
 * @property array $selectCategory
 * @property array $selectedAttributes
 * @property array $catAttributes
 * @property array $selectAttr
 * @property int $filterCat
 * @property string $viewOnWidget

 *
 * @property CategoryProduct[] $categoryProducts
 * @property Category[] $categories
 * @property Category[] $selectedCategories
 * @property ProductAttributes[] $productAttributes
 * @property ProductAttributes[] $productAttributesRank
 * @property Attributes[] $attributes0
 * @property Attributes[] $attributesOrder
 */
class Product extends \yii\db\ActiveRecord
{
    public $selectCategory;
    public $selectAttr;
    public $filterCat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['alias'], 'unique'],
            [['selectCategory', 'filterCat', 'selectAttr'], 'safe'],
            [['description','short_description',], 'string'],
            [['rank', 'publish'], 'integer'],
            [['title', 'meta_title', 'meta_description', 'alias', 'viewAttr', 'addBlockTitle', 'viewOnWidget'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'product',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/product',
                'url' => '/uploads/images/product',
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(360, 239));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ],
            'galleryBehaviorAddBlock' => [
                'class' => GalleryBehavior::className(),
                'type' => 'productAddBlock',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/product/add-block',
                'url' => '/uploads/images/product/add-block',
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(374, 249));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'short_description' => 'Короткое описание',
            'description' => 'Полное описание',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'alias' => 'Псевдоним',
            'rank' => 'Сортировка',
            'publish' => 'Публикация',
            'selectCategory' => 'Выбор категории',
            'filterCat' => 'Категории',
            'selectAttr' => 'Выбор атрибутов',
            'viewAttr' => 'Выводить в превью товара',
            'addBlockTitle' => 'Заголовок дополнительного блока',
            'viewOnWidget' => 'Выводить в виджете',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryProducts()
    {
        return $this->hasMany(CategoryProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('category_product', ['product_id' => 'id']);
    }

    public function getLink($id = 0)
    {
        /* @var $tmpParent Category */
        if ($id){
            $parent = Category::findOne([ 'id' => $id]);
        }

        if (!$parent){
            $catArr = $this->categories;
            if ($catArr){
                $parent = Category::findOne([ 'id' => $catArr[0]->id]);
            }
        }

        $arrAlias = [];
        $arrAlias[] = $this->alias;

        if ($parent){
            $arrAlias[] =  $parent->alias;

            $tmpParent = $parent->parent;

            while ($tmpParent){
                $arrAlias[] =  $tmpParent->alias;
                $tmpParent = $tmpParent->parent;
            }
        }else{
            $arrAlias[] =  'not-category';
        }

        $link = '';
        foreach ($arrAlias as $alias){
            $link = '/' . $alias . $link;
        }

        return '/catalog'.$link;
    }


    /**
     * @return array
     */
    public function getSelectedCategories()
    {
        return ArrayHelper::getColumn($this->getCategories()->select('id')->asArray()->all(), 'id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttributes::className(), ['product_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributesRank()
    {
        return $this
            ->hasMany(ProductAttributes::className(), ['product_id' => 'id'])
            ->orderBy(['rank' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this
            ->hasMany(Attributes::className(), ['id' => 'attributes_id'])
            ->viaTable('product_attributes', ['product_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributesOrder()
    {
        return $this
            ->hasMany(Attributes::className(), ['id' => 'attributes_id'])
            ->via('productAttributes')
            ->indexBy('id');
    }

    public function getAttributesOrderRes($attrModels, $orderModels)
    {
        $tempModels = $attrModels;

        $orderArr = ArrayHelper::getColumn($orderModels, 'attributes_id');

        $resArr = [];

        if ($tempModels){
            foreach ($orderArr as $value){
                $resArr[] = $tempModels[$value];
            }
        }

        return $resArr;
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
     * @param bool $dropDown
     * @return array|Attributes[]|Category[]|CategoryAttributes[]|CategoryProduct[]|Product[]|\yii\db\ActiveRecord[]
     */
    public function getCatAttributes($dropDown = false)
    {
        $prodCat = CategoryProduct::find()->where(['product_id' => $this->id])->select('category_id')->asArray()->all();
        $cat = ArrayHelper::getColumn($prodCat, 'category_id');
        $attrCat = CategoryAttributes::find()->where(['category_id' => $cat])->select('attributes_id')->asArray()->all();
        $attr = ArrayHelper::getColumn($attrCat, 'attributes_id');

        $attributes = Attributes::find()->with('attrColors', 'attrLists')->where(['id' => $attr])->all();

        if ($dropDown){
            return ArrayHelper::map($attributes, 'id', 'title');
        }

        return $attributes;
    }

    public function getViewAttr()
    {
        if ($this->viewAttr){
            return json_decode($this->viewAttr);
        }
        return [];
    }

    public function getViewOnWidget()
    {
        if ($this->viewOnWidget){
            return json_decode($this->viewOnWidget);
        }
        return [];
    }

    /**
     * @return int
     */
    public function getMaxRank()
    {
        return (integer)Product::find()->max('rank');
    }

    /**
     * @return int
     */
    public function getMinRank()
    {
        return (integer)Product::find()->min('rank');
    }

    /**
     * @param $cats array ([0 => $selectCategory_id, 0 => $selectCategory_id, ...])
     */
    public function saveCategories($cats)
    {
        CategoryProduct::deleteAll(['product_id' => $this->id]);
        if (is_array($cats))
        {
            foreach ($cats as $cat_id)
            {
                $cat = Category::findOne($cat_id);
                $this->link('categories', $cat);
            }
        }
        $delAttr = ArrayHelper::getColumn($this->catAttributes, 'id');
        ProductAttributes::deleteAll(['AND', 'product_id' => $this->id, ['not in', 'attributes_id', $delAttr]]);
    }

    public function saveAttr($attrList = null, $attrColor = null, $attrString = null, $viewAttr = null, $viewOnWidget = null)
    {
        ProductAttributes::deleteAll(['product_id' => $this->id]);
        if (is_array($attrList))
        {
            foreach ($attrList as $attrId => $attrList_id)
            {
                if ($attrList_id){
                    $attr = Attributes::findOne($attrId);
                    $this->link('attributes0', $attr, ['attrList_id' => $attrList_id]);
                }
            }
        }
        if (is_array($attrColor))
        {
            foreach ($attrColor as $attrId => $attrColor_id)
            {
                if ($attrColor_id){
                    $attr = Attributes::findOne($attrId);
                    $this->link('attributes0', $attr, ['attrColor_id' => json_encode($attrColor_id)]);
                }
            }
        }
        if (is_array($attrString))
        {
            foreach ($attrString as $attrId => $attrStringVal)
            {
                if ($attrStringVal){
                    $attr = Attributes::findOne($attrId);
                    $this->link('attributes0', $attr, ['attrString' => $attrStringVal]);
                }
            }
        }

        if ($viewAttr){
            $this->viewAttr = json_encode($viewAttr);
            $this->save(false);
        }

        if ($viewOnWidget){
            $this->viewOnWidget = json_encode($viewOnWidget);
            $this->save(false);
        }
    }

    /**
     * @param $rank array
     */
    public function saveAttrRank($rank)
    {
        if (is_array($rank))
        {
            foreach ($rank as $attrId => $rankVal)
            {
                if ($rankVal){
                    $attr = ProductAttributes::findOne([ 'attributes_id' => $attrId, 'product_id' => $this->id]);
                    if ($attr){
                        $attr->rank = $rankVal;
                        $attr->save(false);
                    }
                }
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


        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->selectCategory){
            $this->saveCategories($this->selectCategory);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
