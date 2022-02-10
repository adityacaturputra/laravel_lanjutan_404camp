<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function findAll() {
        
        if(request()->has('page')){
            $data = Product::paginate(
                20,
                ['id', 'title', 'category', 'price', 'stock', 'free_shipping', 'rate']
            );
        } else {
            $data = Product::select('id', 'title', 'category', 'price', 'stock', 'free_shipping', 'rate')->get();
        }
        
        if(count($data) == 0) {
            return BaseController::out(data: [], status: 'Kosong', code: 204);
        } else {
            return BaseController::out(data: $data, status: 'OK');
        }
    }

    public function findOne(Product $id) {
        return BaseController::out(data: $id, status: 'OK');
    }
}
