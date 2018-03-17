<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function path()
    {
        //return a URI
        return '/threads/'.$this->id;
    }
}
