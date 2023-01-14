<?php
/*
 * Copyright (c) 2021. The system is a commercial version of Larcms.
 * You cannot use or sell the system without authorization. The system has obtained copyright. If it is flooded or distributed and sold privately, it will be subject to legal sanctions
 * Author: Carefree
 * QQ No.: 869375583
 * Official website: www.nsmao.com
 * This account is the only author account, and others are fake
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comment';

    protected $primaryKey = 'id';

    public $timestamps = false;


    public function children() {
        return $this->hasMany(get_class($this), 'parent_id' ,'id')
            ->join('user','comment.user_id','=','user.id')
            ->join('post','post.id','=','comment.post_id')
            ->select('comment.*','user.name as userinfo','user.pic','post.title','post.id as post_id');
    }

    public function allChildren() {
        return $this->children()->with('allChildren');
    }

}
