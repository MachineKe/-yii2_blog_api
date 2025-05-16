<?php
namespace frontend\controllers;
use frontend\resource\Post;
class PostController extends ActiveController
{
    public $modelClass = Post::class;

    public function actions()
    {
        $actions = parent::actions();
        // Remove the default 'index' action if you want to customize it
        return $actions;
    }

    /**
     * Returns comments for a given post ID.
     * @param integer $id
     * @return \yii\data\ActiveDataProvider
     */
    public function actionComments($id)
    {
        return new \yii\data\ActiveDataProvider([
            'query' => \frontend\resource\Comment::find()->where(['post_id' => $id]),
        ]);
    }
 
   

    /**
     * Restrict update/delete to post owner
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete'])) {
            if ($model && $model->created_by != \Yii::$app->user->id) {
                throw new \yii\web\ForbiddenHttpException('You are not allowed to modify this post.');
            }
        }
    }
}
