<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    //
    public function index()
    {
        $notices = \App\Notice::all();

        return view('admin.notices',compact('notices'));
    }

    public function create()
    {

        return view('admin.addnotice');
    }

    public function store()
    {
        $this->validate(request(),[
            'title' => 'required|min:3',
            'content' => 'required'
        ]);

        $notice = \App\Notice::create(request()->all());

        // 分发
        dispatch(new \App\Jobs\SendMessage($notice));

        return redirect('admin/notice');
    }
}
