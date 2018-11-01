<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $alias
 * @property int $rank
 * @property int $publish
 * @property array $selectCategory
 * @property array $selectedAttributes
 * @property array $catAttributes
 * @property array $selectAttr
 * @property int $filterCat

 *
 * @property CategoryProduct[] $categoryProducts
 * @property Category[] $categories
 * @property Category[] $selectedCategories
 * @property ProductAttributes[] $productAttributes
 * @property Attributes[] $attributes0
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
            [['description'], 'string'],
            [['rank', 'publish'], 'integer'],
            [['title', 'short_description', 'alias'], 'string', 'max' => 255],
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
                            ->thumbnail(new \Imagine\Image\Box(300, 300));
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
            ]
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
            'alias' => 'Псевдоним',
            'rank' => 'Сортировка',
            'publish' => 'Публикация',
            'selectCategory' => 'Выбор категории',
            'filterCat' => 'Категории',
            'selectAttr' => 'Выбор атрибутов',
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
    public function getAttributes0()
    {
        return $this->hasMany(Attributes::className(), ['id' => 'attributes_id'])->viaTable('product_attributes', ['product_id' => 'id']);
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
     * @return array
     */
    public function getCatAttributes()
    {
        $prodCat = CategoryProduct::find()->where(['product_id' => $this->id])->select('category_id')->asArray()->all();
        $cat = ArrayHelper::getColumn($prodCat, 'category_id');
        $attrCat = CategoryAttributes::find()->where(['category_id' => $cat])->select('attributes_id')->asArray()->all();
        $attr = ArrayHelper::getColumn($attrCat, 'attributes_id');

        return Attributes::find()->with('attrColors', 'attrLists')->where(['id' => $attr])->all();
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
    }

    public function saveAttr($attrList = null, $attrColor = null, $attrString = null)
    {
        ProductAttributes::deleteAll(['product_id' => $this->id]);
        if (is_array($attrList))
        {
            foreach ($attrList as $attrId => $attrList_id)
            {
                $attr = Attributes::findOne($attrId);
                $this->link('attributes0', $attr, ['attrList_id' => $attrList_id]);
            }
        }
        if (is_array($attrColor))
        {
            foreach ($attrColor as $attrId => $attrColor_id)
            {
                $attr = Attributes::findOne($attrId);
                $this->link('attributes0', $attr, ['attrColor_id' => $attrColor_id]);
            }
        }
        if (is_array($attrString))
        {
            foreach ($attrString as $attrId => $attrStringVal)
            {
                $attr = Attributes::findOne($attrId);
                $this->link('attributes0', $attr, ['attrString' => $attrStringVal]);
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
        $this->saveCategories($this->selectCategory);
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
