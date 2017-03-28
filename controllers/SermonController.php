<?php
namespace app\controllers;

use app\models\Sermon;

class SermonController extends MHController
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
        $query = [];
        $queryData = [];
        if(isset($_GET['query'])) {
            $queryData = $_GET['query'];
        } else {
            $queryData = \Yii::$app->request->post();
        }
        if(isset($queryData['groupCode'])) {
            $query['group.code'] = intval($queryData['groupCode']);
        }
        $sermons = Sermon::find()->joinWith('group')->where($query);
        return ['response' => $sermons->all()];
    }

    /**
     * old url: /api/sermons/insert SermonsInsertR POST
     */
    public function actionCreate()
    {
        $sermon = new Sermon();
        if ($sermon->load(\Yii::$app->request->post()) && $sermon->save()) {
            return ['response' => 'ok'];
        } else {
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
