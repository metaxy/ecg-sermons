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
        $filter = \Yii::$app->request->getBodyParam('filter', []);
        $sort = \Yii::$app->request->getBodyParam('sort', []);
        $limit = \Yii::$app->request->getBodyParam('limit', 0);

        $sermons = Sermon::find();
        if(isset($filter['groupCode'])) {
            $sermons = $sermons->joinWith('group')->andWhere(['group.code' => $filter['groupCode']]);
        }
        if(isset($filter['seriesName'])) {
            $sermons = $sermons->andWhere(['like', 'seriesName', $filter['seriesName']]);
        }
        if(isset($filter['title'])) {
            $sermons = $sermons->andWhere(['like', 'title', $filter['title']]);
        }
        if(isset($filter['speaker'])) {
            $sermons = $sermons->andWhere(['like', 'speaker', $filter['speaker']]);
        }
        if($limit != 0) {
            $sermons = $sermons->limit($limit);
        }
        if(!empty($sort)) {
            $sermons = $sermons->orderBy($sort);
        }


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
                'date' => $sermon->date,
                'realDate' => $sermon->date,
                'scripture' => $sermon->scriptures['text'],
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
