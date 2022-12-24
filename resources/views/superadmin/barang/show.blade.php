@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/forms/select/select2.min.css">

@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')

    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/form-select2.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script>
        var confirmText = $('#confirm-text');
        function deleteJemaat (){
            Swal.fire({
                title: 'Delete data jemaat',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus Jemaat',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-outline-success ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    document.getElementById('form-delete').submit();
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Data jemaat berhasil dihapus',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }
            });
        }
    </script>
    <script>
        function changeStatus(){
            $.post('/admin/jemaat/change-status',
                {
                    '_token': '{{ csrf_token() }}',
                    id: '{{ $barang->id }}',
                })
        }
    </script>
    <script>
        function changePrivilage(id){
            console.log(id)
            $.post('/admin/jemaat/change-privilege',
                {
                    '_token': '{{ csrf_token() }}',
                    id: '{{ $barang->id }}',
                    privilege_id: id,
                }).catch(function(){
                alert('error to change privilege')
            }).done(function(){
                location.reload();
            })
        }
        function changeRole(id){
            console.log(id)
            $.post('/admin/jemaat/change-role',
                {
                    '_token': '{{ csrf_token() }}',
                    id: '{{ $barang->id }}',
                    role: id,
                }).catch(function(){
                alert('error to change privilege')
            }).done(function(){
                location.reload();
            })
        }
    </script>
@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')
    <form method="POST" action="/admin/jemaat/{{$barang->id}}" id="form-delete">@csrf
        @method('delete')
    </form>

    <div class="">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="app-user-view-account">
                    <div class="row">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2" src="/default-foto-profile.png" height="110" width="110" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4 class="text-success">{{$barang->name}}</h4>
                                                {{--                                                @if($barang->user->is_whatsapp_validated == null)--}}
                                                {{--                                                    <h4 class="text-warning">{{$barang->user->name}}</h4>--}}
                                                {{--                                                @else--}}
                                                {{--                                                    <h4 class="text-success">{{$barang->user->name}}</h4>--}}
                                                {{--                                                @endif--}}
                                                <span class="badge bg-light-secondary">{{$barang->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around my-2 pt-75">
                                        <div class="d-flex align-items-start me-2">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="award" class="font-medium-2 rounded"></i>
                                            </span>
                                            <div class="ms-75">
                                                <div class="btn-group">
{{--                                                    <button {{$barang->privilege_owner != null ? 'disabled' : ''}} class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                        {{$barang->privilege->name}}--}}
{{--                                                    </button>--}}
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
{{--                                                        @foreach($privileges as $privilege)--}}
{{--                                                            <a class="dropdown-item" href="#" onclick="changePrivilage('{{$privilege->id}}')">{{$privilege->name}}</a>--}}
{{--                                                        @endforeach--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row border-bottom pb-50 mb-1">
                                        <div class="col-9">
                                            <h4 class="fw-bolder ">Details</h4>
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex flex-column">
                                                <label class="form-check-label mb-50" for="customSwitch4">Aktif</label>
                                                <div class="form-check form-check-success form-switch">
                                                    <input type="checkbox" {{$barang->is_active == 1 ? 'checked' : ''}} class="form-check-input" id="customSwitch4" onclick="changeStatus()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">whatsapp:</span>
                                                <span>{{$barang->whatsapp_number}}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Alamat:</span>
                                                <span>{{$barang->alamat}}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Kota:</span>
                                                <span>{{$barang->kota}}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Shio:</span>
                                                <span>{{$barang->name}}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Tanggal Lahir:</span>
                                                <span>{{$barang->tanggal_lahir}}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Keanggotaan:</span>
                                                <span>{{$barang->name}}</span>
                                            </li>
                                            <li class="mb-75">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <span class="fw-bolder justify-content-center">Jabatan:</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="">
                                                            <div class="btn-group">
                                                                <button {{$barang->privilege_owner != null ? 'disabled' : ''}} class="btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{$barang->role}}
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#" onclick="changeRole('staff')">Staff</a>
                                                                    <a class="dropdown-item" href="#" onclick="changeRole('jemaat')">Jemaat</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                        <div class="d-flex justify-content-center pt-2">
                                            <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                                                Edit
                                            </a>
                                            <a href="javascript:;" class="btn btn-outline-danger suspend-user" onclick="deleteJemaat()">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ User Sidebar -->

                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            <!-- User Pills -->
                            <ul class="nav nav-pills mb-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="/admin/jemaat/{{$barang->id}}">
                                        <i data-feather="user" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Sumbangan</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/">
                                        <i data-feather="lock" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Security</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="card">
                                <table class="invoice-table table text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>#ID</th>
                                        <th><i data-feather="trending-up"></i></th>
                                        <th>TOTAL Paid</th>
                                        <th class="text-truncate">Issued Date</th>
                                        <th class="cell-fit">Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /Invoice table -->
                        </div>
                        <!--/ User Content -->
                    </div>
                </section>
                <!-- Edit User Modal -->
                <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-5 px-sm-5 pt-50">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Edit User Information</h1>
                                    <p>Updating user details will receive a privacy audit.</p>
                                </div>
                                <form id="editUserForm" class="row gy-1 pt-75" method="post" action="/admin/jemaat/{{$barang->id}}">@csrf
                                    @method('put')
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserFirstName">Nama Lengkap</label>
                                        <input type="text" id="modalEditUserFirstName" name="name" class="form-control" value="{{$barang->name}}" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserLastName">Whatsapp</label>
                                        <input type="text" id="modalEditUserLastName" name="" class="form-control" value="{{$barang->whatsapp_number}}" disabled/>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserEmail">Alamat</label>
                                        <input type="text" id="modalEditUserEmail" name="alamat" class="form-control" value="{{$barang->alamat}}" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserEmail">Kota</label>
                                        <input type="text" id="modalEditUserEmail" name="kota" class="form-control" value="{{$barang->kota}}" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserEmail">Tanggal Lahir</label>
                                        <input type="date" id="modalEditUserEmail" name="tanggal_lahir" class="form-control" value="{{$barang->tanggal_lahir}}" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserPhone">Shio</label>
                                        <select class="select2 form-select" id="select2-basic" name="shio_id">
                                            <option>-- Pilih Shio --</option>
{{--                                            @foreach($shios as $shio)--}}
{{--                                                @if($shio->id == $barang->shio_id)--}}
{{--                                                    <option value="{{ $shio->id }}" selected>{{ $shio->name }}</option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{ $shio->id }}">{{ $shio->name }}</option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
                                        </select>
                                    </div>

                                    <div class="col-12 text-center mt-2 pt-50">
                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                            Discard
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

@endsection
