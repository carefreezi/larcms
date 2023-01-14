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
use DateTimeInterface;

class Chat extends Model{
    protected $table= 'chat';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    public function chats()
    {
        return $this->hasMany(User::class,'id','from_id');
    }

    public function chats_to(){
        return $this->hasMany(User::class,'id','to_id');
    }

    public function chat_alls(){
        return $this->hasMany(get_class($this), 'group_id' ,'id')->join('user','chat.to_id','=','user.id')->select('chat.*');
    }

    public function chat_parent(){
        return $this->hasMany(get_class($this), 'id' ,'group_id')->select('chat.*');
    }
}
