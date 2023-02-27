<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Storage;

class PostController extends Controller
{
    //Create Home Page
    function home(){
        $posts = Post::when(request('searchKey'),function($p){

            $key = request('searchKey');
            $p->where('title','like','%'.$key.'%');

        })->orderBy('created_at','desc')->paginate(3);

        return view('create',compact('posts'));
    }

    //Create Post
    function create(Request $req){

      // Check Validation Call
        $this->checkValidation($req);

       $data = $this->getPostData($req);

       if($req->hasfile('postImage')){

            $imageName = uniqid() . $req->file('postImage')->getClientOriginalName();

            $req->file('postImage')->storeAs('public',$imageName);

            $data['image']=$imageName;

      }

        Post::create($data);
        return back()->with(['success'=>'Post created successfully !']);
    }

    // Read Post
    function read($id){
        $posts =Post::find($id)->toArray();
        return view('read',compact('posts'));
    }

    // Delete Post

    function delete($id){

        // Image Delete From my porject
        $imageDelete = Post::select('image')->where('id',$id)->first()->toArray();
        $imageDelete = $imageDelete['image'];

        if($imageDelete != null ){
            Storage::delete(['public/' . $imageDelete]);
        }

        // All Data Delete from Database
        Post::find($id)->delete();

        return back()->with(['success'=>'Post deleted successfully !']);
    }

    // Update Post
    function update(Request $req){

        // Check Validation Call
        $this->checkValidation($req);

        $updateData = $this->getPostData($req);

        if($req->hasfile('postImage')){
            // Old Image Delete
            $oldImageName = Post::select('image')->where('id',$req->postId)->first()->toArray();
            $oldImageName = $oldImageName['image'];

            if($oldImageName != null){
                Storage::delete(['public/' . $oldImageName ]);
            }

            // New Image Upload
            $updateImageName = uniqid() . $req->file('postImage')->getClientOriginalName();
            $req->file('postImage')->storeAs('public',$updateImageName);
            $updateData['image'] = $updateImageName;
        }

        $id = $req->postId;
        Post::where('id',$id)->update($updateData);

        return redirect()->route('post#home')->with(['success'=>'Post updated successfully !']);
    }

    // Edit Post
    function edit($id){
        $posts=Post::find($id)->toArray();
        return view('edit',compact('posts'));
    }

    // Get Post Data
    // Update Data
    private function getPostData($req){
        return [
            'title'=>$req->postTitle,
            'description'=>$req->postDescription,
            'image'=>$req->postImage
        ];
    }

    // Check Validation
    private function checkValidation($req){
        $requiredRules=[
            'postTitle'=>'required|min:5|unique:posts,title,'.$req->postId,
            'postDescription'=>'required|min:10',
            'postImage'=>'required|mimes:jpg,jpeg,png'
        ];

        Validator::make($req->all(),$requiredRules)->validate();
    }
}
