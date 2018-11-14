<?php

namespace frontend\widgets;

use common\models\Category;
use common\models\Product;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * Class ExamplesWidget
 *
 * $title (string)
 *
 * View from page title, default = 'Примеры домов'
 *
 * $category (int)
 *
 * Select product for the category, default = 0 (select all category)
 *
 * $limit (int)
 *
 * Limit for the product select, default = 2
 *
 * @package frontend\widgets
 *
 * @property string $title
 * @property int $category
 * @property int $limit
 */
class HouseWidget extends Widget
{
    public $title = 'Примеры домов';
    public $category = 0;
    public $limit = 2;

    /**
     * @return string
     */
    public function run()
    {
        $query = Product::find()
            ->limit($this->limit)
            ->orderBy(['rank' => SORT_ASC])
            ->where(['publish' => 1])
            ->with(['attributesOrder', 'productAttributesRank']);

        if ($this->category) {
            $category = Category::findOne($this->category);
            if ($category) {
                $prodIds = ArrayHelper::map($category->products, 'id', 'id');
                $models = $query->andWhere(['id' => $prodIds])->all();
            } else {
                $models = $query->all();
            }
        } else {
            $models = $query->all();
        }

        return $this->render('houseWidget', [
            'models' => $models,
            'title' => $this->title,
            'category' => $this->category,
        ]);
    }
}