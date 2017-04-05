<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller
{
    public function getBlogIndex()
    {
        $posts=Post::paginate(3);
        foreach ($posts as $post) {
            $post->body=$this->shortenText($post->body,60);
        }
        return view('frontend.blog.index',['posts'=>$posts]);
    }
    public function getPostIndex()
    {
        $posts=Post::paginate(5);
        return view('admin.blog.index',['posts'=>$posts]);
    }

    public function getSinglePost($post_id,$end='frontend')
    {
        $post=Post::find($post_id);
//        if(!$post)
//        {
//            return redirect()->route('blog.index')->with(['fail'=>'Post not found']);
//        }
        $this->checkPost($post);
        $post_categories=$post->categories;
        return view( $end.'.blog.single',['post'=>$post,'post_categories'=>$post_categories]);
    }
    public function getUpdatePost($post_id)
    {
        $post=Post::find($post_id);
        $this->checkPost($post);
        $categories=Category::all();
        $post_categories=$post->categories;
        $post_categories_ids=array();
        $i=0;
        foreach ($post_categories as $post_category)
        {
            $post_categories_ids[$i]=$post_category->id;
            $i++;
        }
        return view('admin.blog.edit_post',['post'=>$post,'categories'=>$categories,'post_categories'=>$post_categories,'post_categories_ids'=>$post_categories_ids]);
    }
    public function postUpdatePost(Request $request)
    {
         $this->validate($request,[
            'title'=>'required|max:120',
            'author'=>'required|max:80',
            'body'=>'required'
         ]);
         $post=Post::find($request['post_id']);
         $post->title=$request['title'];
        $post->author=$request['author'];
        $post->body=$request['body'];
        $post->update();
        $post->categories()->detach();
        if(strlen($request['categories'])>0)
        {
            $categoriesIds=explode(' ',$request['categories']);
            foreach ($categoriesIds as $categoriesId)
            {
                $post->categories()->attach($categoriesId);
            }
        }

        return redirect()->route('admin.index')->with(['success'=>"Post successfully updated"]);
    }
    public function getCreatePost()
    {
        $categories=Category::all();
        return view('admin.blog.create_post',['categories'=>$categories]);
    }
    public function postCreatePost(Request $request)
    {
        $this->validate($request,[
           'title'=>'required|max:120|unique:posts',   //trazi u tabeli posts kolonu tittle i gleda da li je jedinstven.
            'author'=>'required|max:80',
            'body'=>'required'
        ]);

        $post=new Post();
        $post->title=$request['title'];
        $post->author=$request['author'];
        $post->body=$request['body'];
        $post->save();
        if(strlen($request['categories'])>0)
        {
            $categoriesIds=explode(' ',$request['categories']);
            foreach ($categoriesIds as $categoriesId)
            {
                $post->categories()->attach($categoriesId);
            }
        }

        return redirect()->route('admin.index')->with(['success'=>'Post successfully created']);

    }
//    public function ajaxGetCreatePost(Request $request)
//    {
//        $this->validate($request,[
//            'title'=>'required|max:120|unique:posts',   //trazi u tabeli posts kolonu tittle i gleda da li je jedinstven.
//            'author'=>'required|max:80',
//            'body'=>'required'
//        ]);
//
//        $post=new Post();
//        $post->title=$request['title'];
//        $post->author=$request['author'];
//        $post->body=$request['body'];
//        $post->save();
//
//
//
//        //logic for attaching categories
//
//        return response();
//
//    }
    public function getDeletePost($post_id)
    {
        $post=Post::find($post_id);
        $this->checkPost($post);
        $post->delete();
        return redirect()->route('admin.index')->with(['success'=>'Post successfully deleted']);

    }
    private function shortenText($text,$words_count)
    {
        if(str_word_count($text,0)>$words_count)
        {
            $words=str_word_count($text,2);
            $pos=array_keys($words);
            $text=substr($text,0,$pos[$words_count])."...";
        }
        return $text;
    }
    private function checkPost($post)
    {
        if(!$post)
        {
            return redirect()->route('blog.index')->with(['fail'=>'Post not found']);
        }
    }

}