<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function findAll() {
        $order = Customer::query();

        if(\request()->has('q')){
            $q = \request('q');
            $order->where('email', 'like', "%$q%");
        }

        $data = $order->paginate(
            10,
            [
                'id', 'first_name', 'last_name', 'address', 'city',
            ]
        );

        return BaseController::out(data: $data, status: 'OK');
    }
}
