<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Mood_update;
use Redirect;
use Auth;
use Log;
use App\Events\LikedPost;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->where('user_id', '=', Auth::id() );
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {

        $post = new Post;

        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);


    }

    public function showSinglePost($id)
    {

        $post = Post::find($id);

         if ($post == null) {

            return Redirect::route('welcome');


         }else{

            $post->clicks++;
            $post->update();

            $update = new Mood_update;
            $update->date_update = NOW();
            $update->post_id = $id;
            $update->mood_weight_id = 2;
            $update->status = 'pending';
            $update->save();

            return view('posts.single', ['post' => $post]);


         }



    }

    public static function likeSinglePost(Request $request)
    {


        $post = Post::find($request->id);

        if ($post == null) {

            return response()->json(['error' => 'not found post', 'id' => $request->id]);

        }else{

            $post->likes++;
            $post->update();

            $likes = $post->likes;

            $update = new Mood_update;
            $update->date_update = NOW();
            $update->post_id = $request->id;
            $update->mood_weight_id = 1;
            $update->status = 'pending';
            $update->save();

            // LikedPost::dispatch($post);

            event(new LikedPost($post));

            return response()->json(['success' => 'You Liked', 'likes' =>  '            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402m5.726-20.583c-2.203 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248-3.183 0-6.281 2.187-6.281 6.191 0 4.661 5.571 9.429 12 15.809 6.43-6.38 12-11.148 12-15.809 0-4.011-3.095-6.181-6.274-6.181"/></svg>'. ' ' .$likes, 'id' => $request->id]);

        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request)
    {

        $post = Post::find($request->post);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->update();

        return redirect()->route('posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $post = Post::destroy($id);

            return Redirect()->route('posts');
    }
}
