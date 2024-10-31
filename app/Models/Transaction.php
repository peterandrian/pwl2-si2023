<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaksi_penjualan';
    protected $fillable = [
        'id_kasir', 
        // Add other fields here as necessary
    ];

    public function get_transaction(){
        $sql = $this->select("transaksi_penjualan.*", 
                            "kasir.nama_kasir as nama_kasir", 
                            DB::raw("GROUP_CONCAT(products.title SEPARATOR ', ') as product_names"), 
                            DB::raw("GROUP_CONCAT(products.price SEPARATOR ', ') as product_prices"), 
                            DB::raw("GROUP_CONCAT(detail_transaksi_penjualan.jumlah_pembelian SEPARATOR ', ') as jumlah_pembelian"),
                            DB::raw("SUM(products.price * detail_transaksi_penjualan.jumlah_pembelian) as total_transaction")) // Calculating the total
                    ->join('detail_transaksi_penjualan', 'detail_transaksi_penjualan.id_transaksi_penjualan', '=', 'transaksi_penjualan.id')
                    ->join('kasir', 'kasir.id', '=', 'transaksi_penjualan.id_kasir')
                    ->join('products', 'products.id', '=', 'detail_transaksi_penjualan.id_product')
                    ->join('category_product', 'category_product.id', '=', 'products.product_category_id')
                    ->groupBy('transaksi_penjualan.id', 'transaksi_penjualan.id_kasir', 'transaksi_penjualan.created_at', 'transaksi_penjualan.updated_at', 'kasir.nama_kasir', 'transaksi_penjualan.email_pembeli'); // Group by all relevant fields
        return $sql;
        
        if ($id) {
            // Filter for a specific transaction if an ID is provided
            $sql->where('transaksi_penjualan.id', $id);
        }
    }
    public function get_cashier(){
        $sql = DB::table('kasir')->select("*");
        return $sql;
    }

}


