<?php

namespace App\Http\Controllers\ServiceTest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceTestController extends Controller
{
    //
    public function index()
    {
        $app = app();
        $s = $app->make('instanceService');
        dd($s->say());
    }
}
