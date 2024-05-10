<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csv_File extends Model
{
    use HasFactory;
    protected $fillable=[
        "csv_name",
        "csv_file",
        "csv_file_status",
        "date",
        "added_from",
    ];
}
