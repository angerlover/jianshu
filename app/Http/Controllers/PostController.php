<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * 文章列表页
     */
    public function lst()
    {
        return view('lst');
    }


}
