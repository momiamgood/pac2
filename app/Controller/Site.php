<?php

namespace Controller;

use Model\Genre;
use Model\Hall;
use Model\Librarian;
use Model\Publisher;
use Model\Reader;
use Model\Role;
use Src\Request;
use Src\View;
use Model\User;
use Src\Auth\Auth;
use Model\Book;

class Site
{

    // Операции с книгами
    public function book_list(Request $request): string
    {

        $book_list = Book::all();
        return (new View())->render('site.book.books', ['book_list' => $book_list]);
    }

    public function book(Request $request): string
    {
        $book = Book::where('book_id', $request->id)->get();
        return (new View())->render('site.book.book', ['book' => $book]);
    }

    public function book_add(Request $request): string
    {
        $hall_list = Hall::all();
        $genre_list = Genre::all();
        $publisher_list = Publisher::all();

        if ($request->method === 'POST' && Book::create($request->all())) {
            app()->route->redirect('/books');
        }
        return (new View())->render('site.book.book_add', ['hall_list' => $hall_list, 'genre_list' => $genre_list, 'publisher_list' => $publisher_list]);
    }

    // Операции с пользователями

    public function reader_list(Request $request): string
    {

        $reader_list = Reader::all();
        return (new View())->render('site.reader.readers', ['reader_list' => $reader_list]);
    }

    public function reader(Request $request): string
    {
        $reader = Reader::where('book_id', $request->id)->get();
        return (new View())->render('site.reader.reader', ['reader' => $reader]);
    }

    public function reader_add(Request $request): string
    {
        if ($request->method === 'POST' && Reader::create($request->all())) {
            app()->route->redirect('/readers');
        }
        return new View('site.reader.reader_add');
    }

    public function main_page(): string
    {
        $book_list = Book::all();
        return (new View())->render('site.main_page', ['book_list' => $book_list]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/login');
        }
        return new View('site.signup');
    }


    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }

    public function profile(Request $request): string
    {
        if ($request->method === 'POST' && User::update($request->all())) {
            app()->route->redirect('/');
        }
        return new View('site.profile');
    }


    // publishers

    public function publisher_list(Request $request): string
    {
        $publisher_list = Publisher::all();
        return (new View())->render('site.publisher.publishers', ['publisher_list' => $publisher_list]);
    }

    public function publisher_add(Request $request): string
    {
        if ($request->method === 'POST' && Publisher::create($request->all())) {
            app()->route->redirect('/publishers');
        }
        return new View('site.publisher.publisher_add');
    }


    // genres

    public function genre_list(Request $request): string
    {
        $genre_list = Genre::all();
        return (new View())->render('site.genre.genrs', ['genre_list' => $genre_list]);
    }

    public function genre_add(Request $request): string
    {
        if ($request->method === 'POST' && Genre::create($request->all())) {
            app()->route->redirect('/genres');
        }
        return new View('site.genre.genre_add');
    }


    // lib

    public function lib_list(Request $request): string
    {
        $lib_list = User::where(['role_id' => 2])->get();
        return (new View())->render('site.librarian.librarians', ['lib_list' => $lib_list]);
    }

    public function lib_add(Request $request): string
    {
        if ($request->method === 'POST' && User::create([
                'name' => $request->name,
                'login' => $request->login,
                'password' => $request->password,
                'role_id' => 2
            ])) {
            app()->route->redirect('/librarians');
        }
        return new View('site.librarian.librarian_add');
    }


    // halls
    public function hall_list(Request $request): string
    {
        $hall_list = Hall::all();
        return (new View())->render('site.hall.halls', ['hall_list' => $hall_list]);
    }

    public function hall_add(Request $request): string
    {
        if ($request->method === 'POST' && Hall::create($request->all())) {
            app()->route->redirect('/halls');
        }
        return new View('site.hall.hall_add');
    }
}