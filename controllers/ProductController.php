<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;


class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';


    public function beforeAction($action) 
    { 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
    }


    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => fn() => new ActiveDataProvider(
                [
                    'query' => $this->modelClass::find(),
                    'pagination' => false,
                ]
            ),
        ];

        return $actions;
    }
}
