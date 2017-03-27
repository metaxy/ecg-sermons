<?php
namespace app\commands;

use app\models\Note;
use app\models\Person;
use yii\console\Controller;
use app\helpers\Curl;

class DemoController extends Controller
{

    public function actionCreatePeople()
    {
        Person::deleteAll(['NOT IN', 'id', [1]]);
        $curl = new Curl();
        $resp = $curl->get('https://randomuser.me/api/', ['nat' => 'de', 'results' => 50]);
        $data = json_decode($resp);

        foreach ($data->results as $item) {
            $person = new Person();
            $person->firstName = ucfirst($item->name->first);
            $person->lastName = ucfirst($item->name->last);
            if ($item->gender == 'male') {
                $person->gender = 'm';
            } else {
                $person->gender = 'f';
            }
            $person->email = $item->email;
            $person->birthday = date('Y-m-d', strtotime($item->dob));
            $person->avatarUrlSmall = $item->picture->thumbnail;
            $person->avatarUrlMedium = $item->picture->medium;
            $person->avatarUrlBig = $item->picture->large;
            if (!$person->save()) {
                print_r($person->errors);
            }
        }
    }

    public function actionGetNotes($uid)
    {
        $person = Person::find()
            ->with('notes')
            ->where(['uid'=>$uid])
            ->all();
        $notes = $person[0]->notes;

        foreach ($notes as $note) {
            // $ret[] = $note->toResponseArray();
            $p = \app\models\PersonNote::findOne(['note_id'=>$note->id]);
            var_dump($p->person->uid);
        }

        var_dump(defined('YII_ENV'));
    }
}
