<?php

namespace App\Http\Controllers;

use App\Models\Csv_File;
use App\Models\Design_Images;
use App\Models\Font;
use App\Models\Template as ModelsTemplate;
use App\Models\Templates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Traits\DesignCreating;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Template\Template;
// use Intervention\Image\Facades\Image;
// use Intervention\Image\ImageManagerStatic as ImageManager;
use Intervention\Image\ImageManager;
use ZipArchive;
use Intervention\Image\ImageManagerStatic as Image;

class ImageProcessing extends Controller
{
    //===================using Trait================
    use DesignCreating;
    //===================using Trait================
    public function getting_csv_data($file)
    {

        $csv_file = Csv_File::where('csv_file', $file)->first();
        $mainDirectory = "CSV_FILES";
        $subDirectory = Auth::user()->id;
        $csvDirectory = ucfirst($csv_file->csv_name);
        $csvFilePath = $mainDirectory . "/" . $subDirectory . "/" . $csvDirectory . "/";
        $filePath = $csvFilePath . $file;
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle, 1000, ',');
            $array_data = [];
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $array_data[] = $data;
            }
            fclose($handle);
            return response()->json([
                "message" => 200,
                "data" => $array_data,
            ]);
        } else {
            echo 'Error opening the CSV file';
        }
    }
    public function gettingData($title)
    {
        if (str_contains($title, '.csv')) {
            $filePath = './csv_files/' . $title;

            if (($handle = fopen($filePath, 'r')) !== false) {
                fgetcsv($handle, 1000, ',');
                $array_names = [];

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $array_names[] = $data;
                }

                fclose($handle);

                return response()->json([
                    "success" => true,
                    "message" => "csv loaded",
                    "data" => $array_names,
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Error opening the CSV file",
                ], 500);
            }
        } else {
            return response()->json([
                "success" => true,
                "message" => "title",
                "data" => $title,
            ]);
        }
    }
    public function applyTextPosition(Request $request)
    {
        $checkResponse = $this->designCreating($request);
        if ($checkResponse['message'] == 200) {
            return response()->json([
                'success' => true,
                'message' => 200,
                'template' => $checkResponse['template_id'],
            ]);
        }
    }
    private function getImageExtension($dataUri)
    {
        $matches = [];
        if (preg_match('#^data:image/(\w+);base64,#i', $dataUri, $matches)) {
            return $matches[1];
        }
        return 'png';
    }
    public function getting_font_effect(Request $request, $fontFamily)
    {
        if ($request->font_type == "google") {
            $apiKey = 'AIzaSyC6H1NGVqEH2u0epLKZEu5wk4Oj3kd_a4Y';
            $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $apiKey;
            $fontFamily = $fontFamily;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
            curl_close($ch);
            $data = json_decode($response, true);
            if ($data === null) {
                echo 'Error decoding JSON';
            } else {
                $fontFamilies = $data['items'];
                $variants = [];
                $fontFiles = [];
                foreach ($fontFamilies as $font) {
                    if ($font['family'] == $fontFamily) {
                        foreach ($font['variants'] as $variant) {
                            if (strpos($variant, 'italic') === false) {
                                $weight = filter_var($variant, FILTER_SANITIZE_NUMBER_INT);
                                if ($weight < 800) {
                                    // $variants[] = $variant;
                                    $fontFiles[$variant] = $font['files'][$variant];
                                }
                            }
                        }
                        break;
                    }
                }
                foreach ($fontFiles as $fileVariant => $fileUrl) {
                    $fontContent = file_get_contents($fileUrl);
                    if ($fontContent !== false) {
                        $fontDirectory = 'font/' . Auth::user()->id . "/";
                        if (!is_dir($fontDirectory . $fontFamily)) {
                            mkdir($fontDirectory . $fontFamily, 0755, true);
                        }
                        $fileName = $fontFamily . '-' . ucfirst($fileVariant) . '.ttf';
                        $filePath = $fontDirectory . "/" . $fontFamily . '/' . $fileName;
                        if (!file_exists($filePath)) {
                            file_put_contents($filePath, $fontContent);
                        }
                        $variants[$filePath] = $fontFamily . '-' . ucfirst($fileVariant);
                    } else {
                        echo 'Error downloading font file: ' . $fileUrl;
                    }
                }

                return response()->json([
                    "message" => 200,
                    "variants" => $variants,
                ]);
            }
        } else {
            $font = Font::where('font_name', $fontFamily)->first();

            if (!$font) {
                return response()->json(['error' => 'Font not found'], 404);
            }

            $getFontFile = "./font/" . Auth::user()->id . "/" . $font->font_name . "/" . $font->font_file;
            if (!file_exists($getFontFile)) {
                return response()->json(['error' => 'Font file not found'], 404);
            }

            $zip = new ZipArchive;
            if ($zip->open($getFontFile) === TRUE) {
                $extractPath = './font/' . Auth::user()->id . "/" . $font->font_name . "/";
                if (!is_dir($extractPath)) {
                    mkdir($extractPath, 0777, true);
                }

                if ($zip->extractTo($extractPath)) {
                    $zip->close();
                    $extractedFileNames = array_diff(scandir($extractPath), array('.', '..'));
                    $variants = [];
                    foreach ($extractedFileNames as $fileName) {
                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                        if ($fileExtension !== 'ttf') {
                            continue;
                        }
                        if (strpos($fileName, 'italic') !== false || strpos($fileName, 'Italic') !== false) {
                            continue;
                        }
                        $variants[$extractPath . "/" . $fileName] = str_replace(".ttf", "", $fileName);
                    }
                    return response()->json([
                        "message" => 200,
                        "variants" => $variants,
                    ]);
                } else {
                    $zip->close();
                    return response()->json(['error' => 'Failed to extract the files'], 500);
                }
            } else {
                return response()->json(['error' => 'Failed to open the ZIP archive'], 500);
            }
        }
    }
    // public function applyTextPosition(Request $request)
    // {
    //     $image = Image::make('./images/template.png');
    //     foreach ($request->screenshotData as $key => $data) {
    //         $positionX = $data['positionX'];
    //         $positionY = $data['positionY'];
    //         $text = $data['text'];
    //         $fontSize = isset($data['fontSize']) ? $data['fontSize'] : 12;
    //         if (str_word_count($text) == 1 && $fontSize == 50) {
    //             $positionX = $positionX;
    //             $positionY = $positionY;
    //             $fontSize = 500;
    //         } else if (str_word_count($text) == 1 && $fontSize < 50 && $fontSize > 40) {
    //             $positionX = $positionX;
    //             $positionY = $positionY - 70;
    //             $fontSize = 450;
    //         } else {
    //             $positionX = $positionX;
    //             $positionY = $positionY - 550;
    //             $fontSize = 450;
    //         }
    //         $fontWeight = "bold";
    //         $originalWidth = 4500;
    //         $originalHeight = 3939;
    //         $scaleX = $image->width() / $originalWidth;
    //         $scaleY = $image->height() / $originalHeight;
    //         $positionX *= $scaleX;
    //         $positionY *= $scaleY;
    //         $image->text($text, $positionX, $positionY, function ($font) use ($fontSize, $fontWeight) {
    //             if ($fontWeight == 'bold') {
    //                 $font->file('./font/roboto/font-bold.ttf');
    //             } else {
    //                 $font->file('./font/roboto/font-regular.ttf');
    //             }
    //             $font->size($fontSize);
    //             $font->color('#ffffff');
    //         });
    //         $mainDirectory = "Templates";
    //         $subDirectory = Auth::user()->first_name . "-Templates";
    //         if (!File::exists($mainDirectory)) {
    //             File::makeDirectory($mainDirectory, 0777, true, true);
    //         }
    //         if (!File::exists($mainDirectory . "/" . $subDirectory)) {
    //             File::makeDirectory($mainDirectory . "/" . $subDirectory, 0777, true, true);
    //         }
    //         $outputImageName = ucfirst($text) . "-" . rand(10000, 90000) . ".png";
    //         $outputPath = $mainDirectory . "/" . $subDirectory . "/" . $outputImageName;
    //         $image->save($outputPath);
    //         try {
    //             if (Templates::where('title', $text)->first()) {
    //                 File::delete($request->template);
    //                 Templates::where('title', $text)->update([
    //                     'title' => $text,
    //                     "csv_file" => $request->csv_file_name,
    //                     "font_family" => "Roboto",
    //                     "text_effect" => "Normal",
    //                     "template" => $outputPath,
    //                 ]);
    //             } else {
    //                 Templates::create([
    //                     'title' => $text,
    //                     "csv_file" => $request->csv_file_name,
    //                     "font_family" => "Roboto",
    //                     "text_effect" => "Normal",
    //                     "template" => $outputPath,
    //                 ]);
    //             }

    //             $msg = 200;
    //         } catch (\Exception $e) {
    //             dd($e->getMessage());
    //             $msg = 500;
    //         }
    //         $msg = 200;
    //     }
    //     if ($msg == 200) {
    //         return response()->json(['success' => true, 'message' => 200]);
    //     }
    // }
    // public function  allTemplates()
    // {
    //     $alltemplates = Templates::latest()->get();
    //     return view('Templates.all', compact("alltemplates"));
    // }
    // public  function  makeZipFile(Request $request)
    // {
    //     $zipFileName =  strtolower(Auth::user()->first_name) . '_download_templates.zip';
    //     $zipFilePath = "Downloads/" . $zipFileName;
    //     $zip = new ZipArchive;
    //     if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    //         foreach ($request->data_ids as $data_id) {
    //             $template = Templates::where('id', $data_id)->first();
    //             if ($template) {
    //                 $imagePath = "Templates/" . Auth::user()->first_name . "-Templates";
    //                 $templateFilePath = $imagePath . '/' . substr($template->template, strrpos($template->template, '/') + 1);
    //                 if (file_exists($templateFilePath)) {
    //                     $zip->addFile($templateFilePath, substr($template->template, strrpos($template->template, '/') + 1));
    //                 } else {
    //                     return response()->json(['error' => 'Template file not found'], 404);
    //                 }
    //             } else {
    //                 return response()->json(['error' => 'Template not found'], 404);
    //             }
    //         }
    //         $zip->close();
    //         if (file_exists($zipFilePath)) {
    //             return response()->json([
    //                 "filename" => $zipFilePath,
    //             ]);
    //         } else {
    //             return response()->json(['error' => 'Failed to create zip file'], 500);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Failed to open zip file'], 500);
    //     }
    // }
    // public  function  downloadZip($value)
    // {
    //     return $value;
    // }
}
