<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFontRequest;
use App\Mail\StatusTemplate;
use App\Models\Collection;
use App\Models\Csv_File;
use App\Models\Design;
use App\Models\Font;
use App\Models\Niche;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '0');

class PagesController extends Controller
{
    public function signin()
    {
        if (session()->has('user_added')) {
            return redirect('/dashboard');
        } else {
            return view('Authentication.signin');
        }
    }
    public function forget()
    {
        return view('Authentication.forget');
    }
    public function reset()
    {
        return view('Authentication.reset');
    }
    public function dashboard()
    {
        $user = User::where("id", session()->get("user_added"))->first();
        $uploadedFonts = Font::where('added_from', Auth::user()->id)->get();
        $totalFonts = $uploadedFonts->count();
        $activeFonts = $uploadedFonts->where('font_file_status', 1)->count();
        $percentageActiveFonts = $totalFonts > 0 ? ($activeFonts / $totalFonts) * 100 : 0;
        $percentageActiveFonts=intval($percentageActiveFonts);
        $upladedCsvFiles = Csv_File::where('added_from', Auth::user()->id)->get();
        $totalCSV = $upladedCsvFiles->count();
        $activeCSVs = $upladedCsvFiles->where('csv_file_status', 1)->count();
        $percentageActiveCsvs = $totalCSV > 0 ? ($activeCSVs / $totalCSV) * 100 : 0;
        $percentageActiveCsvs=intval($percentageActiveCsvs);
        $uploadedtemplates = Template::where('added_from',Auth::user()->id)->count();
        $alluploadedDesigns = Design::where('added_from',Auth::user()->id)->count();
        $allTemplates = Template::all();
        $array_designs = [];
        foreach ($allTemplates as $template) {
            $designs = Design::where('template_id', $template->id)->count();
            if ($designs) {
                $array_designs[$template->id] = $designs;
                continue;
            }
        }
        $data = compact("user", "activeFonts", "percentageActiveFonts", "alluploadedDesigns","activeCSVs", "percentageActiveCsvs", "uploadedtemplates", "array_designs");
        return view('Pages.dashboard', $data);
    }
    public function profile()
    {
        $user = User::where("id", session()->get("user_added"))->first();
        $compact = compact("user");
        return view('Pages.profile')->with($compact);
    }
    public function editProfile()
    {
        return view('Pages.profile_edit');
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $message = "";
        if ($request->hasFile("picture")) {
            $image = $request->file('picture');
            $extension = $image->getClientOriginalExtension();
            $imageName = rand(10000, 90000) . "." . $extension;
            $image->move('./images/', $imageName);
            $message = 200;
        }
        if ($message == 200) {
            $picture = "./images/" . $imageName;
        } else {
            $picture = $user->picture;
        }
        User::where('id', $id)->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "contact_no" => $request->contact_no,
            "country" => $request->country,
            "state" => $request->state,
            "city" => $request->city,
            "picture" => $picture,
            "zip_code" => $request->zip_code,
            "address" => $request->address,
        ]);
        $afterUpdate = User::where('id', $id)->first();
        $data = [
            'name' => ucfirst($afterUpdate->first_name) . " " . ucfirst($afterUpdate->last_name),
            'first_name' => ucfirst($afterUpdate->first_name),
            'last_name' => ucfirst($afterUpdate->last_name),
            'email' => $afterUpdate->email,
            'picture' => $afterUpdate->picture,
            'contact_no' => $afterUpdate->contact_no,
            'country' => $afterUpdate->country,
            'state' => $afterUpdate->state,
            'city' => $afterUpdate->city,
            'zip_code' => $afterUpdate->zip_code,
            'address' => $afterUpdate->address,
        ];

        return response()->json([
            "message" => 200,
            "data" => $data,
        ]);
    }
    public function emailUpdate(Request $request, $id)
    {
        $request->validate([
            "email" => "unique:users,email,$id",
        ]);
        User::where('id', $id)->update([
            "email" => $request->email,
        ]);
        $afterEmailUpdate = User::where('id', $id)->first();
        $data = [
            'email' => $afterEmailUpdate->email,
        ];
        return response()->json([
            "message" => 200,
            "data" => $data,
        ]);
    }
    public function passwordUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ],
            [
                'password.confirmed' => 'Your Password is not Matched with the Confirm Password',
                'password.required' => 'Password Field is required',
                'password_confirmation.required' => 'Comfirmation Password is required within the Password',
            ]
        );
        User::where('id', $id)->update([
            "plain_password" => $request->password,
            "password" => bcrypt($request->password),
        ]);
        return response()->json([
            "message" => 200,
        ]);
    }
    public function apply_filteration(Request $request)
    {
        $explode_value = explode('-', $request->value);
        $start_date = date('Y-d-m', strtotime($explode_value[0]));
        $end_date = date('Y-d-m', strtotime($explode_value[1]));
        $uploadedFonts = Font::where('added_from', Auth::user()->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->get();
        $totalFonts = $uploadedFonts->count();
        $activeFonts = $uploadedFonts->where('font_file_status', 1)->count();
        $percentageActiveFonts = $totalFonts > 0 ? ($activeFonts / $totalFonts) * 100 : 0;
        $percentageActiveFonts = intval($percentageActiveFonts);
        $uploadedCsvFiles = Csv_File::where('added_from', Auth::user()->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->get();
        $totalCSV = $uploadedCsvFiles->count();
        $activeCSVs = $uploadedCsvFiles->where('csv_file_status', 1)->count();
        $percentageActiveCsvs = $totalCSV > 0 ? ($activeCSVs / $totalCSV) * 100 : 0;
        $percentageActiveCsvs = intval($percentageActiveCsvs);
        $uploadedtemplates = Template::where('added_from', Auth::user()->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->count();
        $data = [
            'totalFonts' => $totalFonts,
            'activeFonts' => $activeFonts,
            'percentageActiveFonts' => $percentageActiveFonts,
            'totalCSV' => $totalCSV,
            'activeCSVs' => $activeCSVs,
            'percentageActiveCsvs' => $percentageActiveCsvs,
            'uploadedtemplates' => $uploadedtemplates
        ];
        return response()->json($data);
    }
    public  function success()
    {
        return view('Installation.success');
    }
    public function  getAllUsers()
    {
        $allusers=User::where('is_admin',0)->latest()->get();
        return view('Pages.users',compact("allusers"));
    }
    public  function changeStatus($id)
    {
        $user=User::findorFail($id);
        if($user->is_active==1){
            $user->is_active=0;
            $getMessage="Your Account is In-active From the Admin.Now You Cannot Login!";
        }else{
            $user->is_active=1;
            $getMessage="Your Account is Active From the Admin.Now You Can Login!";
        }
        $user->update();
        Mail::to($user->email)->send(new StatusTemplate($user->first_name." ".$user->last_name,$getMessage,"User Status",User::where('is_admin',1)->first()->email));
        return response()->json([
            "message"=>200,
            "data"=>$user,
        ]);
    }
    public  function  filteration(Request $request)
    {
        if($request->type=="users"){
            $value = $request->value;
            $filterationData = User::where('first_name', 'like', '%' . $value . '%')
                ->orWhere('last_name', 'like', '%' . $value . '%')
                ->orWhere('email', 'like', '%' . $value . '%')
                ->where('is_admin', 0)
                ->latest()
                ->get();
            return response()->json([
                "data"=>$filterationData,
            ]);
        }else if($request->type=="csv_files"){
            $value = $request->value;
            $allcsv_files = Csv_File::where('csv_name', 'like', '%' . $value . '%')->where('added_from', Auth::user()->id)->latest()->get();
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
            return response()->json([
                "data"=>$allcsv_files,
                "array_data"=>$array_data,
            ]);
        }else if ($request->type=="fonts"){
            $value = $request->value;
            $allfonts = Font::where('font_name', 'like', '%' . $value . '%')->where('added_from', Auth::user()->id)->latest()->get();
            $array_data=[];
            foreach ($allfonts as $fonts){
                $zip = new \ZipArchive();
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
            return response()->json([
                "data"=>$allfonts,
                "array_data"=>$array_data,
            ]);
        }
    }
}
