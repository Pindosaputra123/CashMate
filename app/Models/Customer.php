<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * For Relational Database
     */
    public function Sale()
    {
        return $this->hasMany(SaleDetail::class, 'cust_id');
    }

    /**
     * For Crud
     */

    public static function createCust($request)
    {
        $data = self::create($request);
        return $data;
    }

    public function updateCustomer($request)
    {
        return $this->update($request);
    }

    public function deleteCustomer()
    {
        return $this->delete();
    }
    /**
     * For DataTable
     */
    public static function DataTable($request)
    {
        $data = self::select(['customers.*']);

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
                    <a class="dropdown-item edit" data-get-href="' . route('customer.get', $data->id) . '" data-update-href="' . route('customer.update', $data->id) . '"><i class="bi bi-pencil-square me-50"></i> Edit</a>
                    <a class="dropdown-item delete" data-delete-message="Yakin Ingin Menghapus Data Cus ' . $data->name . '" data-delete-href="' . route('customer.destroy', $data->id) . '"><i class="bi bi-trash3 me-50"></i> Delete</a>
                    </div>
                </div>

                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
