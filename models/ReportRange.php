<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property date $dateStart
 * @property date $dateEnd

 */

class ReportRange extends Model
{

    public $dateStart;
    public $dateEnd;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateStart', 'datEend'], 'required'],
            [['dateStart'], 'safe'],
            [['datEend'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dateStart' => 'Начальная дата',
            'dateEnd' => 'Конечная дата',
        ];
    }
}
