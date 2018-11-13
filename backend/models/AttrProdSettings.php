<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property string $attrString
 * @property string $viewAttr
 * @property string $viewOnWidget
 * @property int $attrList
 * @property int $attrColor
 * @property int $attrRank
 *
 */
class AttrProdSettings extends Model
{
    public $attrString;
    public $attrList;
    public $attrColor;
    public $viewAttr;
    public $viewOnWidget;
    public $attrRank;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attrList', 'attrColor', 'attrString', 'viewAttr', 'viewOnWidget',], 'safe'],
        ];
    }

}
