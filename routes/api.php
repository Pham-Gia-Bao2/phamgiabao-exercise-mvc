<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Type\Integer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Group route
Route::prefix('/user')->group(function(){
    //get all users
    Route::get('/user', function () {
        global $users;
        return response()->json($users);
        // return $users;
    });
    //get user by indexx
    Route::get('/user/{userIndex}', function ($userIndex) {
        global $users;
        if (isset ($users[$userIndex])) {
            return $users[$userIndex];
        } else {
            echo 'Cannot find this user with index ' . $userIndex;
        }
    })->where('userIndex', '[0-9]+')->name('getByUserIndex');
    // get user by name
    Route::get('/user/{userName}', function ($userName) {
        global $users;
        $count = 0;
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['name'] === $userName) {
                return $users[$i];
            }
        }
        if (!$count) {
            echo 'Cannot find this user with name ' . $userName;
        }
    })->where('userName', '[a-zA-Z]+')->name('getByUserName');
     // Fallback route
     Route::fallback(function () {
        return response()->json(['error' => 'You cannot get a user like this!'], 404);
    })->name('fall_back');
    //get post
    Route::get('/{userIndex}/post/{postIndex}', function ($userIndex, $postIndex){
        global $users;
        // Check if userIndex and postIndex are numeric
        if (!is_numeric($userIndex) || !is_numeric($postIndex)) {
            return response()->json(['error' => 'Invalid user or post index'], 400);
        }
        // Check if userIndex is within bounds
        if ($userIndex < 0 || $userIndex >= count($users)) {
            return response()->json(['error' => 'User not found'], 404);
        }
         // Get user
         $user = $users[$userIndex];

         // Check if postIndex is within bounds
         if ($postIndex < 0 || $postIndex >= count($user['posts'])) {
             return response()->json(['error' => "Can not find the post with id  $postIndex for user $userIndex "], 404);
         }
         // Get post
         $post = $user['posts'][$postIndex];
         return $post;
    })->where(['userIndex' => '[0-9]+', 'postIndex' => '[0-9]+'])->name('getUserByPost');
});