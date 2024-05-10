<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Models\Csv_File;
use App\Models\Design;
use App\Models\Font;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ZipArchive;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alltemplates = Template::where('added_from', Auth::user()->id)->latest()->paginate(12);
        $array_designs = [];
        foreach ($alltemplates as $templates) {
            $design = Design::where('template_id', $templates->id)->first();
            if ($design) {
                $array_designs[$templates->id] = $design;
                continue;
            }
        }
        return view('Templates.view', compact("alltemplates", "array_designs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $csv_files = Csv_File::where('added_from', Auth::user()->id)->where('csv_file_status', 1)->latest()->get();
        $compact = compact("csv_files");
        return view('Templates.add')->with($compact);
        // ==================now code ================================
        // ==================alerady code ============================
        // $filePath = "./assets/js/font_families.json";
        // $content = file_get_contents($filePath);
        // $fontFamiliesData = json_decode($content, true);
        // $fontFamilies = $fontFamiliesData['fontFamilies'];
        // $csvfilesPath = "./csv_files/";
        // $files = scandir($csvfilesPath);
        // $csv_files = array_diff($files, ['.', '..']);
        // $compact = compact("fontFamilies", "csv_files");
        // return view('Templates.add')->with($compact);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemplateRequest $request)
    {
        $input = $request->all();
        if ($request->hasfile("template_picture")) {
            $template = $request->file("template_picture");
            $extension = $template->getClientOriginalExtension();
            $filename = Str::slug($input['template_title'], '-') . "." . $extension;
            $template->move("uploads/", $filename);
            $msg = 200;
        }
        if ($msg == 200) {
            $input['template_picture'] = $filename;
            Template::create($input);
            return response()->json([
                "message" => 200,
                "module" => "template",
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        $status = $template->template_status;
        if ($status == 1) {
            Template::where('id', $template->id)->update([
                "template_status" => 2,
            ]);
        } else {
            Template::where('id', $template->id)->update([
                "template_status" => 1,
            ]);
        }
        return response()->json([
            "message" => $template,
            "module" => "template",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemplateRequest $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        if ($template->delete()) {
            return response()->json([
                "message" => "template",
            ]);
        }
    }
    public function gettingData()
    {
        $alltempltes = Template::whereNull('deleted_at')->latest()->get();
        return response()->json([
            "data" => $alltempltes,
        ]);
    }
    public function getFontType($value)
    {
        if ($value == "google") {
            $apiKey = 'AIzaSyC6H1NGVqEH2u0epLKZEu5wk4Oj3kd_a4Y';
            $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $apiKey;
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
                $fontFamilies = array_column($data['items'], 'family');
            }
            return response()->json([
                "data" => $fontFamilies,
            ]);
        } else {
            $fonts = Font::where(['added_from' => Auth::user()->id, "font_file_status" => 1])->get();
            $fontFamilies = $fonts->pluck('font_name')->toArray();
            return response()->json([
                "data" => $fontFamilies,
            ]);
        }
    }
    public function designsDownload($id)
    {
        $directory = 'designs';
        if (!File::exists($directory)) {
            return "Directory not found.";
        }
        $zipFileName = 'Templates-'.date('d M, Y').'.zip';
        $zipFilePath = $zipFileName;
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = Design::where('template_id', $id)->get();
            if ($files->count() > 0) {
                foreach ($files as $file) {
                    $filePath = $file->design_image;
                    if (File::exists($filePath)) {
                        $zip->addFile($filePath, basename($filePath));
                    } else {
                        return "File not found: $filePath";
                    }
                }
                $zip->close();
            } else {
                return "No design images found for template $id.";
            }
        } else {
            return "Failed to create zip file.";
        }
        if (File::exists($zipFilePath)) {
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return "Failed to create zip file.";
        }
    }
    public function getDesignDetails($id)
    {
        $alldesigns = Design::where('template_id', $id)->paginate(12);
        return view('Templates.detail', compact("alldesigns"));
    }
}
