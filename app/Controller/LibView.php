<?php


namespace Controller;

use Model\User;
use Src\Request;
use Src\View;

class LibView {
    public
    function lib_list(): string
    {
        $lib_list = User::where(['role_id' => 2])->get();
        return (new View())->render('site.librarian.librarians', ['lib_list' => $lib_list]);
    }

    public
    function lib_add(Request $request): string
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
}