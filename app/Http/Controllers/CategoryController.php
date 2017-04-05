<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Response;
use Log;


class CategoryController extends  Controller
{
    public function getCategoryIndex()
    {
        $categories=Category::orderBy('created_at','desc')->paginate(5);

        return view('admin.blog.categories',['categories'=>$categories]);
    }
    public function getCreateCategory(Request $request)
    {
        $category=new Category();
        $category->name=$request['name'];
        $category->save();
        return response()->json(['category'=>$category]);

    }

    public function getEditCategory(Request $request)
    {
        $category=Category::find($request['id']);
        return response()->json(['category'=>$category]);

    }
    public function getUpdateCategory(Request $request)
    {
        $category=Category::find($request['id']);
        $category->name=$request['name'];
        $category->update();
        $category=Category::find($request['id']);
        return response()->json(['category'=>$category]);

    }
    public function getDeleteCategory(Request $request)
    {
        Category::find($request['id'])->delete();
        return response()->json(['message'=>'Successfully deleted']);
    }


}