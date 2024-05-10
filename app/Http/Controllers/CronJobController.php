<?php

namespace App\Http\Controllers;

set_time_limit(0);

use App\Models\Design;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class CronJobController extends Controller
{
    public function designMaking()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1500M');
        $allDesigns = Design::where('design_status', 0)->get();
        $msg = 500;
        foreach ($allDesigns as $design) {
            try {
                $imageFilePath = Template::findOrFail($design->template_id)->template_picture;
                $extension = $this->getImageExtension($imageFilePath);

                $image = Image::make($imageFilePath);
                $originalWidth = $image->width();
                $originalHeight = $image->height();

                $ttf_file = $design->ttf_file;
                $color = $design->color;
                $positionX = $design->position_x;
                $positionY = $design->position_y;
                $text = $design->title;
                $fontSize = $design->font_size;

                $currentWidth = $image->width();
                $currentHeight = $image->height();

                $positionX *= $currentWidth / $design->image_current_width;
                $positionY *= $currentHeight / $design->image_current_height;

                $image->text($text, $positionX, $positionY, function ($font) use ($fontSize, $ttf_file, $color) {
                    $font->file($ttf_file);
                    $font->size($fontSize);
                    $font->color($color);
                });

                $image->resize($originalWidth, $originalHeight);

                $mainDirectory = "templates";
                $subDirectory = Auth::user()->id . "-Templates";

                if (!is_dir($mainDirectory)) {
                    mkdir($mainDirectory, 0777, true);
                }

                if (!is_dir($mainDirectory . "/" . $subDirectory)) {
                    mkdir($mainDirectory . "/" . $subDirectory, 0777, true);
                }

                $outputImageName = uniqid() . '.' . $extension;
                $outputPath = $mainDirectory . "/" . $subDirectory . "/" . $outputImageName;
                $image->save($outputPath);

                Design::where('id', $design->id)->update([
                    "design_image" => $outputPath,
                    "design_status" => 1,
                ]);

                $msg = 200;
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        if ($msg == 200) {
            return response()->json([
                "message" => "Designs Created Successfully",
            ]);
        }

        return response()->json([
            "message" => "Failed to create designs",
        ], 500);
    }
    private function getImageExtension($dataUri)
    {
        $matches = [];
        if (preg_match('#^data:image/(\w+);base64,#i', $dataUri, $matches)) {
            return $matches[1];
        }
        return 'png';
    }
}
