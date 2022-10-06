<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ouread;
class CheckCodeController extends Controller
{
    public function checkcodeouread(Request $rq){
        if($rq->codeSearch==12){
            return $resulSearch = true;
        }
        else
        return false;
    }
}
