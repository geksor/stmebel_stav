<?php
namespace frontend\widgets;

use common\models\Category;
use yii\base\Widget;

class CategoriesMenuWidget extends Widget
{
    public function run()
    {
        $models = Category::find()
            ->where(['parent_id' => 0, 'publish' =>1])
            ->orderBy(['rank' => SORT_ASC])
            ->with('child')
            ->all();

        $items = [];

        foreach ($models as $model){
            if ($model->child){
                $itemsChild = [];
                foreach ($model->child as $item){
                    /* @var $item Category */
                    $itemsChild[] = [
                        'label' => $item->title,
                        'url' => [
                            'catalog/index',
                            'alias' => $model->alias,
                            'child' => $item->alias,
                        ],
                        'options' => ['class' => 'nav-item catalogMenu__navItem'],
                    ];
                }
                $items[] = [
                    'label' => $model->title,
                    'template' => '<span class="nav-link px-1 catalogMenu__itemHeader" style="cursor: default">{label}</span>',
                    'items' => $itemsChild,
                ];
            }
        }

        return $this->render('categoriesMenuWidget', [
            'items' => $items,
        ]);
    }
}