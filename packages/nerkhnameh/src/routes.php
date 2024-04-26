<?php

use Illuminate\Support\Facades\Route;
use Mkhodroo\DateConvertor\Controllers\SDate;
use Mkhodroo\Nerkhnameh\Controllers\downloadNerkhnamehController;
use Mkhodroo\Nerkhnameh\Controllers\editRequestController;
use Mkhodroo\Nerkhnameh\Controllers\NerkhnamehRegistrationInfoController;
use Mkhodroo\Nerkhnameh\Controllers\QrCodeController;
use Mkhodroo\Nerkhnameh\Controllers\RegisterController;
use Mkhodroo\Nerkhnameh\Controllers\TemplateController;
use Mkhodroo\Nerkhnameh\Controllers\UploadFinPaymentController;
use Mkhodroo\Voip\Controllers\VoipController;

Route::name('nerkhnameh.')->prefix('nerkhnameh')->middleware(['web'])->group(function(){
    Route::get('test/{link}', [QrCodeController::class, 'generate'])->name('test');
    Route::get('', [RegisterController::class, 'homeForm'])->name('homeForm');
    Route::get('register', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::post('register', [RegisterController::class, 'register'])->name('register');
    Route::get('get/{link}', [NerkhnamehRegistrationInfoController::class, 'inquiry'])->name('inquiry');


    Route::name('registration.')->middleware(['auth'])->prefix('registration')->group(function(){
        Route::get('', [NerkhnamehRegistrationInfoController::class, 'listForm'])->name('listForm');
        Route::get('list', [NerkhnamehRegistrationInfoController::class, 'list'])->name('list');
        Route::post('get', [NerkhnamehRegistrationInfoController::class, 'getView'])->name('getView');
        Route::post('edit', [NerkhnamehRegistrationInfoController::class, 'edit'])->name('edit');
        Route::post('delete', [NerkhnamehRegistrationInfoController::class, 'delete'])->name('delete');
        Route::post('create-nerkhnameh', [TemplateController::class, 'createNerkhnameh'])->name('createNerkhnameh');
    });

    Route::name('finPayment.')->prefix('fin-payment')->group(function(){
        Route::get('', [UploadFinPaymentController::class, 'uploadForm'])->name('uploadForm');
        Route::post('check', [UploadFinPaymentController::class, 'check'])->name('check');
        Route::post('upload', [UploadFinPaymentController::class, 'upload'])->name('upload');
    });

    Route::name('download.')->prefix('download')->group(function(){
        Route::get('', [downloadNerkhnamehController::class, 'downloadForm'])->name('downloadForm');
        Route::post('', [downloadNerkhnamehController::class, 'check'])->name('check');
    });

    Route::name('editRequest.')->prefix('edit-request')->group(function(){
        Route::get('', [editRequestController::class, 'findForm'])->name('findForm');
        Route::post('find', [editRequestController::class, 'find'])->name('find');
        Route::post('edit', [editRequestController::class, 'edit'])->name('edit');

    });


});