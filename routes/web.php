<?php

use Illuminate\Support\Facades\Route;
use App\Models\Fruit;
use App\Http\Controllers\FruitController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/',function(){
    global $users;
    return $users;
});
Route::get('/users', function(){
    global $users;
    $userNames = [];
    foreach($users as $user){
        $userNames[] = $user['name'];
    }
    echo 'The users are: ' . implode(', ', $userNames);
});
Route::get('/myview/{user}', function ($user) {
    return view('home', ['username' => $user]);
});
Route::get('/fruits', function() {
    return Fruit::all();
});
Route::get('/showFruits', [FruitController::class, 'getFruits']);