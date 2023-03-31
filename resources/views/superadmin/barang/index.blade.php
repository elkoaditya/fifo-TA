@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/editors/quill/katex.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/editors/quill/monokai-sublime.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/editors/quill/quill.snow.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/forms/select/select2.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/extensions/dragula.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/extensions/toastr.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/form-quill-editor.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/extensions/ext-component-toastr.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/form-validation.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/pages/app-todo.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/forms/select/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/pickers/form-pickadate.css">
@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/editors/quill/katex.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/editors/quill/quill.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/dragula.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/form-select2.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/js/scripts/pages/app-todo.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
<script>
    var todoDescEditor = new Quill('#task-desc', {
        bounds: '#task-desc',
        modules: {
            formula: true,
            syntax: true,
            toolbar: '.desc-toolbar'
        },
        placeholder: 'Write Your Description',
        theme: 'snow'
    });
    function textSave(){
        $("#hiddenArea").val(todoDescEditor.getText());
    }
</script>

<script language="JavaScript">
    // Webcam.set({
    //     width: 150,
    //     height: 130,
    //     image_format: 'jpeg',
    //     jpeg_quality: 90
    // });
    //
    // Webcam.attach( '#my_camera' );
    //
    // function take_snapshot() {
    //     Webcam.snap( function(data_uri) {
    //         $(".image-tag").val(data_uri);
    //         document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    //     } );
    // }
</script>

@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')
@php
$fKategori = request()->get('kategori');
@endphp


<!-- BEGIN: Content-->
<div class="todo-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content todo-sidebar">
                    <div class="todo-app-menu">
                        <div class="add-task">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-task-modal">
                                Tambah Prangkat
                            </button>
                        </div>
                        <div class="sidebar-menu-list">
                            <div class="list-group list-group-filters">
                                <a href="/superadmin/barang" class="list-group-item list-group-item-action {{$fKategori == null ? 'active' : ''}}">
                                    <i data-feather="book-open" class="font-medium-3 me-50"></i>
                                    <span class="align-middle">All Prangkat</span>
                                </a>
                            </div>
                            <div class="mt-3 px-2 d-flex justify-content-between">
                                <h6 class="section-label mb-1">Kategori</h6>
                            </div>
                            @foreach($kategoris as $kategori)
                                <div class="list-group list-group-filters">
                                    <a href="/superadmin/barang?kategori={{$kategori->id}}" class="list-group-item list-group-item-action {{$fKategori == $kategori->id ? 'active' : ''}}">
                                        <i data-feather="folder" class="font-medium-3 me-50"></i>
                                        <span class="align-middle">{{$kategori->name}}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-right full-width">
            <div class="content-wrapper container-xxl p-0">

                {{--                    <div class="add-task m-1">--}}
                {{--                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-task-modal">--}}
                    {{--                            Tambah Prangkat--}}
                    {{--                        </button>--}}
                {{--                    </div>--}}

                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="body-content-overlay"></div>
                    <div class="todo-app-list">
                        <!-- Todo search starts -->
                        <div class="app-fixed-search d-flex align-items-center">
                            <div class="sidebar-toggle d-block d-lg-none ms-1">
                                <i data-feather="menu" class="font-medium-5"></i>
                            </div>
                            <div class="d-flex align-content-center justify-content-between w-100">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                    <input type="text" class="form-control" id="todo-search" placeholder="Search Visitor" aria-label="Search..." aria-describedby="todo-search" />
                                </div>
                            </div>
                        </div>
                        <!-- Todo search ends -->

                        <!-- Todo List starts -->
                        <div class="todo-task-list-wrapper list-group">
                            <ul class="todo-task-list media-list" id="todo-task-list">
                                @foreach($barangs as $barang)
                                <a href="/superadmin/barang/{{$barang->id}}" style="text-decoration: none; color: inherit;">
                                    <li class="todo-item ">
                                        <div class="todo-title-wrapper">
                                            <div class="todo-title-area">
                                                <i data-feather="more-vertical" class="drag-icon"></i>
                                                <div class="title-wrapper">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customCheck1" />
                                                        <label class="form-check-label" for="customCheck1"></label>
                                                    </div>
                                                    <span class="todo-title">{{$barang->name}} </span>
                                                    <span class="badge rounded-pill badge-light-success">stock : {{$barang->stock_sum_jumlah}}</span>
                                                </div>
                                            </div>
                                            <div class="todo-item-action">
                                                <small class="text-nowrap text-muted me-1"></small>
                                                <div class="badge-wrapper me-1">
{{--                                                    <span class="badge rounded-pill badge-light-success">{{$barang->stock_sum_jumlah}}</span>--}}
                                                </div>
                                                <div class="badge-wrapper me-1">
                                                    <span class="badge rounded-pill badge-light-info">{{$barang->kategori->name}}</span>
                                                </div>
                                                <div class="avatar">
                                                    <img src="{{$barang->image_url == null ? asset('vuexy').'/app-assets/images/box.png' : '/storage/'.$barang->image_url}}" alt="user-avatar" height="32" width="32" />
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                                @endforeach
                            </ul>
                            <div class="no-results">
                                <h5>No Items Found</h5>
                            </div>
                        </div>
                        <!-- Todo List ends -->
                    </div>

                    <!-- Right Sidebar starts -->
                    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                        <div class="modal-dialog sidebar-lg">
                            <div class="modal-content p-0">
                                <form id="" class="todo-modal needs-validation" novalidate action="/superadmin/barang/create" method="post" enctype="multipart/form-data">@csrf
                                    <div class="modal-header align-items-center mb-1">
                                        <div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
                                            <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                        <div class="action-tags">
                                            <div class="mb-1">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <label for="todoTitleAdd" class="form-label">Nama</label>
                                                        <input type="text" id="todoTitleAdd" name="name" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="todoTitleAdd" class="form-label">berat</label>
                                                        <input type="text" id="todoTitleAdd" class="form-control" name="berat" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="todoTitleAdd" class="form-label">jumlah</label>
                                                        <input type="text" id="todoTitleAdd" class="form-control" name="jumlah"/>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <label for="todoTitleAdd" class="form-label">Kategori Harga</label>
                                                        <select class="form-select" id="basicSelect" name="harga_id">
                                                            @foreach($hargas as $harga)
                                                                <option value="{{$harga->id}}">{{$harga->name}} ( {{$harga->price}} )</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <label for="todoTitleAdd" class="form-label">Kategori</label>
                                                        <select class="form-select" id="basicSelect" name="kategori_id">
                                                            @foreach($kategoris as $kategori)
                                                                <option value="{{$kategori->id}}">{{$kategori->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-1 mt-1">
{{--                                                            <div id="my_camera"></div>--}}
{{--                                                            <input type=button value="Ambil foto" onClick="take_snapshot()">--}}
                                                            <input type="file" name="image" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-primary d-none add-todo-item me-1" onclick="textSave()">Tambah</button>
                                        <button type="button" class="btn btn-outline-secondary add-todo-item d-none" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="twoFactorAuthModal" tabindex="-1" aria-labelledby="twoFactorAuthTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 mx-50">
                <h1 class="text-center mb-1" id="twoFactorAuthTitle">Pilih metode reuse</h1>
                <p class="text-center mb-3">
                    silahkan pilih metode reuse berdasarkan keperluan anda
                </p>
                <form method="post" action="/admin/prangkat/reuse">@csrf
                    <div class="custom-options-checkable">
                        <input class="custom-option-item-check" type="radio" name="typereuse" id="twoFactorAuthApps" value="othertome" checked />
                        <label for="twoFactorAuthApps" class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2 mb-2">
                            <span><i data-feather="package" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
                            <span>
                                <span class="custom-option-item-title h3">From Other to Me</span>
                                <span class="d-block mt-75">
                                    Dapat mneggunakan prangkat milik orang lain apa bila orang lain tersebut membuat prangkat untuk "public" untuk mensetting access prangkat dapat di edit pada menu prangkat
                                </span>
                            </span>
                        </label>
                        <input class="custom-option-item-check" type="radio" name="typereuse" value="metome" id="twoFactorAuthSms" />
                        <label for="twoFactorAuthSms" class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2">
                            <span><i data-feather="rotate-cw" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
                            <span>
                                <span class="custom-option-item-title h3">From Me to Me</span>
                                <span class="d-block mt-75">
                                    Menggunakan lagi atau mengkopy prangkat yang sudah kita buat.
                                </span>
                            </span>
                        </label>

                        <input class="custom-option-item-check" type="radio" name="typereuse" value="othertoother" id="othertoother" />
                        <label for="othertoother" class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2 mt-2">
                            <span><i data-feather="crosshair" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
                            <span>
                                <span class="custom-option-item-title h3">From Other to Other</span>
                                <span class="d-block mt-75">
                                    Menggunakan prangkat milik orang lain ke orang lain lagi.
                                </span>
                            </span>
                        </label>
                    </div>
                    <button id="nextStepAuth" class="btn btn-primary float-end mt-3">
                        <span class="me-50">Continue</span>
                        <i data-feather="chevron-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- END: Content-->
@endsection
