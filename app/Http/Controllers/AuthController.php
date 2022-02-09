<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;

class AuthController extends Controller
{
    public function auth() {
        $authHeader = \request()->header('Authorization'); // basic xxxbase64encodexxx
        $keyAuth = substr($authHeader, 6); // remove basic text. So, inside is 'xxxbase64encodexxx'

        $plainAuth = base64_decode($keyAuth); // decode text info login
        $tokenAuth = explode(':', $plainAuth); // split email:password

        $email = $tokenAuth[0]; // email
        $password = $tokenAuth[1]; // password

        $data = (new Customer())->newQuery()
            ->where(['email' => $email])
            ->get(['id', 'first_name', 'last_name', 'email', 'password'])->first();
        
        if($data == null) { // Jika data tidak ditemukan
            return BaseController::out(
                status: 'Gagal',
                error: ['Pengguna tidak ditemukan'],
                code: 404, // 404 tidak ditemukan
            );
        } else { // Jika data ditemukan
            if(Hash::check($password, $data->password)){
                $data->token = hash('sha256', Str::random(10)); // buat token untuk dikirim ke client
                unset($data->password); // hilangkan informasi password yang dikirim ke client
                $data->update(); // update token disimpan ke table customer

                return BaseController::out(data: $data, status: 'OK');
            } else {
                return BaseController::out(
                    status: 'Gagal',
                    error: ['Anda tidak memiliki wewenang'],
                    code: 401, // 401 unauthorized
                );
            }
        }
    }
}
