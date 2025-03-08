<?php

namespace App\Models;

use App\MyClass\KodeTransaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     *  For Relational Database
     */
    public function SaleDetail(){
        return $this->hasMany(SaleDetail::class, 'sales_id');
    }

    public function Customer(){
        return $this->belongsTo(Customer::class, 'cust_id');
    }

    /**
     *  For Create Transaksi
     */
    public static function createSale(array $data){
        return self::create($data);
    }

    public function setPrice($data){
        return '<span> Rp. '.number_format($data).'</span>';
    }

    /**
     * For DataTable
     */
    public static function DataTable($request){
        $data = self::with(['SaleDetail', 'Customer']);

        return \DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                <div class="dropdown">
                    <button
                    class="btn btn-primary dropdown-toggle me-1"
                    type="button"
                    id="dropdownMenuButtonIcon"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <i class="bi bi-error-circle me-50"></i> Pilih Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonIcon">
                    <a class="dropdown-item" href="' . route('incoming_sale.detail', $data->id) . '"><i class="bi bi-search me-50"></i> Detail</a>
                    <a class="dropdown-item delete" data-delete-message="Yakin Ingin Menghapus Data ' . $data->kode . '" data-delete-href="' . route('barang.destroy', $data->id) . '"><i class="bi bi-trash3 me-50"></i> Delete</a>
                    </div>
                </div>

                ';
                return $action;
            })
            ->editColumn('jumlah_barang', function($data){
                return $data->SaleDetail->count();
            })
            ->editColumn('cust_id', function($data){
                return $data->Customer->name;
            })
            ->editColumn('ongkir', function($data){
                return $data->setPrice($data->ongkir);
            })
            ->editColumn('subtotal', function($data){
                return $data->setPrice($data->subtotal);
            })
            ->editColumn('total_bayar', function($data){
                return $data->setPrice($data->total_bayar);
            })
            ->editColumn('diskon', function($data){
                return $data->setPrice($data->diskon);
            })
            ->rawColumns(['action', 'diskon', 'total_bayar', 'subtotal', 'ongkir'])
            ->make(true);
    }


    /**
     * For Kode Transaksi
     */
    public static function createFormatTransaksi($idTransaksi = null){
        // Ambil Tahun Saat Ini
        $tahunIni = date('Y');
        

        // Cari Transaksi Di Tahun Ini
        $transaksiTerbaru = self::whereBetween('tanggal', [$tahunIni.'-01-01', $tahunIni.'-12-31']);
        if($idTransaksi != null) {
            $transaksiTerbaru->whereNotIn('id', [$idTransaksi]);
        }
        $transaksiTerbaru->orderBy('created_at', 'DESC')->first();
        $transaksi = $transaksiTerbaru->first();
        
        if($transaksi){
            $noTransaksi = $transaksi->code;
            $explode = explode('/', $noTransaksi);
            $noUrut = (int) $explode[0];
            $noUrut++;
        }else {
            $noUrut = 1;
        }
        $urutan = str_pad($noUrut,4,0,STR_PAD_LEFT);

        $data = [
            'perusahaan' => 'SINERGY',
            'tanggal' => now(),
            'kodeBarang' => 'TRANS',
            'urutan' => $urutan,
        ];

        return KodeTransaksi::formatNoTransaksi($data);
    }
}
