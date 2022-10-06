<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Imports\ProvinceImport;
use App\Imports\DistrictImport;
use App\Imports\CustommerImport;
use App\Imports\WardImport;
use App\Imports\ResultImport;
use App\Imports\OusentImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    // public function importProvince(Request $request)
    // {
    //    // dd($request->file);

    //     Excel::import(new ProvinceImport, $request->file);

    //     return back()->withInput()->with('success','Add  successfully!');
    // }
    public function importcustommers(Request $request)
    {

       Excel::import(new CustommerImport, $request->file);
        //(new CustommerImport)->import($request->file);

        return back()->withInput()->with('success','Add  successfully!');


    }
    public function importDistrict(Request $request)
    {

        Excel::import(new DistrictImport, $request->file);

        return back()->withInput()->with('success','Add  successfully!');
    }
    public function importWard(Request $request)
    {

      $array = Excel::import(new WardImport, $request->file);

        return back()->withInput()->with('success','Add  successfully!');
    }
    public function importResult(Request $request)
    {
       //dd($request->file);
      $array = Excel::import(new ResultImport, $request->file);

        return back()->withInput()->with('success','Add  successfully!');
    }
    public function importOusent(Request $request)
    {
       //dd($request->file);
      $array = Excel::import(new OusentImport, $request->file);

        return back()->withInput()->with('success','Add  successfully!');
    }
}
