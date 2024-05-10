<?php

namespace App\Http\Controllers;

use App\Models\Font;
use App\Http\Requests\StoreFontRequest;
use App\Http\Requests\UpdateFontRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use ZipArchive;
class FontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allfonts = Font::where('added_from', Auth::user()->id)->latest()->get();
        $array_data=[];
        foreach ($allfonts as $fonts){
            $zip = new ZipArchive;
            $ttfFileCount = 0;
            $zipFilePath = "./font/" . Auth::user()->id . "/" . $fonts->font_name . "/" . $fonts->font_file;
            if ($zip->open($zipFilePath) === TRUE) {
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $fileName = $zip->getNameIndex($i);
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                    if ($fileExtension !== 'ttf') {
                        continue;
                    }

                    if (stripos($fileName, 'italic') !== false) {
                        continue;
                    }

                    $ttfFileCount++;
                }
                $zip->close();
                $array_data[$fonts->font_name]=$ttfFileCount;
            } else {
                return "Failed to open the zip file.";
            }
        }
        return view('Fonts.view', compact("allfonts","array_data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Fonts.upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFontRequest $request)
    {
        $msg = null;
        if ($request->hasFile("font_file")) {
            $file = $request->file('font_file');
            $extension = $file->getClientOriginalExtension();
            if (!in_array($extension, ['zip', 'ttf'])) {
                return response()->json(['module' => 'font', 'message' => 'ttf_error'], 400);
            }
            $font_name = ucfirst($request->font_name);
            $filename = str_replace(" ", "-", $font_name);
            $mainDirectory = "font";
            $subDirectory = Auth::user()->id;
            $fontDirectory = $font_name;
            if (!File::exists($mainDirectory)) {
                File::makeDirectory($mainDirectory, 0777, true, true);
            }
            if (!File::exists($mainDirectory . "/" . $subDirectory)) {
                File::makeDirectory($mainDirectory . "/" . $subDirectory, 0777, true, true);
            }
            if (!File::exists($mainDirectory . "/" . $subDirectory . "/" . $fontDirectory)) {
                File::makeDirectory($mainDirectory . "/" . $subDirectory . "/" . $fontDirectory, 0777, true, true);
            }
            $saveFilePath = $mainDirectory . "/" . $subDirectory . "/" . $fontDirectory . "/" . $filename;
            if ($extension == "zip") {
                $filename=$filename.".".$extension;
                if (!$file->move($mainDirectory . "/" . $subDirectory . "/" . $fontDirectory, $filename.".".$extension)) {
                    return response()->json(['module' => 'font', 'message' => 'file_move_error'], 500);
                }
            } else {
                $filename=$filename.".zip";
                $ttfFile = $request->file('font_file');
                $ttfFilename = $ttfFile->getClientOriginalName();
                $zip = new ZipArchive;
                $zipFilePath = $mainDirectory . "/" . $subDirectory . "/" . $fontDirectory . "/" . $filename;
                if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
                    return response()->json(['module' => 'font', 'message' => 'zip_creation_error'], 500);
                }
                if (!$zip->addFile($ttfFile, $ttfFilename)) {
                    $zip->close();
                    return response()->json(['module' => 'font', 'message' => 'zip_addition_error'], 500);
                }
                $zip->close();
            }
            $msg = 200;
        }
        if ($msg == 200) {
            $input = $request->all();
            $input['font_file'] = $filename;
            $input['font_name'] = ucfirst($input['font_name']);
            $input['font_file_status'] = 1;
            $input['date'] = date('Y-m-d');
            $input['added_from'] = Auth::user()->id;
            Font::create($input);
            return response()->json([
                "message" => 200,
                "module" => "font",
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $font_File = Font::findOrFail($id);
        $status = $font_File->font_file_status;
        if ($status == 1) {
            Font::where('id', $font_File->id)->update([
                "font_file_status" => 0,
            ]);
        } else {
            Font::where('id', $font_File->id)->update([
                "font_file_status" => 1,
            ]);
        }
        $font_File = Font::findOrFail($id);
        return response()->json([
            "message" => $font_File,
            "module" => "font",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Font $font)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFontRequest $request, Font $font)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $font_file = Font::where('id', $id)->first();
        $filePath = './font/' . Auth::user()->id . "/" . $font_file->font_name . "/";
        if (File::deleteDirectory($filePath)) {
            $font_file->delete();
            return response()->json([
                "message" => 200,
            ]);
        }
    }
    public function downloadFont($filename)
    {
        $font = Font::where('font_file', $filename)->first();
        $filePath = './font/' . Auth::user()->id . "/" . $font->font_name . "/" . $filename;
        if ($filePath) {
            return response()->download($filePath);
        } else {
            return response()->json([
                "message" => "Sorry File is not Found in the Font Directory...!",
                "status" => 404,
            ]);
        }
    }
}
