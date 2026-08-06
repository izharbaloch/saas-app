<?php

namespace App\Http\Controllers;

class SchoolClassController extends Controller
{
    public function index()
    {
        return view('school_classes.index');
    }
}
