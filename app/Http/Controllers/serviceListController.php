<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class serviceListController extends Controller
{
    function usuarios(){
        redirect()->to("/usuarios");
    }
}