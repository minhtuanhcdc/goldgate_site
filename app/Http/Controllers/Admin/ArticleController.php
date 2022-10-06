<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Article;
use App\Models\Category;
use Inertia\Inertia;
use App\Actions\UploadFile;
use Illuminate\Support\Facedes\Storage;
use Illuminate\Support\Facades\Gate;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Articles/Index',[
            'can' => [
                    'create' => Auth::user()->checkPermissionAccess(config('permissions.access.create-article')),
                    'edit' => Auth::user()->checkPermissionAccess(config('permissions.access.edit-article')),
                    'delete' => Auth::user()->checkPermissionAccess(config('permissions.access.delete-article')),
                    'view' => Auth::user()->checkPermissionAccess(config('permissions.access.list-article')),

                ],
            'articles'=>ArticleResource::collection(Article::with(['category'])->Paginate(10)),
            //'can'=>Gate::allows('list-article')
            ]);

        // if(Gate::allows('list-article')){
        // return Inertia::render('Articles/Index',[
        //     'articles'=>ArticleResource::collection(Article::with(['category'])->Paginate(10))
        //     ]);
        // }
        // else{
        //     return redirect()->route('categories.index')->with('success', 'Ban kg co quyen vao');
        //   }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return use PDF;,[
        //     'edit'=>false,
        //     'categories'=>CategoryResource::collection(Category::select(['id','name'])->get()),
        //     'articles'=>new ArticleResource(new Article())
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UploadFile $uploadeFile)
    {
        //dd($request->all());
       $data=$request->validate([
        'title'=>['required','string'],
        'id_category'=>['required',Rule::exists(Category::class, 'id')],
        'image'=> ['required', 'image'],
        'description'=>['required','string'],
        'slug'=>['required', Rule::unique(Article::class)],
       ]);
       //dd($data);
       $data['image']=$uploadeFile->setFile($request->file('image'))
        ->setUploadPath((new Article())->uploadFolder())
        ->execute();

       Article::create($data);
       return redirect()->route('articles.index')->with('success','Add article successfully!');
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
    public function edit(Article $article)
    {

        return Inertia::render('Articles/Create',[
            'edit'=>true,
            'article'=>new ArticleResource($article),
            'categories'=>CategoryResource::collection(Category::select(['id','name'])->get()),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article, UploadFile $uploadFile)
    {
        //dd($request->all());
        $data = $request->validate([
            'id_category' => ['required', Rule::exists(Category::class, 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', Rule::unique(Article::class)->ignore($article->id)],
            'image' => ['nullable', 'image', 'max:3000'],
            'description' => ['required', 'string'],
        ]);

        $data['image'] = $article->image;
        if ($request->file('image')) {
            $article->deleteImage();

            $data['image'] = $uploadFile->setFile($request->file('image'))
                ->setUploadPath($article->uploadFolder())
                ->execute();
        }

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
    //dd($article);
       $article->delete();

       return redirect()->route('articles.index')->with('success', "Article deleted successfully!");
    }
}
