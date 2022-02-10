@extends('template')

@section('content')
    @include('modalorder')
    <table class="table">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Qty</th>
            <th scope="col">Customer</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script src="{{url('/assets/pages/listorder.js')}}"></script>
@endsection