<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\report;
use App\Http\Controllers\reportController;
use App\Http\Controllers\ResultController;
use App\Models\Quiz;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can  web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/quizzes', [QuizController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/quizzes/check', [QuizController::class, 'check'])->middleware(['auth', 'verified']);
Route::post('quizzes', [QuizController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/create/quiz', [QuizController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('quiz/update', [QuizController::class, 'update'])->middleware(['auth', 'verified']);
Route::post('/quiz/{id}/deactivate', [QuizController::class, 'deactivate'])->middleware(['auth', 'verified']);
Route::post('/quiz/{id}/activate', [QuizController::class, 'activate'])->middleware(['auth', 'verified']);
Route::get('/quiz/{quiz}/show', [QuizController::class, 'show'])->middleware(['auth', 'verified']);
Route::get('/quiz/{quiz}/edit', [QuizController::class, 'edit'])->middleware(['auth', 'verified']);
Route::post('/activate-user/{id}', [QuizController::class, 'activateUser'])->name('activate-user');
Route::get('permition', [QuizController::class, 'permition'])->middleware(['auth', 'verified']);
Route::post('/stdAnswer', [quizController::class, "stdAnswer"])->middleware(['auth', 'verified']);


Route::get("/create/question", [QuestionController::class, 'create'])->middleware(['auth', 'verified']);
Route::post("/question/store", [QuestionController::class, 'store'])->middleware(['auth', 'verified'])->name('question.store');
Route::get('/edit/question/{question}', [QuestionController::class, 'edit'])->middleware(['auth', 'verified']);

Route::get('resultSearch', [ResultController::class, 'show'])->middleware(['auth', 'verified']);
Route::get('result/Self', [ResultController::class, 'showUser'])->middleware(['auth', 'verified']);
Route::get('/result', [ResultController::class, 'index'])->middleware(['auth', 'verified']);


Route::get('/reports', [reportController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/result_quizname', [reportController::class, 'quizname'])->middleware(['auth', 'verified']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('lang/{locale}', function ($locale) {


    session(['locale' => $locale, 'expires' => now()->addDay()]);


    if (session()->has('locale')) {
        $locale = session('locale');
    } else {
        $locale = 'en';
        session()->put('locale', $locale);
    }
    App::setLocale($locale);

    return redirect()->back();
})->name('lang.switch');


require __DIR__ . '/auth.php';
