<?php
namespace frontend\widgets;

use common\models\Comment;
use yii\base\Widget;

class ReviewsWidget extends Widget
{
    public function run()
    {
        $model = Comment::find()
            ->where(['done_at' => (integer) Comment::find()->max('done_at')])
            ->andWhere(['publish' => 1])
            ->one();

        return $this->render('reviewsWidget', [
            'model' => $model,
        ]);
    }
}