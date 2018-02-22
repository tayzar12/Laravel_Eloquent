<?php
use App\User;
use App\Post;
use App\City;
use App\Comment;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/insert', function (){
    /*
    $user = new User();

    $user->name = "Tayzar";
    $user->email = "tza@gmail.com";
    $user->password = Hash::make('123123123');

    $user->save();
    */
    $pass = Hash::make('123123123');
    User::create(['name'=>'Lil Tayzar','email'=>'liltz@gmail.com','password'=>$pass]);

});

Route::get('/post/insert', function (){
    Post::create(['user_id'=>1,'title'=>'Fifth Post','content'=>'This is Fifth content']);
});

Route::get('/posts', function (){
    $posts = Post::all();

    foreach ($posts as $post){
        echo $post->title.'</br>'.$post->content.'<hr />';
    }

});

//for One To One relation
Route::get('/post/{id}/show', function ($id){
    $post = Post::find($id);

    echo $post->content.'</br>';

    echo $post->user->email;
});

//for HasMany relation
Route::get('/user/{id}/post', function ($id){
    $user = User::where('id',$id)->firstOrFail();
    echo $user->name.'</br>';

    foreach ($user->posts as $post){
        echo $post->title.'</br>';
    }
});

//for HasOne Relation
Route::get('/user/{id}/city', function ($id){
    $user = User::where('id',$id)->firstOrFail();

    echo $user->name.'</br>';
    echo $user->city->name;
});

//for ManyToMany Relation
Route::get('/user/{id}/role', function ($id){
   $user = User::find($id);

   echo $user->name.'</br>';
   foreach ($user->roles as $role){
       echo $role->rank.'</br>';
   }
});

//for HasManyThrough Relation
Route::get('/city/{id}/post', function ($id){
    $city = City::find($id);

    echo $city->name.'</br>';
    foreach ($city->posts as $post){
        echo $post->title.'</br>';
    }
});

//for Polymorphic Relation
Route::get('/user/{id}/comment', function ($id){
    $user = User::find($id);

    echo $user->name.'</br>';

    foreach ($user->comments as $comment){
        echo $comment->content.'</br>';
    }

});
Route::get('/post/{id}/comment', function ($id){
    $post = Post::find($id);

    foreach ($post->comments as $comment){
        echo $comment->content;
    }

});