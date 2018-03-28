<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use App\Reply;
use App\Favorite;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        return $reply->favorite();
    }
}