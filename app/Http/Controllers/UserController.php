<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return User::DataTable($request);
        }

        return view('user.index',[
            'title' => 'User',
            'description' => 'Ini adalah page untuk mengelola data user/pegawai',
            'breadcrumbs' => [
                'title' => 'User Data',
                'url' => route('user.index')
            ]
        ]);
    }


    public function create(){
        return view('user.create',[
            'title' => 'User',
            'description' => 'Ini adalah page untuk menambah data user/pegawai',
            'breadcrumbs' => [
                'title' => 'User Create',
                'url' => route('user.create')
            ]
        ]);
    }

    public function store(Request $request){
        Validations::createUser($request);
        DB::beginTransaction();
        try {
            User::createUser($request->all());
            DB::commit(); 

            return Response::success([
                'message' => 'Data User Berhasil Disimpan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            
            return Response::error($e);
        }
    }

    public function get(User $user){
        DB::beginTransaction();
        try{
            return Response::success([
                'user' => $user
            ]);
        }catch(Exception $e){
            return Response::error($e);
        }
    }

    public function update(Request $request, User $user){
        Validations::updateUser($request);
        DB::beginTransaction();

        try {
            $user->updateUser($request->all());
            DB::commit();

            return Response::success([
                'message' => 'Data berhasil di update'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function destroy(User $user){
        DB::beginTransaction();
        try{
            $user->deleteUser();
            DB::commit();

            return Response::success([
                'message' => 'Delete Data Berhasil'
            ]);
        } catch (Exception $e){
            DB::rollBack();

            return Response::error($e);
        }
    }
}
