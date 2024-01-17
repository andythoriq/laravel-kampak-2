<?php

namespace App\Http\Controllers;

class DefaultPageController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }
}
