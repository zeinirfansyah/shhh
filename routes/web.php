<?php

use App\Http\Controllers\messageController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/shhh/{username}', function (string $username) {
//     $user = User::where('username', $username)->firstOrFail();
//     if (!$user) {
//         return view('profile.usernotfound');
//     }

//     return view('user', [
//         'user' => $user
//     ]);
// });

Route::get('/shhh/{username}', [messageController::class, 'index']);
Route::post('/shhh/{username}/send-message', [messageController::class, 'sendMessage'])->name('sendMessage');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'showProfile'])->name('dashboard');
    Route::get('/messages', [messageController::class, 'showMessages'])->name('messages');
    Route::get('/messages/detail/{id}', [messageController::class, 'messageDetail'])->name('messageDetail');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
