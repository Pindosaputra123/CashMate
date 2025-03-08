<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     *  For Relationsal Database
     */

    public function Sale(){
        return $this->belongsTo(Sale::class, 'sales_id');
    }

    public function Barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    /**
     * For Crud
     */
    
    public static function createData(array $data){
        return self::create($data);
    }
}
