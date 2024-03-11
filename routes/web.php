<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumlikeContoller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReplylikeController;
use App\Http\Controllers\ReplytoreplyController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/forums', [HomeController::class, 'forum'])->name('forum');
Route::get('/forum/create/{tag}', [ForumController::class, 'forumCreateId'])->name('forum.create.id');
Route::get('/notification', [ForumController::class, 'notification'])->name('notification');
Route::get('/filter', [FilterController::class, 'filter'])->name('filter');
Route::get('/filter-forum', [FilterController::class, 'filterForum'])->name('filter.forum');
Route::get('/search-product', [FilterController::class, 'searchProduct'])->name('search.product');
Route::put('/check{reply}', [ReplyController::class, 'check'])->name('check');

Route::get('/product-category', [CategoryController::class, 'catpro'])->name('catpro');
Route::get('/product-category/{branch}/{category}', [CategoryController::class, 'showpro'])->name('product-category.show');
Route::get('/product-punkt/{branch}/{tag}', [ProductController::class, 'showpunkt'])->name('product.showpunkt');

Route::get('/pricing', [DownloadController::class, 'price'])->name('price');
Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads');
Route::get('/credit', [ProductController::class, 'credit'])->name('credit');
Route::post('/product/{product}/like', [RateController::class, 'like'])->name('product.like');
Route::post('/product/{product}/save', [SaveController::class, 'save'])->name('product.save');
Route::post('/product/{product}/buy', [DownloadController::class, 'buy'])->name('product.buy');

Route::get('/news&article/create/{role}', [ArticleController::class, 'createTwo'])->name('na.create');

Route::get('/user-edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user-update/{user}', [UserController::class, 'update'])->name('user.update');

Route::middleware('can:suprame')->group(function () {
    Route::get('/admin', [UserController::class, 'admin'])->name('admin');
    Route::get('/byAdmin/user/{user}', [UserController::class, 'userEditByAdmin'])->name('user.edit.byadmin');
    Route::put('/byAdmin/user/update/{user}', [UserController::class, 'userUpdateByAdmin'])->name('user.update.byadmin');
    Route::delete('/byAdmin/user/delete/{user}', [UserController::class, 'userDeleteByAdmin'])->name('user.delete.byadmin');
});

Auth::routes();
Route::resources([
    'product' => ProductController::class,
    'tag' => TagController::class,
    'comment' => CommentController::class,
    'category' => CategoryController::class,
    'branch' => BranchController::class,
    'forum' => ForumController::class,
    'forumlike' => ForumlikeContoller::class,
    'reply' => ReplyController::class,
    'replylike' => ReplylikeController::class,
    'replytoreply' => ReplytoreplyController::class,
    'article' => ArticleController::class,
]);

Route::get('calculation', function(){ 
    return view('calculation');
})->name('calculation');