<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
  public  function index()
  {

      return inertia('Main/Index');
  }
}
