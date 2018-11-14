<?php
namespace frontend\widgets;

use common\models\Comment;
use yii\base\Widget;

class ReviewsWidget extends Widget
{
    public function run()
    {
        $query = Comment::find()->where(['publish' => 1]);
        $queryMax = clone $query;

        $model = $query
            ->andWhere(['done_at' => (integer) $queryMax->max('done_at')])
            ->one();

        return $this->render('reviewsWidget', [
            'model' => $model,
        ]);
    }
}