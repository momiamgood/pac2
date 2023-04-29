<?php

namespace Controller;

use Model\Book;
use Model\Book_reader;
use Src\Auth\Auth;
use Src\Request;
use Src\View;
use Model\Reader;

class ReaderView
{
    public function reader_list(Request $request): string
    {
        if ($request->method === "POST") {
            $result = Reader::where(['reader_id', $request->search, 'fio', $request->search])->get();
        } else {
            $result = Reader::orderBy('fio')->get();
        }
        return (new View())->render('site.reader.readers', ['reader_list' => $result]);
    }

    public function reader(Request $request): string
    {
        $result = Book_reader::where('reader_id', $request->id)->join('books', 'book_readers.book_id', '=', 'books.book_id')->select('books.name', 'readers.fio')->get();
        return (new View())->render('site.reader.reader', ['info' => $result]);
    }

    public function reader_add(Request $request): string
    {
        if ($request->method === 'POST' && Reader::create($request->all())) {
            app()->route->redirect('/readers');
        }
        return new View('site.reader.reader_add');
    }

    public function book_reader(Request $request): string
    {
        if ($request->method === 'POST' && Book_reader::create([
                'book_id' => $request->book_id,
                'reader_id' => $request->id,
                'date_issue' => date('Y-m-d'),
                'date_back' => $request->date_back,
                'librarian_id ' => Auth::user()->id
            ])) {
            app()->route->redirect('/readers');
        }

        $date_issue = Book_reader::where('reader_id', $request->id)->get('date_issue');
        $book = Book::where('book_id', $request->id)->get('name');
        $book_list = Book::orderBy('name')->get();
        return (new View())->render('site.reader.reader_book', ['book_list' => $book_list, 'date_issue' => $date_issue, 'book' => $book]);
    }
}
