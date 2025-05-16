<?php
namespace frontend\controllers;
use frontend\resource\Comment;
class CommentController extends ActiveController
{
 public $modelClass = Comment::class;
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $query = Comment::find();
        $postId = \Yii::$app->request->get('postid');
        if ($postId !== null) {
            $query->andWhere(['post_id' => $postId]);
        }
        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }
    
}
