<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    // 搜索
    public function search()
    {
        // 验证
        $this->validate(request(),[
           'query'=>'required',
        ]);

        $query = request('query');
        $articles = \App\Article::search($query)->paginate(5);
        return view('search',compact('query','articles'));
    }
}
