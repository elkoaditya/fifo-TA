@extends('superadmin.barang.assets.body')

@section('content_new')
    <div class="card">
        <div class="card-header">
            <h4>Update Data barang</h4>
        </div>
        <div class="card-body">
            <form method="post" action="/superadmin/barang/save_update" enctype="multipart/form-data">@csrf
                <input value="{{$barang->id}}" type="hidden" name="id">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="todoTitleAdd" class="form-label">Nama</label>
                        <input type="text" id="todoTitleAdd" name="name" class="form-control" value="{{$barang->name}}" />
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="todoTitleAdd" class="form-label">berat</label>
                        <input type="text" id="todoTitleAdd" class="form-control" name="berat" value="{{$barang->berat}}" />
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="todoTitleAdd" class="form-label">Kategori Harga</label>
                        <select class="form-select" id="basicSelect" name="harga_id">
                            @foreach($hargas as $harga)
                                <option value="{{$harga->id}}" {{$barang->harga_id == $harga->id ? 'selected' : ''}}>{{$harga->name}} ( {{$harga->price}} )</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="todoTitleAdd" class="form-label">Kategori</label>
                        <select class="form-select" id="basicSelect" name="kategori_id">
                            @foreach($kategoris as $kategori)
                                <option value="{{$kategori->id}}" {{$kategori->id == $barang->kategori_id ? 'selected' : ''}}>{{$kategori->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <input type="submit" value="Update data barang" class="mt-1 btn btn-success" >
                </div>
            </form>
        </div>
    </div>
@endsection
