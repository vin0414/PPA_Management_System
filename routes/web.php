<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Authentication;

Route::middleware('guest')->group(function ()
{
    Route::get('/',[Home::class,'index'])->name('/');
    Route::post('/',[Authentication::class,'login'])->name('post');
});
Route::middleware(['auth','prevent'])->group(function ()
{
    Route::get('dashboard',[Home::class,'dashboard'])->name('dashboard');
    Route::get('profile',[Home::class,'profile'])->name('profile');
    Route::get('settings',[Home::class,'settings'])->name('settings');
    Route::get('logout',[Authentication::class,'logout'])->name('logout');
    //actions
    Route::post('project/save',[Home::class,'saveProject'])->name('projects.save');
    Route::post('project/remove',[Home::class,'removeProject'])->name('projects.remove');
    Route::post('lead/save',[Home::class,'saveLeadMeasure'])->name('lead.save');
    Route::post('lead/remove',[Home::class,'removeLeadMeasure'])->name('lead.remove');
    Route::post('strategies/save',[Home::class,'saveStrategy'])->name('strategies.save');
    Route::post('strategies/remove',[Home::class,'removeStrategy'])->name('strategies.remove');
    Route::post('targets/save',[Home::class,'saveTarget'])->name('targets.save');
    Route::post('targets/remove',[Home::class,'removeTarget'])->name('targets.remove');
    Route::post('output/save',[Home::class,'saveOutput'])->name('output.save');
    Route::post('output/remove',[Home::class,'removeOutput'])->name('output.remove');
});