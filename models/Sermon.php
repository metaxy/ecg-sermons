<?php

namespace app\models;

/**
 * Class Sermon
 * @package app\models
 *
 * @property integer $id
 * @property string $title
 * @property integer $groupId
 * @property string $languagesJson
 * @property array $languages
 * @property string $picture
 * @property string $notes
 * @property string $filesJson
 * @property array $files
 * @property array $scriptures
 * @property string $scripturesJson
 * @property string $date
 * @property integer $hits
 * @property string $seriesName
 * @property string $speaker
 *
 * @property Group $group
 *
 */

class Sermon extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'sermon';
    }
    public function rules()
    {
        return [
            [['title', 'speaker', 'groupId'], 'required'],
            [['title', 'languagesJson', 'picture', 'notes', 'speaker', 'seriesName'], 'string'],
            [['hits', 'groupId'], 'integer'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'groupId']);
    }

    public function getFiles()
    {
        $data = json_decode($this->filesJson, true);
        if ($data === false) {
            return [];
        }
        return $data;
    }
    public function setFiles($response)
    {
        $this->filesJson = json_encode($response);
    }
    public function getScriptures()
    {
        $data = json_decode($this->scripturesJson, true);
        if ($data === false) {
            return [];
        }
        return $data;
    }
    public function setScriptures($response)
    {
        $this->scripturesJson = json_encode($response);
    }

    public function getLanguages()
    {
        $data = json_decode($this->languagesJson, true);
        if ($data === false) {
            return [];
        }
        return $data;
    }
    public function setLanguages($response)
    {
        $this->languagesJson = json_encode($response);
    }
}
