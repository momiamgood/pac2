<?php

namespace Controller;

use Model\Book;
use Model\Book_reader;
use Model\Genre;
use Model\Hall;
use Model\Publisher;
use Src\Request;
use Src\View;

class BookView
{
    public function book_detail(Request $request): string
    {
        if (Book_reader::where('book_id', $request->id)->get()) {
            $result = Book_reader::where('book_readers.book_id', $request->id)
                ->join('books', 'books.book_id', '=', 'book_readers.book_id')
                ->where('book_readers.book_id', $request->id)
                ->join('readers', 'readers.reader_id', '=', 'book_readers.reader_id')
                ->orderBy('date_issue')
                ->get();
        } else {
            $result = null;
        }

        $book_id = $request->id;
        $book = Book::where('book_id', $request->id)->get();
        return (new View())->render('site.book.book', ['book' => $book, 'book_id' => $book_id, 'reader_list' => $result]);
    }

    public function book_list(Request $request): string
    {
        if ($request->method === "POST") {
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

    public function book_update(Request $request): string
    {
        $hall_list = Hall::all();
        $genre_list = Genre::all();
        $publisher_list = Publisher::all();
        $book = Book::where('book_id', $request->id)->get();


        if ($request->method == "POST" && Book::where('book_id', $request->id)->update([
                'name' => $request->name,
                'author' => $request->author,
                'date_publish' => $request->date_publish,
                'price' => $request->price,
                'annotation' => $request->annotation,
                'new' => $request->new,
                'genre_id' => $request->genre_id,
                'hall_id' => $request->hall_id,
                'publisher_id' => $request->publisher_id,

            ])) {
            app()->route->redirect('/books');
        }

        return (new View())->render('site.book.book_update', ['hall_list' => $hall_list, 'genre_list' => $genre_list, 'publisher_list' => $publisher_list, 'book' => $book]);
    }

    public function delete_book(Request $request): void
    {
        if (Book_reader::where('book_id', $request->id)->get() && Book_reader::where('book_id', $request->id)->delete()) {
            {
                if (Book::where('book_id', $request->id)->delete()) {
                    app()->route->redirect('/books');
                }
            }
        } else if (Book::where('book_id', $request->id)->delete()) {
            app()->route->redirect('/books');
        }
    }
}