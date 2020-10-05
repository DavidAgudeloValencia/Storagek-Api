<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storagek extends Model
{
    protected $fillable = ['file','email'];
    use HasFactory;
}
