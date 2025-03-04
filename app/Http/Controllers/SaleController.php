<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Transaction;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return Sale::DataTable($request);
        }
        $sale = Sale::sum('total_bayar');
        return view('transaksi.index',[
            'title' => 'Transaksi',
            'description' => 'Ini adalah page data transaksi',
            'grandTotal' => $sale,
            'breadcrumbs' => [
                'title' => 'Data Transaksi',
                'url' => route('incoming_sale.index')
            ]
        ]);
    }
    public function create(){
        return view('transaksi.create',[
            'title' => 'Transaksi',
            'description' => 'Ini adalah page untuk menambah data transaksi',
            'cust' => Customer::all(), 
            'barangs' => Barang::all(),
            'breadcrumbs' => [
                'title' => 'Transaksi masuk',
                'url' => route('incoming_sale.create')
            ]
        ]);
    }
    public function store(Request $request){
        Validations::createTransaksi($request);
        DB::beginTransaction();
        try {
            $dataSale = [
                'code' => $request->kode,
                'tanggal' => $request->tanggal,
                'cust_id' => $request->cust_id,
                'subtotal' => $request->total,
                'diskon' => $request->diskonPay,
                'ongkir' => $request->ongkir,
                'total_bayar' => $request->total_bayar
            ];

            $sale = Sale::createSale($dataSale);
            $idSale = $sale->id;
            $dataTable = json_decode($request->dataTable, true);

            foreach ($dataTable as $row) {
                $kodeBarang = $row['kode'];
                $barang = Barang::where('kode', $kodeBarang)->select('id')->first();
                $idBarang = $barang->id;
                $dataSaleDetails = [
                    'sales_id' => $idSale,
                    'barang_id' => $idBarang,
                    'harga_bandrol' => $row['price'],
                    'qty' => $row['qty'],
                    'diskon_pct' => $row['diskon'],
                    'diskon_nilai' => $row['nominalDiskon'],
                    'harga_diskon' => $row['hargaDiskon'],
                    'total' => $row['totalHarga']
                ];

                SaleDetail::createData($dataSaleDetails);
            };
            DB::commit();

            return Response::success([
                'message' => 'Data Transaksi Berhasil Di Buat'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
