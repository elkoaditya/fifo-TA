@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>



    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );
    </script>

@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')

    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Stock</th>
            <th>Kategori</th>
            <th>Harga/Gram</th>
            <th>Total Harga</th>
        </tr>
        </thead>
        <tbody>
        @foreach($barangs as $barang)
            <tr>
                <td>{{$barang->id}}</td>
                <td>{{$barang->name}}</td>
                <td>{{$barang->stock_sum_jumlah}}</td>
                <td>{{$barang->kategori->name}}</td>
                <td>{{$barang->harga->price}}</td>
                <td>{{$barang->berat * $barang->harga->price}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
{{--        @dd($barangs)--}}
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Stock</th>
            <th>Kategori</th>
            <th>Harga/Gram</th>
            <th>Total Harga</th>
        </tr>
        </tfoot>
    </table>

@endsection
