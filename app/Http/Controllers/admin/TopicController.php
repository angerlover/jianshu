<?php

namespace App\Http\Controllers\admin;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * 列表展示页面
     */
    public function index()
    {
        $topics = \App\Topic::all();
        return view('admin.topiclist',compact('topics'));
    }

    /**
     * 添加展示页面
     */
    public function create()
    {
        return view('admin.addtopic');
    }

    /**
     * 添加的行为
     */
    public function store()
    {
        // 验证
        $this->validate(request(),[
           ['name' => 'required|min:1']
        ]);

        // 入库
        if(\App\Topic::create(request()->all()))
        {
            return redirect('admin/topic');
        }

    }

    /**
     * 删除行为
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return [
          'error' => 0,
            'msg' => ''
        ];
    }
}
