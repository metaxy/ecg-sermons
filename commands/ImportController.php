<?php
namespace app\commands;

use app\helpers\Curl;
use app\models\Group;
use app\models\Sermon;
use yii\console\Controller;
class ImportController extends Controller
{

    public function actionImport()
    {
        Group::deleteAll();
        Sermon::deleteAll();

        $groups = ['predigt' => "Predigten", 'seminar' => "Gemeindeseminar", 'jugend' => "Jugend"];

        foreach($groups as $code => $name) {
            $group = new Group();
            $group->code = $code;
            $group->name = $name;
            if(!$group->save()) {
                print_r($group->errors);
            }
        }

        $m8 = ['1' => 'predigt', '2' => 'jugend', '3' => 'seminar'];
        foreach ($m8 as $id => $code) {
            $group = Group::findOne(['code' => $code]);

            $curl = new Curl();
            $data = $curl->get('http://hellersdorf-medien.ecg-berlin.de/sermons/json/'.$id);
            $data = json_decode($data, true);

            foreach($data as $item) {
                $sermon = new Sermon();
                $sermon->title = $item['title'];
                $sermon->date = $item['realDate'];
                $sermon->hits = $item['hits'];
                $sermon->speaker = $item['speaker'];
                //$sermon->language = [];
                $sermon->seriesName = $item['seriesName'];
                if(isset($item['scripture'])) {
                    $sermon->scriptures = [
                        'text' => $item['scripture'],
                        'order' => $item['scriptureData']
                    ];
                } else {
                    $sermon->scriptures = [];
                }


                //TODO make absolute
                $sermon->files = [
                    'audio' => $this->makeAbsolute($item['audio']),
                    'video' =>  $this->makeAbsolute($item['video']),
                    'other' => $this->makeAbsolute($item['other'])
                ];
                $sermon->groupId = $group->id;

                if(!$sermon->save()) {
                    print_r($sermon->errors);
                } else {
                    echo  $item['id'] ."\n";
                }
            }
        }
    }

    private function makeAbsolute($url)
    {
        if(startsWith('/', $url)) {
            return "http://ecg-berlin.de".$url;
        } else if(startsWith('http', $url)) {
            return $url;
        } else {
            return "http://ecg-berlin.de/".$url;
        }
    }
}
