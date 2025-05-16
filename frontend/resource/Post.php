<?php
namespace frontend\resource;

use common\models\Post as CommonPost;

class Post extends CommonPost
{
    

    public function extraFields()
    {
        return [
            'comments',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

}
