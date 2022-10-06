<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

use Inertia\Inertia;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facedes\Storage;
use Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        return Inertia::render('Categories/Index',[
            'can' => [
                'create' => Auth::user()->checkPermissionAccess(config('permissions.access.create-category')),
                'edit' => Auth::user()->checkPermissionAccess(config('permissions.access.edit-category')),
                'delete' => Auth::user()->checkPermissionAccess(config('permissions.access.delete-category')),
                'view' => Auth::user()->checkPermissionAccess(config('permissions.access.list-category')),
                
            ],
            'categories'=>CategoryResource::collection(Category::simplePaginate(10)),
            
        ]);
        // if(Gate::allows('list-category')){
        //     return Inertia::render('Categories/Index',[
        //         'categories'=>CategoryResource::collection(Category::simplePaginate(10)),
        //         'view'=>true
        //     ]);
        // }
        // else{
        //   abort(403);
        // }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('create-category')){
            return Inertia::render('Categories/Create');
        }
        else{
            return redirect()->route('categories.index')->with('failure', ' Bạn không được tạo Category');
        }
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', Rule::unique(Category::class)],
        ]);
     Category::create($data);

     return redirect()->route('categories.index')->with('success', ' Category saved successfully');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
       // $this->authorize('update', $category);
        
        return Inertia::render('Categories/Create',[
            'edit'=> true,
            'category'=>new CategoryResource($category)
        ]);
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category){
    
        $data=$request->validate([
            'name'=>['required','string'],
            'slug'=>['required','string',Rule::unique(Category::class)->ignore($category->id)],
        ]);
        $category->update($data);
         return redirect()->route('categories.index')->with('cussess','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Gate::allows('delete-category'))
        { 
        $category->delete();
        return redirect()->route('categories.index')->with('failure', "Category deleted successfully!");
        }
        else{
            return back()->withInput()->with('failure', "Ban khong duoc phep xoa");
        }
    }
}
