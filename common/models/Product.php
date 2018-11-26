<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

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
 * @property int $price
 * @property int $code
 * @property int $avail
 * @property int $unlimited
 * @property int $count
 * @property int $sale
 * @property int $hot
 * @property int $new
 * @property int $rank
 * @property int $publish
 * @property int $rating
 * @property int $reviews_count
 * @property string $main_image
 * @property int $hits
 * @property int $filterCat
 * @property array $selectCat
 * @property array $selectedCats
 *
 * @property CategoryProduct[] $categoryProducts
 * @property Category[] $categories
 * @property ProductImages[] $productImages
 * @property ProductAttr[] $productAttrs
 * @property Attr[] $attrs
 * @property ProductOptions[] $productOptions
 * @property Options[] $options
 * @property Reviews[] $reviews
 * @property RecommendedProduct[] $recommendedProducts
 * @property RecommendedProduct[] $recommendedProducts0
 * @property RecommendedProduct[] $recommProducts
 * @property RecommendedProduct[] $products
 */
class Product extends \yii\db\ActiveRecord
{
    public $selectCat;
    public $filterCat;

    public function afterFind()
    {
        $this->selectCat = $this->selectedCats;
        parent::afterFind();
    }

    /**
     * @return array
     */
    public function getSelectedCats()
    {
        $selectedCats = $this->getCategories()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedCats, 'id');
    }

    /**
     * @return array
     */
    public static function getCatFromDropDown()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'title');
    }

    /**
     * @param $cats
     */
    public function saveCategories($cats)
    {
        CategoryProduct::deleteAll(['product_id' => $this->id]);
        if (is_array($cats))
        {
            $categoryModels = Category::find()->where(['id' => $cats])->all();
            foreach ($categoryModels as $category)
            {
                $this->link('categories', $category);
            }
        }
    }

    public function saveRecomm($id)
    {
        $this->link('recommProducts', $this::findOne($id));
    }

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
            [['title', 'price'], 'required'],
            [['selectCat', 'filterCat'], 'safe'],
            [['short_description', 'description'], 'string'],
            [['price', 'code', 'avail', 'unlimited', 'count', 'sale', 'hot', 'new', 'rank', 'publish', 'rating', 'reviews_count', 'hits'], 'integer'],
            [['title', 'meta_title', 'meta_description', 'alias', 'main_image'], 'string', 'max' => 255],
            [['rank'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'alias' => 'Alias',
            'price' => 'Price',
            'code' => 'Code',
            'avail' => 'Avail',
            'unlimited' => 'Unlimited',
            'count' => 'Count',
            'sale' => 'Sale',
            'hot' => 'Hot',
            'new' => 'New',
            'rank' => 'Rank',
            'publish' => 'Publish',
            'rating' => 'Rating',
            'reviews_count' => 'Reviews Count',
            'main_image' => 'Main Image',
            'hits' => 'Hits',
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
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrs()
    {
        return $this->hasMany(ProductAttr::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrs()
    {
        return $this->hasMany(Attr::className(), ['id' => 'attr_id'])->viaTable('product_attr', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptions()
    {
        return $this->hasMany(ProductOptions::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['id' => 'options_id'])->viaTable('product_options', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['product_id' => 'id']);
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

    public function getMainImage()
    {
        return ($this->main_image) ? '/uploads/images/product/'.$this->id.'/'.$this->main_image : "/no_image.png";
    }

    public function getThumbMainImage()
    {
        return ($this->main_image) ? '/uploads/images/product/'.$this->id.'/'. 'thumb_' .$this->main_image : "/no_image.png";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendedProducts()
    {
        return $this->hasMany(RecommendedProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendedProducts0()
    {
        return $this->hasMany(RecommendedProduct::className(), ['recommProduct_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommProducts()
    {
        return $this->hasMany(RecommendedProduct::className(), ['id' => 'recommProduct_id'])->viaTable('recommended_product', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(RecommendedProduct::className(), ['id' => 'product_id'])->viaTable('recommended_product', ['recommProduct_id' => 'id']);
    }
}
