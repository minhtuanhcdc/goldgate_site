<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Classes;
use App\Http\Resources\ClassResource;

class ClassesController extends Controller
{
    public function getClass(){
        $classes = ClassResource::collection(Classes::get());
        return $classes;
           


    }
}
