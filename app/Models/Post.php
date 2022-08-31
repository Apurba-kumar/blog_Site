<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //we have post and it belongs particular user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
