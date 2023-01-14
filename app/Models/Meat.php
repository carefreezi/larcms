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

class Meat extends Model
{
    protected $table = "meta";

    public $timestamps = false;


    public function goods()
    {
        return $this->hasMany(Post::class,'id','post_id')->select(['author_id','content','create_time','id','isvip_level','likes','price','show_url','tags','title','view','vip_price','cover']);
    }

    public function postGet(){
        return $this->hasMany(Post::class,'id','post_id')
            ->join('user','post.author_id','=','user.id')
            ->select(['post.author_id','post.content','post.create_time','post.id','post.isvip_level','post.likes','post.price','post.show_url','post.tags','post.title','post.view','post.vip_price','post.cover','user.id as user_id','user.name as user_info','user.pic']);
    }

    public function category(){
        return $this->hasMany(Top::class,'id','cate_id');
    }




}
