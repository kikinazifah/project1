<?php

namespace App\Http\Controllers;

use App\Models\Menu2;
// use Illuminate\Http\Request;

class MenuController2 extends Controller
{

    public function showUser()
    {
        $title = "Menu";
        $menus = Menu2::latest()->get();
        return view('pages.menu', compact('menus', 'title'));
    }


    public function showDetail($id)
    {
        $title = "Detail Menu";
        $menu = Menu2::findOrFail($id);

        $menu->increment('dibaca');
        return view('pages.menu-detail', compact('menu', 'title'));
    }
}
