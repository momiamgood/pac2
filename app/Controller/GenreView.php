<?php

namespace Controller;

use Model\Genre;
use Src\Request;
use Src\View;

class GenreView {
    public
    function genre_list(): string
    {
        $genre_list = Genre::all();
        return (new View())->render('site.genre.genrs', ['genre_list' => $genre_list]);
    }

    public
    function genre_add(Request $request): string
    {
        if ($request->method === 'POST' && Genre::create($request->all())) {
            app()->route->redirect('/genres');
        }
        return new View('site.genre.genre_add');
    }
}