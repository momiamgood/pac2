<?php

namespace Controller;

use Model\Hall;
use Src\Request;
use Src\View;

class HallView {
    public
    function hall_list(): string
    {
        $hall_list = Hall::all();
        return (new View())->render('site.hall.halls', ['hall_list' => $hall_list]);
    }

    public
    function hall_add(Request $request): string
    {
        if ($request->method === 'POST' && Hall::create($request->all())) {
            app()->route->redirect('/halls');
        }
        return new View('site.hall.hall_add');
    }

}