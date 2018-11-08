<?php

namespace common\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "attributes".
 *
 * @property int $id
 * @property string $title
 * @property string $viewName
 * @property int $type (1 - string, 2 - list, 3 - color)
 *
 * @property AttrColor[] $attrColors
 * @property AttrList[] $attrLists
 * @property CategoryAttributes[] $categoryAttributes
 * @property Category[] $categories
 * @property ProductAttributes[] $productAttributes
 * @property Product[] $products
 */
class Attributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'viewName'], 'required'],
            [['type'], 'integer'],
            [['title', 'viewName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'viewName' => 'Отображаемое имя',
            'type' => 'Вид',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrColors()
    {
        return $this->hasMany(AttrColor::className(), ['attr_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getColorsDropDown()
    {
        $attrArr = ArrayHelper::toArray($this->attrColors);

        return ArrayHelper::map($attrArr, 'id', 'title');
    }

    /**
     * @return array
     */
    public function getListDropDown()
    {
        $attrArr = ArrayHelper::toArray($this->attrLists);

        return ArrayHelper::map($attrArr, 'id', 'title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrLists()
    {
        return $this->hasMany(AttrList::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttributes()
    {
        return $this->hasMany(CategoryAttributes::className(), ['attributes_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('category_attributes', ['attributes_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttributes::className(), ['attributes_id' => 'id']);
    }

    public function getAttrValue($id)
    {
        switch ($this->type){
            case 1:
                $val = ProductAttributes::find()
                    ->where(['product_id' => $id, 'attributes_id' => $this->id])
                    ->one();
                return $val->attrString;
            case 2:
                $listId = ProductAttributes::find()
                    ->where(['product_id' => $id, 'attributes_id' => $this->id])
                    ->one();
                $val = AttrList::findOne(['id' => $listId->attrList_id]);
                return $val->title;
            case 3:
                $colorId = ProductAttributes::find()
                    ->where(['product_id' => $id, 'attributes_id' => $this->id])
                    ->one();
                $val = AttrColor::findAll(['id' => json_decode($colorId->attrColor_id)]);
                return $val;

        }
        return null;
    }

    public function getValueFromDropDown($prod_id, $selectColumn, $json = null)
    {
        $model =  ProductAttributes::find()->where(['product_id' => $prod_id, 'attributes_id' => $this->id])->select($selectColumn)->one();
        if ($json && $model->$selectColumn){
            $return = [];
            foreach (json_decode($model->$selectColumn) as $item){
                $return[$item] = ['Selected' => true];
            }
            return $return;
        }
        return $model->$selectColumn;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_attributes', ['attributes_id' => 'id']);
    }
}
