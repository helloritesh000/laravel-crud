<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all()
        //$posts = Post::orderBy('created_at', 'desc')->get()
        //$posts = Post::where('title', 'Post 2')->take(1)->get()
        //$posts = Post::orderBy('created_at', 'desc')->get()
        //$posts = Post::orderBy('created_at', 'desc')->paginate(1)
        //$posts = DB::select('SELECT * from posts')
        $data = array(
            'title' => 'Posts',
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10)
        ); 

        return view('posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => 'Create Post',
        ); 
        return view('posts.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        $data = array(
            'title' => 'Create Post',
            'success' => 'Post Created'
        ); 

        return redirect('/posts')->with('success', 'Post Created');
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array(
            'title' => 'Post',
            'post' => Post::find($id)
        ); 

        return view('posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'title' => 'Post',
            'post' => Post::find($id)
        ); 

        return view('posts.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if($post)
        {
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();
        }

        $data = array(
            'title' => 'Posts',
            'success' => 'Post Updated'
        ); 
        return redirect('/posts')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post)
        {
            $post->delete();
        }

        $data = array(
            'title' => 'Posts',
            'success' => 'Post Deleted'
        ); 
        return redirect('/posts')->with($data);
    }
}
