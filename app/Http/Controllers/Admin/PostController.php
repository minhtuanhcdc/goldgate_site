<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(){

        $posts = Post::get();
       return Inertia::render('Admin/Post/index',[
           'posts'=>$posts
       ]);

    }

    public function show($id){
        $post = Post::find($id);

    
       
        if (auth()->user()->can('view', $post)) {
            return Inertia::render('Admin/Post/show',[
                'post'=>$post
                ]);
        }else{
            return redirect()->route('posts')->with('success', 'Ban kg co quyen vao');
        }
     
      
      
           
    }
}
