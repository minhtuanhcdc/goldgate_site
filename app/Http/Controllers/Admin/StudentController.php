<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use App\Http\Resources\StudentResource;
use App\Http\Resources\ClassResource;
use App\Http\Resources\SectionResource;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    public function index(){
       
        $pagination = request('p','5');
        $search_term = request('q','');
        $selectedClass = request('selectedClass','');
        $selectedSection = request('selectedSection','');

        $classes = ClassResource::collection(Classes::get());
        $sections = SectionResource::collection(Section::distinct()->get());


    return Inertia::render('Admin/Student/index',[
        // 'can' => [
        //     'create' => Auth::user()->checkPermissionAccess(config('permissions.access.create-category')),
        //     'edit' => Auth::user()->checkPermissionAccess(config('permissions.access.edit-category')),
        //     'delete' => Auth::user()->checkPermissionAccess(config('permissions.access.delete-category')),
        //     'view' => Auth::user()->checkPermissionAccess(config('permissions.access.list-category')),
            
        // ],
        'students'=>StudentResource::collection(Student::
        when($selectedClass, function($query) use ($selectedClass){
            $query->where('class_id',$selectedClass);
        })
        ->when($selectedSection, function($query) use ($selectedSection){
            $query->where('section_id',$selectedSection);
        })
        ->search(trim($search_term))
        ->get()),
        'classes'=>$classes,
        'sections'=>$sections,
        
       
         ]);
     
   
    }
    public function destroy(Student $student)
    {
        
        $student->delete();

        return redirect()->route('student')->with('success', "Deleted successfully!");
    }

    public function massdetroy($students){
       
        $studentArray = explode(',',$students);
        dd($studentArray);
        Student::whereKey($studentArray)->delete();
        return redirect()->route('student')->with('success', "Deleted successfully!");
    
    }

    
}
