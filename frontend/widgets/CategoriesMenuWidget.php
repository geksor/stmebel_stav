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
            ->with(['child' => function (\yii\db\ActiveQuery $query) {
                $query
                    ->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC])
                    ->with(['child' => function (\yii\db\ActiveQuery $query) {
                        $query->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC]);
                    },]);
            },])
            ->all();

        $items = [];

        foreach ($models as $item){
            /* @var $item Category */
            $itemsChild = [];

            if ($item->child){
                foreach ($item->child as $itemChild){
                    /* @var $itemChild Category */
                    if ($itemChild->child){
                        foreach ($itemChild->child as $itemChildChild){
                            /* @var $itemChildChild Category */
                            $itemsChildChild[] = [
                                'label' => $itemChildChild->title,
                                'url' => $itemChildChild->url,
                            ];
                        }
                        $itemsChild[] = [
                            'label' => $itemChild->title,
                            'url' => $itemChild->url,
                            'items' => $itemsChildChild,
                        ];
                    }else{
                        $itemsChild[] = [
                            'label' => $itemChild->title,
                            'url' => $itemChild->url,
                        ];
                    }
                }
                $items[] = [
                    'label' => $item->title,
                    'url' => $item->url,
                    'items' => $itemsChild,
                ];

            }else{
                $items[] = [
                    'label' => $item->title,
                    'url' => $item->url,
                ];
            }
        }


        return $this->render('categoriesMenuWidget', [
            'items' => $items,
        ]);
    }
}