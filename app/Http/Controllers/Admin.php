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


class Admin extends Controller
{
    public function admin()
    {
        return view('admin.index.index');

    }
    public function layout()
    {
        return view('admin.layout');

    }

    public function login()
    {
        return view('admin.login.login');

    }
    public function community()
    {
        return view('admin.community.community');

    }
}
