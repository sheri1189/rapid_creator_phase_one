<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
    use HasFactory;
    protected $fillable = [
        "font_name",
        "font_file",
        "font_file_status",
        "date",
        "added_from",
    ];
}
