<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return Barang::DataTable($request);
        }

        return view('barang.index',[
            'title' => 'Barang',
            'description' => 'Ini adalah page untuk mengelola data barang',
            'breadcrumbs' => [
                'title' => 'Data Barang',
                'url' => route('barang.index')
            ]
        ]);
    }

    public function store(Request $request){
        Validations::createBarang($request);
        DB::beginTransaction();
        try {
            Barang::createBarang($request->all());
            DB::commit();

            return Response::success([
                'Data Barang Berhasil Ditambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function get(Barang $barang){
        DB::beginTransaction();
        try {
            return Response::success([
                'barang' => $barang
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function update(Request $request, Barang $barang){
        Validations::updateBarang($request, $barang);
        DB::beginTransaction();
        try {
            $barang->updateBarang($request->all());
            DB::commit();
            
            return Response::success([
                'message' => 'Data Barang Berhasil Di Update'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function destroy(Barang $barang){
        DB::beginTransaction();
        try {
            $barang->deleteBarang();
            DB::commit();

            return Response::success([
                'message' => 'Data Berhasil Di Hapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }


    public function getBarang(Request $request){
        try {
            $id = $request->id;
            $barang = new Barang();

            // $barang->where('id', $request->id)->first();
            $data = $barang->where('id', $id)->get();

            return Response::success([
                'data' => $data
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}

