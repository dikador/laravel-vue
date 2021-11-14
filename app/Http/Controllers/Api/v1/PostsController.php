<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\Eloquent\Uploadable;
use Illuminate\Support\Facades\DB;
use Validator;

class PostsController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return Post::all();
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      //
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $img = $request->image;

      $validator = Validator::make(
         $request->all(),
         [
            "title" => "required",
            "image" => "required"
         ]
      );

      if ($validator->fails()) {
         return response()->json([
            "status" => false,
            "message" => $validator->messages()
         ]);
      }

      if (gettype($request->image) != "string") {
         $img = Uploadable::uploadFile($request->image);
      }

      $post = Post::create([
         "title" => $request->title,
         "image" =>  $img
      ]);

      return response()->json([
         "status" => true,
         "data" => $post
      ])->setStatusCode(201);
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

      if (!$post) {
         return response()->json([
            "status" => false,
            "message" => "Post not found"
         ])->setStatusCode(404);
      }
      return $post;
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
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

      if ($request->image) {
         $img = Uploadable::uploadFile($request->image);
         $post->update(['title' => $request->title, 'image' => $img]);
      } else {
         $post->update(['title' => $request->title]);
      }

      return response()->json([
         "status" => true,
         "post" => $post,
      ]);
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
      $post->delete();

      Uploadable::deleteFile($post->image);

      return request()->json([
         "status" => true,
         "post" => $post
      ]);
   }
}
