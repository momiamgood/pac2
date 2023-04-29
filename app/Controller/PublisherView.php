<?php

namespace Controller;

use Model\Publisher;
use Src\Request;
use Src\View;

class PublisherView {
    public
    function publisher_list(): string
    {
        $publisher_list = Publisher::all();
        return (new View())->render('site.publisher.publishers', ['publisher_list' => $publisher_list]);
    }

    public
    function publisher_add(Request $request): string
    {
        if ($request->method === 'POST' && Publisher::create($request->all())) {
            app()->route->redirect('/publishers');
        }
        return new View('site.publisher.publisher_add');
    }
}