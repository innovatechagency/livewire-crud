<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'component' => 'menu.index'
    ]);
});

Route::get('/tables', function () {
    return view('welcome', [
        'component' => 'table.index'
    ]);
});

Route::get('/manage', function () {
    return view('welcome', [
        'component' => 'table.manage'
    ]);
});

Route::get('/manage/{id}/edit', function ($id) {
    return view('welcome', [
        'component' => 'table.manage',
        'tableId'   => $id
    ]);
});

Route::get('/reservation', function () {
    return view('welcome', [
        'component' => 'reservation.index'
    ]);
});
