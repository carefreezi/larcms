<?php
/*
 * Copyright (c) 2021-2021. The system is a commercial version of Larcms.
 * You cannot use or sell the system without authorization. The system has obtained copyright. If it is flooded or distributed and sold privately, it will be subject to legal sanctions
 * Author: Carefree
 * QQ No.: 869375583
 * Official website: www.nsmao.com
 * This account is the only author account, and others are fake
 */

namespace App\Http\Controllers;

use App\Models\Meat;
use App\Models\Post;
use App\Models\Topurl;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Top;

class Header extends Controller
{

    public function headGet()
    {
        $list = Top::with('allChildren')->where('parent_id', null)->orderBy('id','DESC')->get();
        return response()->json(['data' => $list, 'status' => 200], 200);
    }

    public function topUrl()
    {
        $list = Topurl::get();
        return response()->json(['data' => $list, 'status' => 200], 200);
    }
}
