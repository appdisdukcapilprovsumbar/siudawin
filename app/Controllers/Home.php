<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'menu_active'           => 'dashboard',
            'menu_sub'              => '',
            'content'               => 'App\Views\dashboard_view',
        ];
        // dd($data['jlmDataGandaByCode']);
        return view('App\Views\layout_admin\wrapper',$data);
    }
}
