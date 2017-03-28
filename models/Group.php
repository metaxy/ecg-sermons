<?php

namespace app\models;

/**
 * Class Group
 * @package app\models
 * @property string $name
 * @property string $code
 */
class Group extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'group';
    }

    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
        ];
    }
}
