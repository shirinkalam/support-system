<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MagicController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

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
})->name('home');

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('register',[RegisterController::class,'showRegisterForm'])->name('auth.register.form');
    Route::post('register',[RegisterController::class,'register'])->name('auth.register');
    Route::get('login',[LoginController::class,'showLoginForm'])->name('auth.login.form');
    Route::post('login',[LoginController::class,'login'])->name('auth.login');
    Route::get('logout',[LoginController::class,'logout'])->name('auth.logout');
    Route::get('email/send-verification',[VerificationController::class,'send'])->name('auth.email.send.verification');
    Route::get('email/verify',[VerificationController::class,'verify'])->name('auth.email.verify');
    Route::get('password/forget',[ForgetPasswordController::class,'showForgetForm'])->name('auth.password.forget.form');
    Route::post('password/forget',[ForgetPasswordController::class,'sendResetLink'])->name('auth.password.forget');
    Route::get('password/reset',[ResetPasswordController::class,'showResetForm'])->name('auth.password.reset.form');
    Route::post('password/reset',[ResetPasswordController::class,'reset'])->name('auth.password.reset');
    Route::get('redirect/{provider}',[SocialController::class,'redirectToProvider'])->name('auth.login.provider.redirect');
    Route::get('{prvider}/callback',[SocialController::class,'providerCallback'])->name('auth.login.provider.callback');
    Route::get('magic/login',[MagicController::class,'showMagicForm'])->name('auth.magic.login.form');
    Route::post('magic/login',[MagicController::class,'sendToken'])->name('auth.magic.send.token');
    Route::get('magic/login/{token}',[MagicController::class,'login'])->name('auth.magic.login');
    Route::get('two-factor/toggle',[TwoFactorController::class,'showToggleForm'])->name('auth.two.factor.toggle.form');
    Route::get('two-factor/activate',[TwoFactorController::class,'activate'])->name('auth.two.factor.activate');
    Route::get('two-factor/code',[TwoFactorController::class,'showEnterCodeForm'])->name('auth.two.factor.code.form');
    Route::post('two-factor/code',[TwoFactorController::class,'confirmCode'])->name('auth.two.factor.code');
    Route::get('two-factor/deactivate',[TwoFactorController::class,'deactivate'])->name('auth.two.factor.deactivate');
    Route::get('login/code',[LoginController::class,'showCodeForm'])->name('auth.login.code.form');
    Route::post('login/code',[LoginController::class,'confirmCode'])->name('auth.login.code');
    Route::get('two-factor/resent',[TwoFactorController::class,'resent'])->name('auth.two.factor.resent');
});

Route::prefix('admin')->group(function () {
    Route::get('register',[AdminController::class,'showRegistrationForm'])->name('admin.register.form');
    Route::post('register',[AdminController::class,'register'])->name('admin.register');
    Route::get('login',[AdminController::class,'showLoginForm'])->name('admin.login.form');
    Route::post('login',[AdminController::class,'login'])->name('admin.login');
});

Route::get('tickets/new',[TicketController::class,'new'])->name('ticket.new');
Route::post('tickets',[TicketController::class,'create'])->name('ticket.create');
Route::get('tickets',[TicketController::class,'index'])->name('ticket.index');
Route::get('tickets/{ticket}',[TicketController::class,'show'])->name('ticket.show');
Route::post('tickets/{ticket}/reply',[ReplyController::class,'create'])->name('reply.create');

Route::get('tickets/{ticket}/close',[TicketController::class,'close'])->name('ticket.close');
