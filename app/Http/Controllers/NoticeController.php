<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    //
    public function index(User $user)
    {
        $notices = $user->notices;
        return view("notice",compact('notices'));
    }
}
