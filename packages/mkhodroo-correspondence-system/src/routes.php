<?php

use Illuminate\Support\Facades\Route;
use Mkhodroo\CorrespondenceSystem\Controllers\ActivityController;
use Mkhodroo\CorrespondenceSystem\Controllers\JumpController;
use Mkhodroo\CorrespondenceSystem\Controllers\LetterController;
use Mkhodroo\CorrespondenceSystem\Controllers\NumberingFormatController;
use Mkhodroo\CorrespondenceSystem\Controllers\ReceiverController;
use Mkhodroo\CorrespondenceSystem\Controllers\RoleController;
use Mkhodroo\CorrespondenceSystem\Controllers\ShowInboxController;
use Mkhodroo\CorrespondenceSystem\Controllers\SignController;
use Mkhodroo\CorrespondenceSystem\Controllers\TemplateAccessController;
use Mkhodroo\CorrespondenceSystem\Controllers\TemplateController;
use Mkhodroo\CorrespondenceSystem\Controllers\UserRoleController;
use Mkhodroo\CorrespondenceSystem\Controllers\WordToImageController;
use PhpOffice\PhpWord\TemplateProcessor;

Route::name('atmn.')->prefix('atmn')->middleware(['web', 'auth'])->group(function () {
    Route::get('test' , function () {
        WordToImageController::convertToImage();
    });

    Route::name('role.')->prefix('role')->group(function () {
        Route::get('list-form', [RoleController::class, 'listForm'])->name('listForm');
        Route::get('list', [RoleController::class, 'list'])->name('list');
        Route::get('create-form', [RoleController::class, 'createForm'])->name('createForm');
        Route::post('create', [RoleController::class, 'create'])->name('create');
        Route::post('edit-form', [RoleController::class, 'editForm'])->name('editForm');
        Route::post('edit', [RoleController::class, 'edit'])->name('edit');
    });

    Route::name('userRole.')->prefix('user-role')->group(function () {
        Route::get('list-form', [UserRoleController::class, 'listForm'])->name('listForm');
        Route::get('list', [UserRoleController::class, 'list'])->name('list');
        Route::get('create-form', [UserRoleController::class, 'createForm'])->name('createForm');
        Route::post('create', [UserRoleController::class, 'create'])->name('create');
        Route::post('edit-form', [UserRoleController::class, 'editForm'])->name('editForm');
        Route::post('edit', [UserRoleController::class, 'edit'])->name('edit');
    });

    Route::name('numberingFormat.')->prefix('numbering-format')->group(function () {
        Route::get('list-form', [NumberingFormatController::class, 'listForm'])->name('listForm');
        Route::get('list', [NumberingFormatController::class, 'list'])->name('list');
        Route::get('create-form', [NumberingFormatController::class, 'createForm'])->name('createForm');
        Route::post('create', [NumberingFormatController::class, 'create'])->name('create');
        Route::post('edit-form', [NumberingFormatController::class, 'editForm'])->name('editForm');
        Route::post('edit', [NumberingFormatController::class, 'edit'])->name('edit');
    });

    Route::name('template.')->prefix('template')->group(function () {
        Route::get('list-form', [TemplateController::class, 'listForm'])->name('listForm');
        Route::get('list', [TemplateController::class, 'list'])->name('list');
        Route::get('create-form', [TemplateController::class, 'createForm'])->name('createForm');
        Route::post('create', [TemplateController::class, 'create'])->name('create');
        Route::post('edit-form', [TemplateController::class, 'editForm'])->name('editForm');
        Route::post('edit', [TemplateController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [TemplateController::class, 'download'])->name('download');
    });

    Route::name('templateAccess.')->prefix('template-access')->group(function () {
        Route::get('list-form', [TemplateAccessController::class, 'listForm'])->name('listForm');
        Route::get('list', [TemplateAccessController::class, 'list'])->name('list');
        Route::get('create-form', [TemplateAccessController::class, 'createForm'])->name('createForm');
        Route::post('create', [TemplateAccessController::class, 'create'])->name('create');
        Route::post('edit-form', [TemplateAccessController::class, 'editForm'])->name('editForm');
        Route::post('edit', [TemplateAccessController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [TemplateAccessController::class, 'download'])->name('download');
    });

    Route::name('letter.')->prefix('letter')->group(function () {
        Route::get('select-template-form', [LetterController::class, 'selectLetterTemplateForm'])->name('selectLetterTemplateForm');
        Route::get('select-template', [LetterController::class, 'selectLetterTemplate'])->name('selectLetterTemplate');
        Route::post('create-form', [LetterController::class, 'createForm'])->name('createForm');
        Route::post('create', [LetterController::class, 'create'])->name('create');
        Route::post('edit', [LetterController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [LetterController::class, 'download'])->name('download');
        Route::any('preview/{id}', [LetterController::class, 'letterPreview'])->name('preview');
    });

    Route::name('letterReceiver.')->prefix('letter-receiver')->group(function () {
        Route::get('list-form', [ReceiverController::class, 'listForm'])->name('listForm');
        Route::get('list', [ReceiverController::class, 'list'])->name('list');
        Route::get('create-form', [ReceiverController::class, 'createForm'])->name('createForm');
        Route::post('create', [ReceiverController::class, 'create'])->name('create');
        Route::post('edit-form', [ReceiverController::class, 'editForm'])->name('editForm');
        Route::post('edit', [ReceiverController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [ReceiverController::class, 'download'])->name('download');
    });

    Route::name('sign.')->prefix('sign')->group(function () {
        Route::get('list-form', [SignController::class, 'listForm'])->name('listForm');
        Route::get('list', [SignController::class, 'list'])->name('list');
        Route::get('create-form', [SignController::class, 'createForm'])->name('createForm');
        Route::post('create', [SignController::class, 'create'])->name('create');
        Route::post('edit-form', [SignController::class, 'editForm'])->name('editForm');
        Route::post('edit', [SignController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [SignController::class, 'download'])->name('download');
    });

    Route::name('activity.')->prefix('activity')->group(function () {
        Route::get('get/{letter_id}', [ActivityController::class, 'get'])->name('get');
        Route::post('numbering', [ActivityController::class, 'numbering'])->name('numbering');
        Route::post('signing', [ActivityController::class, 'signing'])->name('signing');
        Route::post('unsigning', [ActivityController::class, 'unsigning'])->name('unsigning');
    });

    Route::name('inbox.')->prefix('inbox')->group(function () {
        Route::get('list-form', [ShowInboxController::class, 'listForm'])->name('listForm');
        Route::get('list', [ShowInboxController::class, 'list'])->name('list');
        Route::get('show-letter/{inbox_id}/{letter_id}', [ShowInboxController::class, 'showLetter'])->name('showLetter');
    });

    Route::name('jump.')->prefix('jump')->group(function () {
        Route::post('form', [JumpController::class, 'form'])->name('form');
        Route::post('jump', [JumpController::class, 'jump'])->name('jump');
    });
});
