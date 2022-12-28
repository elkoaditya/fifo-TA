@extends('superadmin.barang.assets.body')

@section('content_new')

    <div class="card">
        <table class="invoice-table table text-nowrap">
            <thead>
            <tr>
                <th>#ID</th>
                {{--                                        <th><i data-feather="trending-up"></i></th>--}}
                <th>Jumlah</th>
                <th>Status</th>
                <th class="text-truncate">tanggal_masuk</th>
            </tr>
            </thead>
            <tbody>
            @foreach($historys as $history)
                <tr>
                    <td>{{$history->id}}</td>
                    <td>{{$history->jumlah}}</td>
                    <td>{{$history->status}}</td>
                    <td>{{$history->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
