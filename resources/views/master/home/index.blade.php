@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')


    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">

@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h4 class="card-title">Ringkasan Data</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                            <h1 class="font-large-2 fw-bolder mt-2 mb-0">{{count($barangs)}}</h1>
                            <p class="card-text">Barang</p>
                        </div>
                        <div class="col-sm-10 col-12 d-flex justify-content-center">
                            <div id="support-trackers-chart"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <div class="text-center">
                            <p class="card-text mb-50">Total Stock</p>
                            <span class="font-large-1 fw-bold">{{$total['all']}}</span>
                        </div>
                        <div class="text-center">
                            <p class="card-text mb-50">Total Transaksi Masuk</p>
                            <span class="font-large-1 fw-bold">{{$total['masuk']}}</span>
                        </div>
                        <div class="text-center">
                            <p class="card-text mb-50">Total Transaksi Keluar</p>
                            <span class="font-large-1 fw-bold">{{$total['keluar']}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card invoice-list-wrapper">
                <div class="card-datatable table-responsive">
                    <table class="invoice-list-table table" id="myTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Harga pergram</th>
                            <th>Kategori</th>
                            <th class="text-truncate">Harga 1/gram</th>
                            <th>Stock</th>
                            <th>Harga totals</th>
                            <th class="cell-fit">Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x = 1; ?>>
                        @foreach($barangs as $barang)
                            <tr>
                                <td>{{$x++}}</td>
                                <td>{{$barang->name}}</td>
                                <td>{{$barang->berat}}</td>
                                <td>{{$barang->kategori->name}}</td>
                                <td>{{$barang->harga->price}}</td>
                                <td>{{$barang->stock_sum_jumlah}}</td>
                                <td>{{$barang->berat * $barang->harga->price}}</td>
                                <td>{{\Carbon\Carbon::parse($barang->created_at)->toDateString()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
