<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InstallationController extends Controller
{
    public function  index()
    {
        return view('Installation.install');
    }
    public function install(Request $request)
    {
        try {
            $dbName = $request->input('database_name');
            $dbUsername = $request->input('database_username');
            $dbPassword = $request->input('database_password');
            if($dbPassword!=""){
                $dbPassword=$dbPassword;
            }else{
                $dbPassword="";
            }
            $appName = $request->input('software_name');
            $softwareURL = $request->input('software_url');
            if($request->hasFile("software_logo")){
                $file=$request->file('software_logo');
                $extension=$file->getClientOriginalExtension();
                $fileName='/assets/media/logos/'.time().rand(1000,9000).".".$extension;
                $file->move('./assets/media/logos/',$fileName);
            }
            if($request->hasFile("picture")){
                $picture=$request->file('picture');
                $extension=$file->getClientOriginalExtension();
                $profilePicture='/assets/media/avatars/'.time().rand(1000,9000).".".$extension;
                $picture->move('./assets/media/avatars/',$profilePicture);
            }
            $email = $request->input('email');
            $password = $request->input('password');
            $envContent = file_get_contents(base_path('.env'));
            $envUpdates = [];
            $envUpdates['DB_DATABASE'] = "";
            $envUpdates['DB_USERNAME'] = "";
            $envUpdates['DB_PASSWORD'] = "";
            $envUpdates['SOFTWARE_URL'] = "";
            $envUpdates['APP_URL'] = "";
//            $envUpdates['APP_NAME'] = "";
            $envUpdates['SOFTWARE_NAME'] = "";
            $envUpdates['SOFTWARE_LOGO'] = "";
            $envUpdates['DB_DATABASE'] .= $dbName;
            $envUpdates['DB_USERNAME'] .= $dbUsername;
            $envUpdates['DB_PASSWORD'] .= $dbPassword;
            $envUpdates['SOFTWARE_URL'] .= $softwareURL;
            $envUpdates['APP_URL'] .= $softwareURL;
//            $envUpdates['APP_NAME'] .= '"' . $appName . '"';
            $envUpdates['SOFTWARE_NAME'] .= '"' . $appName . '"';
            $envUpdates['SOFTWARE_LOGO'] .= '"' . $fileName . '"';
            foreach ($envUpdates as $key => $value) {
                if (env($key) !== false) {
                    $envContent = str_replace("$key=" . env($key), "$key=$value", $envContent);
                } else {
                    $envContent .= PHP_EOL . "$key=$value";
                }
            }
            file_put_contents(base_path('.env'), $envContent);
            $databaseExists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'");
            if (empty($databaseExists)) {
                DB::statement("CREATE DATABASE $dbName");
                Artisan::call('migrate:fresh');
            } else {
                Artisan::call('migrate');
            }
            file_put_contents(public_path('installed'), '');
            User::create([
                "first_name" => "Admin",
                "last_name" => "Admin",
                "email" => $email,
                "email_verified_at" => now(),
                "password" => bcrypt($password),
                "plain_password" => $password,
                "contact_no" => "+92-**********",
                "country" => "Pakistan",
                "state" => "Punjab",
                "city" => "Faisalabad",
                "zip_code" => 38000,
                "address" => "Pakistan,Punjab,Faisalabad",
                "picture" => $profilePicture,
                "software_logo" => $fileName,
                "is_admin" => 1,
                "enter_from" => "Email",
                "is_active" => 1,
            ]);
            return response()->json(["message" => 200], 200);
        } catch (\Exception $e) {
            Log::error('Installation failed: ' . $e->getMessage());
            return response()->json(["error" => "Installation failed: " . $e->getMessage()], 500);
        }
    }
}
