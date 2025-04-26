<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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
    return view('landing');
})->name('landing');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'create'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor')->middleware('auth');
Route::get('/doctor/{id}', [DoctorController::class, 'show'])->name('doctor.show')->middleware('auth');
Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update')->middleware(['auth', 'adminOnly']);

Route::get('/patient', [PatientController::class, 'index'])->name('patient')->middleware(['auth', 'adminOrDoctor']);
Route::get('/patient/{id}', [PatientController::class, 'show'])->name('patient.show')->middleware(['auth', 'adminOrDoctor']);
Route::put('/patient/{id}', [PatientController::class, 'update'])->name('patient.update')->middleware(['auth', 'adminOnly']);

Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment')->middleware('auth');
Route::post('/assessment', [AssessmentController::class, 'start'])->name('assessment.start')->middleware('auth');
Route::get('/assessment/question/{id}', [AssessmentController::class, 'question'])->name('assessment.question')->middleware(['auth', 'patientOnly']);
Route::post('/assessment/question/{id}', [AssessmentController::class, 'answer'])->name('assessment.answer')->middleware(['auth', 'patientOnly']);
Route::get('/assessment/notes', [AssessmentController::class, 'notes'])->name('assessment.notes')->middleware(['auth', 'patientOnly']);
Route::post('/assessment/notes', [AssessmentController::class, 'finish'])->name('assessment.finish')->middleware(['auth', 'patientOnly']);
Route::delete('/assessment', [AssessmentController::class, 'destroy'])->name('assessment.destroy')->middleware(['auth', 'adminOnly']);
Route::get('/assessment-answer', [AssessmentController::class, 'getAnswer'])->middleware('auth');
Route::get('/assessment-notes', [AssessmentController::class, 'getNotes'])->middleware('auth');
Route::post('/assessment-answer', [AssessmentController::class, 'verify'])->name('assessment.verify')->middleware(['auth', 'adminOrDoctor']);

Route::get('/question', [QuestionController::class, 'index'])->name('question')->middleware(['auth', 'adminOrDoctor']);
Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create')->middleware(['auth', 'adminOnly']);
Route::post('/question', [QuestionController::class, 'store'])->name('question.store')->middleware(['auth', 'adminOnly']);
Route::delete('/question', [QuestionController::class, 'destroy'])->name('question.destroy')->middleware(['auth', 'adminOnly']);

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment')->middleware('auth');
Route::put('/appointment', [AppointmentController::class, 'verify'])->name('appointment.verify')->middleware(['auth', 'adminOrDoctor']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware(['auth', 'adminOnly']);
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware(['auth', 'adminOnly']);
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware(['auth', 'adminOnly']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->middleware('auth');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware(['auth', 'adminOnly']);
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware(['auth', 'adminOnly']);

Route::middleware(['auth:patient'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});