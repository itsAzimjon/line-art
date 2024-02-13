<?php

use App\Http\Controllers\CategoryContoller;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/forums', [HomeController::class, 'forum'])->name('forum');
Route::get('/filter', [FilterController::class, 'filter'])->name('filter');

Route::get('/pricing', [DownloadController::class, 'price'])->name('price');
Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads');
Route::get('/credit', [ProductController::class, 'credit'])->name('credit');
Route::post('/product/{product}/like', [RateController::class, 'like'])->name('product.like');
Route::post('/product/{product}/save', [SaveController::class, 'save'])->name('product.save');
Route::post('/product/{product}/buy', [DownloadController::class, 'buy'])->name('product.buy');

Auth::routes();
Route::resources([
    'product' => ProductController::class,
    'tag' => TagController::class,
    'comment' => CommentController::class,
    'category' => CategoryController::class,
    'forum' => ForumController::class,
    'forumlike' => ForumlikeContoller::class,
    'reply' => ReplyController::class,
    'replylike' => ReplylikeController::class,
    'replytoreply' => ReplytoreplyController::class,
]);