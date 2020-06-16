<?php


namespace app\api\route;

use think\facade\Route;

Route::rule("smscode","sms/code","POST");
Route::resource('user', 'User');
//Route::rule("login","login/index","POST");
//Route::rule("user","user/index","GET");
