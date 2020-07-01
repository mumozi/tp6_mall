<?php


namespace app\demo\route;
use think\facade\Route;

Route::rule("test","index/hello","GET");
Route::get('hello/:id', 'index/hello')
    ->model('id', '\app\common\model\mysql\AdminUser');


