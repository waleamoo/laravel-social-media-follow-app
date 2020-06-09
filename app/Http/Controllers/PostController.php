<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function getUserDashboard(){
        //$posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return \view('pages.dashboard', ['posts' => $posts]);
    }


    public function postCreatePost(Request $request){

        $this->validate($request, [
            'body' => 'required|min:3'
        ]);

        $post = new Post();
        $post->body =  $request['body'];
        if($request->user()->posts()->save($post)){
            return \redirect()->route('userDashboard')->with('success', 'Post created');
        }
        return \redirect()->route('userDashboard')->with('error', 'Post could not be created');
    }

    public function getDelete($id){
        //$post = Post::find($id);
        $post = Post::where('id', $id)->first();
        if(Auth::user() != $post->user){
            return \redirect()->back();
        }
        $post->delete();
        return \redirect()->route('userDashboard')->with('success', 'Post deleted');
    }

    public function postEditPost(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);
        
        $post = Post::find($request['postId']);
        // validate user 
        if(Auth::user() != $post->user){
            return \redirect()->back();
        }
        
        $post->body = $request['body'];
        $post->update();
        return \response()->json(['new_body' => $post->body], 200);
    }
}
