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

class Specialmeta extends Model
{
    protected $table = "specialmeta";

    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany(Post::class,'id','post_id')->select(['author_id','content','create_time','id','isvip_level','likes','price','show_url','tags','title','view','vip_price','cover']);
    }
}
