<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property string $attrString
 * @property string $viewAttr
 * @property int $attrList
 * @property int $attrColor
 *
 */
class AttrProdSettings extends Model
{
    public $attrString;
    public $attrList;
    public $attrColor;
    public $viewAttr;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attrList', 'attrColor', 'attrString', 'viewAttr',], 'safe'],
        ];
    }

}
