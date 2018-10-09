<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$post = Post::with('category')->find(5);
        //return view('admin.posts.index')->with('posts', $post);

        //$posts = Post::all();
        $posts = Post::paginate(2);
        return view('admin.posts.index',compact('posts'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::lists('name','id')->all(); // this is important in order to make a select statement in blade
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $input = $request->all();
        $user = Auth::user(); //get logged in user

        if($file = $request->file('photo_id')) {
            $name =time(). $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        return redirect('/admin/posts');
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
        //
        $post = Post::findOrFail($id);
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
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
        //
        $input= $request->all();



        if($file = $request->file('photo_id')) {
            $name =time(). $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        // get users posts and return the first one that matches the id that we sent.
        // any way we edit one post at a time that's why we return the firstone and update it
        // all in one line!!! Retrieve and Update
        Auth::user()->posts()->whereId($id)->first()->update($input);




        return redirect('/admin/posts');
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

        $post = Post::findOrFail($id);
        if($post->photo){
            unlink(public_path().$post->photo->file);
        }

        Session::flash('deleted_post','Post with title: "'.$post->title.'" has been deleted');
        $post->delete();

        return redirect('admin/posts');
    }
    /*
     *
     *
     *
     *
     */
    public function post($slug){
        $post = Post::findBySlugOrFail($slug);

        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post',compact('post','comments'));


    }
}
