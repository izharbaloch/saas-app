<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function index()
    {
        return view('class_subjects.index');
    }
}
