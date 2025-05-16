<?php
namespace frontend\controllers;
use yii\filters\auth\HttpBearerAuth;
use Yii;

class ActiveController extends \yii\rest\ActiveController
{
    public function behaviors(){
        $behaviours = parent::behaviors();
        $behaviours['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviours['authenticator']['authMethods'] = [
            HttpBearerAuth::class,
        ];
        return $behaviours;
    } 
    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'create') {
            return true;
        }
        if ($action === 'update') {
            return $model->created_by === Yii::$app->user->id;
        }
        if ($action === 'delete') {
            return $model->created_by === Yii::$app->user->id;
        }
        return parent::checkAccess($action, $model, $params);
    }
}
