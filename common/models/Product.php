<?php

namespace common\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Json;

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
 * @property string $code
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
 * @property array $selectRecommProd
 * @property array $selectedRecommProd
 * @property int $optList
 * @property int $main_category
 * @property int $oldMainCat
 * @property int $show_color
 * @property int $newPrice
 *
 * @property CategoryProduct[] $categoryProducts
 * @property Category[] $categories
 * @property Category[] $mainCat
 * @property ProductImages[] $productImages
 * @property ProductAttr[] $productAttrs
 * @property Attr[] $attrs
 * @property ProductOptions[] $productOptions
 * @property ProductOptions[] $productOptionsList
 * @property ProductOptions[] $productOptionsShort
 * @property ProductOptions[] $productOptionsAll
 * @property Options[] $options
 * @property Reviews[] $reviews
 * @property RecommendedProduct[] $recommendedProducts
 * @property RecommendedProduct[] $recommendedProducts0
 * @property Product[] $recommProducts
 * @property Product[] $products
 */
class Product extends \yii\db\ActiveRecord
{
    public $selectCat;
    public $filterCat;
    public $optList;
    public $oldMainCat;
    public $selectRecommProd;

    public function afterFind()
    {
        $this->selectCat = $this->selectedCats;
        $this->selectRecommProd = $this->selectedRecommProd;
        $this->oldMainCat = $this->main_category;
        parent::afterFind();
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
            [['title', 'price', 'main_category'], 'required'],

            [['selectCat', 'filterCat'], 'safe'],
            [['short_description', 'description', 'code',], 'string'],
            [['price', 'avail', 'unlimited', 'count', 'sale', 'hot', 'new', 'rank', 'publish', 'rating', 'reviews_count', 'hits', 'main_category', 'show_color',], 'integer'],
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
            'title' => 'Название',
            'short_description' => 'Короткое описание',
            'description' => 'Описание',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'alias' => 'Название в адресной строке',
            'price' => 'Цена',
            'code' => 'Код товара',
            'avail' => 'Наличие',
            'unlimited' => 'Unlimited',
            'count' => 'Count',
            'sale' => 'Скидка %',
            'hot' => 'Хит продаж',
            'new' => 'Новинка',
            'rank' => 'Сортировка',
            'publish' => 'Публикация',
            'rating' => 'Rating',
            'reviews_count' => 'Reviews Count',
            'main_image' => 'Основное изображение',
            'hits' => 'Количество просмотров',
            'main_category' => 'Основная категория',
            'show_color' => 'Отключить выбор цвета'
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->saveMainCategory();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'main_category']);
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
    public function getSelectedRecommProd()
    {
        $selectedRecom = $this->getRecommProducts()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedRecom, 'id');
    }

    /**
     * @return array
     */
    public static function getCatFromDropDown()
    {
        return ArrayHelper::map(Category::find()->orderBy(['rank' => SORT_ASC])->all(), 'id', 'title');
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
    public function getCategoryProductOptions()
    {
        $categories = ArrayHelper::getColumn($this->categories, 'id');

        $optionsId = ArrayHelper::getColumn(CategoryOptions::find()->where(['category_id' => $categories])->groupBy('options_id')->all(), 'options_id');

        return $this->hasMany(ProductOptions::className(), ['product_id' => 'id'])->filterWhere(['options_id' => $optionsId]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionsList()
    {
        $categories = ArrayHelper::getColumn($this->categories, 'id');

        $categoriesModel = Category::find()->where(['id' => $categories])->all();

        $optionsId = [];

        if ($categoriesModel){
            foreach ($categoriesModel as $model){
                $listArr = $model->optForList;
                if ($listArr){
                    foreach ($listArr as $item){
                        $optionsId[] = $item;
                    }
                }
            }
            $this->optList = array_unique($optionsId);
        }

        return $this->hasMany(ProductOptions::className(), ['product_id' => 'id'])->filterWhere(['options_id' => $this->optList]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionsShort()
    {
        $categories = ArrayHelper::getColumn($this->categories, 'id');

        $categoriesModel = Category::find()->where(['id' => $categories])->all();

        $optionsId = [];

        if ($categoriesModel){
            foreach ($categoriesModel as $model){
                $listArr = $model->optShort;
                if ($listArr){
                    foreach ($listArr as $item){
                        $optionsId[] = $item;
                    }
                }
            }
            $this->optList = array_unique($optionsId);
        }

        return $this->hasMany(ProductOptions::className(), ['product_id' => 'id'])->filterWhere(['options_id' => $this->optList]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionsAll()
    {
        $categories = ArrayHelper::getColumn($this->categories, 'id');

        $categoriesModel = Category::find()->where(['id' => $categories])->all();

        $optionsId = [];

        if ($categoriesModel){
            foreach ($categoriesModel as $model){
                $listArr = $model->catOpt;
                if ($listArr){
                    foreach ($listArr as $item){
                        $optionsId[] = $item;
                    }
                }
            }
            $this->optList = array_unique($optionsId);
        }

        return $this->hasMany(ProductOptions::className(), ['product_id' => 'id'])->filterWhere(['options_id' => $this->optList]);
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

    public function getZoomMainImage()
    {
        return ($this->main_image) ? '/uploads/images/product/'.$this->id.'/'. 'zoom_' .$this->main_image : "/no_image.png";
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
        return $this->hasMany(Product::className(), ['id' => 'recommProduct_id'])->viaTable('recommended_product', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('recommended_product', ['recommProduct_id' => 'id']);
    }

    public function getNewPrice()
    {
        return $this->price - ($this->price*$this->sale/100);
    }

    public function randCode()
    {
        $result = null;
        for ($i = 0; $i<6; $i++){
            if (!$result){
                $result .= mt_rand(1,9);
            }else{
                $result .= mt_rand(0,9);
            }
        }

        $this->code = (string)$result;
    }

    public function beforeSave($insert)
    {
        if (!$this->code){
            if ($this->isNewRecord){
                do
                {
                    $this->randCode();
                } while (Product::find()->where(['code' => $this->code])->one());
            }else {
                do {
                    $this->randCode();
                } while (Product::find()->where(['code' => $this->code])->andWhere(['not in', 'id', $this->id])->one());
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param $cats
     */
    public function saveCategories($cats)
    {
        if (is_array($cats))
        {
            CategoryProduct::deleteAll(['product_id' => $this->id]);

            $categoryModels = Category::find()->where(['id' => $cats])->all();
            foreach ($categoryModels as $category)
            {
                $this->link('categories', $category);
            }
            $this->saveMainCategory();
        }
    }

    public function saveMainCategory()
    {
        CategoryProduct::deleteAll(['product_id' => $this->id, 'category_id' => $this->main_category]);
        $this->link('categories', Category::findOne(['id' => $this->main_category]));
    }

    public function saveRecomm($id)
    {
        $this->link('recommProducts', $this::findOne($id));
    }

    public function saveRecomms($ids)
    {
        if (is_array($ids)){
            $prodModels = Product::find()->where(['id' => $ids])->all();

            foreach ($prodModels as $prodModel){
                $this->link('recommProducts', $prodModel);
            }
        }
    }

    public function copySave($copyModel, $options, $attrs)
    {
        /* @var $copyModel Product */
        if ($copyModel){
            $this->alias = null;
            $this->title = 'Копия-'.$this->title;
            $this->code = null;
            $this->publish = 0;
            $this->rating = null;
            $this->reviews_count = null;
            $this->main_image = null;
            $this->hits = null;
            $this->isNewRecord = true;

            if ($this->save()){
                $this->saveCategories($copyModel->selectCat);
                $this->saveRecomms($copyModel->selectRecommProd);
                if ($options){
                    foreach ($options as $option){
                        /* @var $option ProductOptions */
                        $newOption = new ProductOptions();
                        $newOption->attributes = $option->attributes;
                        $newOption->product_id = $this->id;
                        $newOption->save(false);
                    }
                }
                if ($attrs){
                    foreach ($attrs as $attr){
                        /* @var $attr ProductOptions */
                        $newAttr = new ProductAttr();
                        $newAttr->attributes = $attr->attributes;
                        $newAttr->product_id = $this->id;
                        $newAttr->save(false);
                    }
                }
                return true;
            }
            return false;
        }
        return false;
    }
}
