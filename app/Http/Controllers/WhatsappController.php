<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class WhatsappController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'reminder-whatsapp';
    }

    public function index()
    {
        $navActive = $this->navActive;

        return view('whatsapp.index', compact('navActive'));
    }
}
