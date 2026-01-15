<?php

namespace App\Http\Controllers;


use App\Models\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhoAreWeController extends Controller
{
    public function index(Request $request)
    {


        return view('managements.about_us.Who_are_we.index');
    }
}
