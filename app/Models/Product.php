<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
