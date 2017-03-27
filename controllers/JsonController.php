<?php
namespace app\controllers;

use yii\filters\Cors;
use yii\web\Controller;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\helpers\MhAuth;

class JsonController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
}
