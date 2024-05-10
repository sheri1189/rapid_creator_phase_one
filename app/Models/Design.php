<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "csv_file",
        "font_type",
        "font_family",
        "variants",
        "font_size",
        "text_alignment",
        "color",
        "image_current_width",
        "image_current_height",
        "position_x",
        "position_y",
        "ttf_file",
        "date",
        "design_image",
        "design_status",
        "template_id",
        "added_from",
    ];
}
