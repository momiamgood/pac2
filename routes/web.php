<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'main_page'])
    ->middleware('auth', 'can:admin|librarian');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/books', [Controller\Site::class, 'book_list'])
    ->middleware('auth', 'can:admin|librarian');
Route::add('GET', '/books/', [Controller\Site::class, 'book'])
    ->middleware('auth', 'can:admin|librarian');
Route::add(['GET', 'POST'], '/book-add', [Controller\Site::class, 'book_add'])
    ->middleware('auth', 'can:admin|librarian');
Route::add('GET', '/readers', [Controller\Site::class, 'reader_list'])
    ->middleware('auth', 'can:admin|librarian');
Route::add('GET', '/reader', [Controller\Site::class, 'reader'])
    ->middleware('auth', 'can:admin|librarian');
Route::add(['GET', 'POST'], '/reader-add', [Controller\Site::class, 'reader_add'])
    ->middleware('auth', 'can:admin|librarian');
Route::add(['GET', 'POST'], '/profile', [Controller\Site::class, 'profile'])
    ->middleware('auth', 'can:admin|librarian');

Route::add('GET', '/publishers', [Controller\Site::class, 'publisher_list'])
    ->middleware('auth', 'can:admin');
Route::add(['GET', 'POST'], '/publisher-add', [Controller\Site::class, 'publisher_add'])
    ->middleware('auth', 'can:admin');
Route::add('GET', '/genre', [Controller\Site::class, 'genre_list'])
    ->middleware('auth', 'can:admin');
Route::add(['GET', 'POST'], '/genre-add', [Controller\Site::class, 'genre_add'])
    ->middleware('auth', 'can:admin');
Route::add('GET', '/librarians', [Controller\Site::class, 'lib_list'])
    ->middleware('auth', 'can:admin');
Route::add(['GET', 'POST'], '/librarian-add', [Controller\Site::class, 'lib_add'])
    ->middleware('auth', 'can:admin');
Route::add('GET', '/halls', [Controller\Site::class, 'hall_list'])
    ->middleware('auth', 'can:admin');
Route::add(['GET', 'POST'], '/hall-add', [Controller\Site::class, 'hall_add'])
    ->middleware('auth', 'can:admin');


