<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(['middleware'=>['web']],function ()
{
    /*POST ROUTES*/

    Route::get('/',[
     'uses'=>'PostController@getBlogIndex',
        'as'=>'blog.index'
    ]);
    Route::get('/blog',[
        'uses'=>'PostController@getBlogIndex',
        'as'=>'blog.index'
    ]);
    Route::get('/blog/{post_id}&{end}',[
        'uses'=>'PostController@getSinglePost',
        'as'=>'blog.single'
    ]);

    /*About ROUTES*/

    Route::get('/about',function ()
    {
        return view('frontend.other.about');
    })->name('about');

    /*CONTACT ROUTES*/

    Route::get('/contact',[
       'uses'=>'ContactController@getContactIndex',
        'as'=>'contact'
    ]);
    Route::post('/contact/sendmail',[
        'uses'=>'ContactController@postSendMessage',
        'as'=>'contact.send'
    ]);
    /*LOGIN  LOGIN  LOGIN  LOGIN  LOGIN  */

    Route::get('admin/login',[
       'uses'=>'AdminController@getLogin',
        'as'=>'admin.login'
    ]);
    Route::post('admin/login',[
        'uses'=>'AdminController@postLogin',
        'as'=>'admin.login'
    ]);


    /*ADMIN*/

    Route::group(['prefix'=>'/admin','middleware'=>'auth' ],function()
    {
        Route::get('/',[
           'uses'=>'AdminController@getIndex',
            'as'=>'admin.index'
        ]);
        Route::get('/logout',[
            'uses'=>'AdminController@getLogout',
            'as'=>'admin.logout'
        ]);
        /*POSTS POSTS POSTS POSTS POSTS*/
        Route::get('/blog/posts/',[
            'uses'=>'PostController@getPostIndex',
            'as'=>'admin.blog.index'
        ]);
        Route::get('/blog/posts/{post_id}&{end}',[
            'uses'=>'PostController@getSinglePost',
            'as'=>'admin.blog.post'
        ]);

        Route::get('/blog.post.create',[
            'uses'=>'PostController@getCreatePost',
            'as'=>'admin.blog.create_post'
        ]);
        Route::post('/blog.post.create',[
            'uses'=>'PostController@postCreatePost',
            'as'=>'admin.blog.post.create'
        ]);
//        Route::get('/blog/post/ajax',[
//            'uses'=>'PostController@ajaxGetCreatePost',
//            'as'=>'admin.blog.post.ajax'
//        ]);

        Route::get('/blog.post/{post_id}/edit',[
            'uses'=>'PostController@getUpdatePost',
            'as'=>'admin.blog.post.edit'
        ]);
        Route::post('/blog.post.update',[
            'uses'=>'PostController@postUpdatePost',
            'as'=>'admin.blog.post.update'
        ]);
        Route::get('/blog.post/{post_id}/delete',[
            'uses'=>'PostController@getDeletePost',
            'as'=>'admin.blog.post.delete'
        ]);
        /*CATEGORIES CATEGORIES CATEGORIES CATEGORIES*/

        Route::get('/blog/categories',[
            'uses'=>'CategoryController@getCategoryIndex',
            'as'=>'admin.blog.categories'
        ]);
        Route::get('/blog/category/create',[
            'uses'=>'CategoryController@getCreateCategory',
            'as'=>'admin.blog.category.create'
        ]);
        Route::get('/blog/category/edit',[
            'uses'=>'CategoryController@getEditCategory',
            'as'=>'admin.blog.category.edit'
        ]);
        Route::get('/blog/category/update',[
            'uses'=>'CategoryController@getUpdateCategory',
            'as'=>'admin.blog.category.update'
        ]);
        Route::get('/blog/category/delete',[
            'uses'=>'CategoryController@getDeleteCategory',
            'as'=>'admin.blog.category.delete'
        ]);
        /* CONTACT MESSAGES CONTACT MESSAGES CONTACT MESSAGES CONTACT MESSAGES */
        Route::get('/contact/messages',[
            'uses'=>'ContactController@getContactMessageIndex',
            'as'=>'admin.contact.index'
        ]);
        Route::get('/contact/messages/delete',[
            'uses'=>'ContactController@getDeleteContactMessage',
            'as'=>'admin.contact.delete'
        ]);

    });

});




