@extends('superadmin.barang.assets.body')

@section('content_new')

    <div class="card">
        <table class="invoice-table table text-nowrap">
            <thead>
            <tr>
                <th>#ID</th>
                {{--                                        <th><i data-feather="trending-up"></i></th>--}}
                <th>Jumlah barang</th>
                <th class="text-truncate">tanggal_masuk</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach($stocks as $stock)
                <tr>
                    <td>{{$x++}}</td>
                    <td>{{$stock->jumlah}}</td>
                    <td>{{$stock->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
