<?php
namespace app\controllers;

use app\models\Sermon;

class SermonController extends JsonController
{


    /**
     * @param $id
     * @return array
     * old url: /sermon/hit/#SermonId UpdateDownloadCounterR GET
     */
    public function actionHit($id)
    {
        $sermon = $this->findModel($id);
        $sermon->hits++;
        $sermon->save();
        return ['response' => 'ok'];
    }

    /**
     * @return array
     */
    public function actionList()
    {
        if(isset($_GET['query'])) {
            $queryData = $_GET['query'];
        } else {
            $queryData = \Yii::$app->request->post();
        }

        $sermons = Sermon::find();
        if(isset($queryData['groupCode'])) {
            $sermons = $sermons->joinWith('group')->andWhere(['group.code' => $queryData['groupCode']]);
        }
        if(isset($queryData['seriesName'])) {
            $sermons = $sermons->andWhere(['like', 'seriesName', $queryData['seriesName']]);
        }
        if(isset($queryData['title'])) {
            $sermons = $sermons->andWhere(['like', 'title', $queryData['title']]);
        }
        if(isset($queryData['speaker'])) {
            $sermons = $sermons->andWhere(['like', 'speaker', $queryData['speaker']]);
        }
        \Yii::error(var_dump($queryData));

        return $this->sermonList($sermons);
    }

    private function sermonList($query)
    {
        $ret = [];
        foreach($query->each() as $sermon) {
            /** @var Sermon $sermon */
            $item = [
                'title' => $sermon->title,
                'audio' => $sermon->files['audio'],
                'video' => $sermon->files['video'],
                'other' => $sermon->files['video'],
                'speaker' => $sermon->speaker,
                'seriesName' => $sermon->seriesName,
                //'scripture' => $sermon->scriptures['text']
            ];
            $ret[] = $item;
        }
        return $ret;
    }

    /**
     * old url: /api/sermons/insert SermonsInsertR POST
     */
    public function actionCreate()
    {
        //todo: check hmac

        $sermon = new Sermon();
        $post = \Yii::$app->request->post();
        if(empty($post)) {
            return "no input";
        }
        \Yii::error(var_dump($post));
        $sermon->title = $post['title'];
        $sermon->speaker = $post['speaker'];
        $sermon->date = $post['date'];
        $sermon->seriesName = $post['seriesName'];
        $sermon->files = $post['files'];
        $sermon->scriptures = $post['scriptures'];

        if ($sermon->save()) {
            \Yii::warning(var_dump($post));
            return ['response' => 'ok'];
        } else {
            \Yii::error(var_dump($post));
            throw new BadRequestHttpException($sermon->errors);
        }
    }



    /**
     * @param $id
     * @return Sermon
     */
    protected function findModel($id)
    {
        $sermon = Sermon::findOne($id);
        if ($sermon === null) {
            throw new NotFoundHttpException('The requested sermon does not exist.');
        }
        return $sermon;
    }
}
