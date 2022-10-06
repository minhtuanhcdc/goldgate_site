<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormController extends Controller
{
    public function formsaigon(){
        return Inertia::render('Form/FormThinSaigon');
    }
    public function formtudu(){
        return Inertia::render('Form/FormThinTudu');
    }
    public function formvigor(){
        return Inertia::render('Form/FormThinVigor');
    }
}
