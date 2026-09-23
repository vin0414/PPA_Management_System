<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Authentication;

Route::get('/',[Home::class,'dashboard'])->name('/');
Route::middleware('guest')->group(function ()
{
    Route::get('auth',[Home::class,'index'])->name('auth');
    Route::post('auth',[Authentication::class,'login'])->name('auth.post');
});
Route::middleware(['auth','prevent'])->group(function ()
{
    Route::get('profile',[Home::class,'profile'])->name('profile');
    Route::get('settings',[Home::class,'settings'])->name('settings');
    Route::get('logout',[Authentication::class,'logout'])->name('logout');
    //filing
    Route::get('projects.fetch',[Home::class,'fetchProjects'])->name('projects.fetch');
    Route::get('lead_measure.fetch',[Home::class,'fetchLeadMeasure'])->name('lead_measure.fetch');
    Route::get('strategies.fetch',[Home::class,'fetchStrategy'])->name('strategies.fetch');
    Route::get('output.fetch',[Home::class,'fetchOutput'])->name('output.fetch');
    Route::get('targets.fetch',[Home::class,'fetchTarget'])->name('targets.fetch');
    Route::post('proposals/save',[Home::class,'saveProposal'])->name('proposals.save')->middleware('throttle:3,1');
    //settings
    Route::post('password/change',[Authentication::class,'changePassword'])->name('password.change');
    Route::post('projects/save',[Home::class,'saveProject'])->name('projects.save');
    Route::post('projects/remove',[Home::class,'removeProject'])->name('projects.remove');
    Route::post('lead/save',[Home::class,'saveLeadMeasure'])->name('lead.save');
    Route::post('lead/remove',[Home::class,'removeLeadMeasure'])->name('lead.remove');
    Route::post('strategies/save',[Home::class,'saveStrategy'])->name('strategies.save');
    Route::post('strategies/remove',[Home::class,'removeStrategy'])->name('strategies.remove');
    Route::post('targets/save',[Home::class,'saveTarget'])->name('targets.save');
    Route::post('targets/remove',[Home::class,'removeTarget'])->name('targets.remove');
    Route::post('output/save',[Home::class,'saveOutput'])->name('output.save');
    Route::post('output/remove',[Home::class,'removeOutput'])->name('output.remove');
});
