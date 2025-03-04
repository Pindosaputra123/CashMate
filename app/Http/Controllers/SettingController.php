<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function setProfile(){
        return view('setting.profile',[
            'title' => 'Setting',
            'description' => 'Ini adalah page untuk mengubah profile anda',
            'breadcrumbs' => [
                'title' => 'Set Profile',
                'url' => route('settings.set-profile')
            ]
        ]);
    }
    public function setPassword(){
        return view('setting.change_password',[
            'title' => 'Setting',
            'description' => 'Ini adalah page untuk mengubah Password anda',
            'breadcrumbs' => [
                'title' => 'Set Password',
                'url' => route('settings.set-password')
            ]
        ]);
    }

    public function updateProfile(Request $request){
        Validations::setProfile($request, auth()->user()->id);
        DB::beginTransaction();
        try {
            auth()->user()->update($request->all());
            DB::commit();

            return Response::success([
                'message' => 'Data Berhasil Di Update'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function updatePassword(Request $request){
        Validations::setPassword($request, auth()->user()->id);
        DB::beginTransaction();

        try {
            auth()->user()->savePassword($request->password);
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
