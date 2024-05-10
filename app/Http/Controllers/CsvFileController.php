<?php

namespace App\Http\Controllers;

use App\Models\Csv_File;
use App\Http\Requests\StoreCsv_FileRequest;
use App\Http\Requests\UpdateCsv_FileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnValueMap;

class CsvFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcsv_files = Csv_File::where('added_from', Auth::user()->id)->latest()->get();
        $array_data = [];

        foreach ($allcsv_files as $csv_file) {
            $file = $csv_file->csv_file;
            $mainDirectory = "CSV_FILES";
            $subDirectory = Auth::user()->id;
            $csvDirectory = $csv_file->csv_name;
            $csvFilePath = $mainDirectory . "/" . $subDirectory . "/" . $csvDirectory . "/";
            $filePath = $csvFilePath . $file;

            if (($handle = fopen($filePath, 'r')) !== false) {
                fgetcsv($handle, 1000, ',');
                $num = 0;
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $num++;
                }
                fclose($handle);
                $array_data[$csv_file->csv_name] = $num;
            } else {
                echo 'Error opening the CSV file';
            }
        }
        return view('Csv.view', compact("allcsv_files", "array_data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Csv.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCsv_FileRequest $request)
    {
        $input = $request->all();
        $csvFile = Csv_File::where('csv_name', ucfirst($input['csv_name']))->first();
        $mainDirectory = "CSV_FILES";
        $subDirectory = Auth::user()->id;
        $fontDirectory = ucfirst($request->csv_name);
        if (!File::exists($mainDirectory)) {
            File::makeDirectory($mainDirectory, 0777, true, true);
        }
        if (!File::exists($mainDirectory . "/" . $subDirectory)) {
            File::makeDirectory($mainDirectory . "/" . $subDirectory, 0777, true, true);
        }
        if (!File::exists($mainDirectory . "/" . $subDirectory . "/" . $fontDirectory)) {
            File::makeDirectory($mainDirectory . "/" . $subDirectory . "/" . $fontDirectory, 0777, true, true);
        }
        $saveFilePath = $mainDirectory . "/" . $subDirectory . "/" . $fontDirectory . "/";
        if ($csvFile) {
            $existingCsvFilePath = $saveFilePath . $csvFile->csv_file;
            $existingCsvData = array_map('str_getcsv', array_slice(file($existingCsvFilePath), 1));
            if ($request->file("csv_file")) {
                $file = $request->file("csv_file");
                $extension = $file->getClientOriginalExtension();
                if ($extension != 'csv') {
                    return response()->json(['module' => 'csv', 'message' => 'csv_error']);
                }
                $filename = str_replace(" ", "-", ucfirst($request->csv_name)) . "." . $extension;
                $file->move($saveFilePath, $filename);
                $input['csv_name'] = ucfirst($input['csv_name']);
                $input['csv_file'] = $filename;
                $input['csv_file_status'] = 1;
                $uploadedCsvFilePath = $saveFilePath . $filename;
                $uploadedCsvData = array_map('str_getcsv', file($uploadedCsvFilePath));
                $mergedCsvData = array_merge($existingCsvData, $uploadedCsvData);
                $mergedCsvFile = fopen($existingCsvFilePath, 'w');
                foreach ($mergedCsvData as $row) {
                    fputcsv($mergedCsvFile, $row);
                }
                fclose($mergedCsvFile);
                File::delete($existingCsvFilePath);
                $csvFile->update($input);
                return response()->json([
                    "message" => 200,
                    "module" => "csv",
                ]);
            }
        } else {
            if ($request->file("csv_file")) {
                $file = $request->file("csv_file");
                $extension = $file->getClientOriginalExtension();
                if ($extension != 'csv') {
                    return response()->json(['module' => 'csvFile', 'message' => 'csvFile_error']);
                }
                $filename = str_replace(" ", "-", ucfirst($request->csv_name)) . "." . $extension;
                $file->move($saveFilePath, $filename);
                $input['csv_name'] = ucfirst($input['csv_name']);
                $input['csv_file'] = $filename;
                $input['csv_file_status'] = 1;
                $input['date'] = date('Y-m-d');
                $input['added_from'] = Auth::user()->id;
                Csv_File::create($input);
                return response()->json([
                    "message" => 200,
                    "module" => "csv",
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $csv_File = Csv_File::findOrFail($id);
        $status = $csv_File->csv_file_status;
        if ($status == 1) {
            Csv_File::where('id', $csv_File->id)->update([
                "csv_file_status" => 0,
            ]);
        } else {
            Csv_File::where('id', $csv_File->id)->update([
                "csv_file_status" => 1,
            ]);
        }
        $csv_File = Csv_File::findOrFail($id);
        return response()->json([
            "message" => $csv_File,
            "module" => "csv_file",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Csv_File $csv_File)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCsv_FileRequest $request, Csv_File $csv_File)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $csv_File = Csv_File::where('id', $id)->first();
        $mainDirectory = "CSV_FILES";
        $subDirectory = Auth::user()->id;
        $csvDirectory = $csv_File->csv_name;
        $csvFilePath = $mainDirectory . "/" . $subDirectory . "/" . $csvDirectory . "/";
        if (File::deleteDirectory($csvFilePath)) {
            $csv_File->delete();
            return response()->json([
                "message" => 200,
            ]);
        }
    }
    public function downloadCsv($filename)
    {
        $csv_file = Csv_File::where('csv_file', $filename)->first();
        $mainDirectory = "CSV_FILES";
        $subDirectory = Auth::user()->id;
        $csvDirectory = $csv_file->csv_name;
        $csvFilePath = $mainDirectory . "/" . $subDirectory . "/" . $csvDirectory . "/";
        $filePath = $csvFilePath . $filename;
        if ($filePath) {
            return response()->download($filePath, $filename);
        } else {
            return response()->json([
                "message" => "Sorry File is not Found in the CSV_FILES Directory...!",
                "status" => 404,
            ]);
        }
    }
}
