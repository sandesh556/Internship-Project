<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostEditFormRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsFormRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::all();
       return view('backend.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsFormRequest $request)
    {
         $user_id = Auth::user()->id;
         $post = new Post(array(
             'title'=>$request->get('title'),
             'content'=>$request->get('content'),
             'slug'=>str::slug($request->get('title'),'-'),
             'user_id'=>$user_id
         ));
         $post->save();
         $post->categories()->sync($request->get('categories'));
         return redirect('admin/posts/create')->with('status','A new post has been registered');

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
    public function edit($id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $categories = Category::all();
        $selectedCategories = $post->categories->pluck('id')->toArray();
        return view('backend.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditFormRequest $request, $id)
    {
         $post = Post::whereId($id)->firstOrFail();
         $post->title = $request->get('title');
         $post->content = $request->get('content');
         $post->slug = str::slug($request->get('title'),'-');
         $post->save();
         $post->categories()->sync($request->get('categories'));
         return redirect(action([PostsController::class,'edit'],$post->id))->with('status','Your post is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
