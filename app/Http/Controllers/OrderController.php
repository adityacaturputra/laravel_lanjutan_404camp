<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorization');
    }

    public function store(){
        // cari data product berdasarkan product_id
        $product = Product::find(\request('product_id'));

        if($product == null) {
            return BaseController::out(status: 'Gagal', error: ['Product tidak ditemukan'], code: 404);
        }

        $order = new Order();
        $order->order_date = Carbon::now('Asia/Jakarta');
        $order->product_id = $product->id;
        $order->customer_id = \request('customer_id');
        $order->qty = \request('qty');
        $order->price = $product->price;

        if($order->save() == true){ // jika operasi insert berhasil
            return BaseController::out(data: $order, status: 'OK', code: 201);
        } else { //jika operasi gagal
            return BaseController::out(status: 'Gagal', error: ['Order gagal disimpan'], code: '504');
        }
    }

    public function findAll() {
        $order = Order::query()
            ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftJoin('products', 'products.id', '=', 'orders.product_id');

        if(\request()->has('q')){
            $q = \request('q');
            $order->where('products.title', 'like', "%$q%");
        }

        $data = $order->paginate(
            10,
            [
                'orders.*',
                'customers.first_name', 'customers.last_name', 'customers.address', 'customers.city',
                'products.title as product_title'
            ]
        );

        return BaseController::out(data: $data, status: 'OK');
    }

    public function update(Order $order) {
        $product = Product::find(\request('product_id'));

        if($product == null) {
            return BaseController::out(status: 'Gagal', error: ['Produk tidak ditemukan'], code: 404);
        }

        $order->product_id = $product->id;
        $order->customer_id = \request('customer_id');
        $order->qty = \request('qty');
        $order->price = $product->price;

        $hasil = $order->save();

        return BaseController::out(
            status: $hasil ? 'OK' : 'Gagal',
            data: $hasil ? $order : null,
            error: $hasil ? null : ['Gagal mengubah data'],
            code: $hasil ? 201 : 504
        );
    }

    public function delete(Order $order) {
        $hasil = $order->delete();
        return BaseController::out(
            status: $hasil ? 'OK' : 'Gagal',
            data: $hasil ? $order : null,
            error: $hasil ? null : ['Gagal hapus data'],
            code: $hasil ? 200 : 504
        ); 
    }
}
