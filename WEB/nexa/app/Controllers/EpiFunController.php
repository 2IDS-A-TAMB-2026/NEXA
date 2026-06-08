<?php

namespace App\Controllers;

class EpiFunController extends BaseController
{
    public function index()
    {
        if (!session()->get('logado'))
        {
            return redirect()->to('/loginfun');
        }

        return view('site/epifun');
    }
}