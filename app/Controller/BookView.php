<?php

namespace Controller;

use Model\Book;
use Model\Genre;
use Model\Hall;
use Model\Publisher;
use Src\Request;
use Src\View;

class BookView
{
    /**
     * @throws \Exception
     */
    public function book_list(Request $request): string
    {
        $data = $request->all();
        if ($request->method === 'GET') {
            if (!empty($data) && isset($data->id)) {
                $book = Book::where('book_id', $request->id)->get();
                if (!$book) {
                    throw new \Exception("Книга по данному адресу недоступна");
                } else {
                    $book = Book::where('book_id', $request->id)->get();
                    return (new View())->render('site.book.book', ['book' => $book]);
                }
            }
        } else if ($request->method === "POST") {
            $book_list = Book::where('name', $request->search)->get();
        } else {
            $book_list = Book::orderBy('name')->get();
        }
        return (new View())->render('site.book.books', ['book_list' => $book_list]);
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
}