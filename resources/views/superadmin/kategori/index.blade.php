@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">

@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')

    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#workerskills').DataTable();
        });
    </script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <script>
        var confirmText = $('#confirm-text');
        function deleteSkill ($id){
            Swal.fire({
                title: 'Delete Kategori?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus Kateogri',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-outline-success ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.post('/superadmin/kategori/delete/'+$id,
                        {
                            '_token': '{{ csrf_token() }}',
                            task: 'comment_insert',
                        });
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    }).then(function (result){
                        location.reload();
                    });
                }
            });
        }
    </script>
    <script>
        function set_data(id, name, deskripsi, salary){
            document.getElementById("idskill").value = id;
            document.getElementById("nameskill").value = name;
            document.getElementById("deskripsiskill").value = deskripsi;
            document.getElementById("salaryskill").value = salary;
        }
    </script>
@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar User</h4>
                </div>
                <table class="user-list-table table" id="workerskills">
                    <thead class="table-light">
                    <tr>
                        <th>...</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Code</th>
                        <th>status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kategoris as $kategori)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a type="button" class="dropdown-item text-danger" onclick="deleteSkill('{{$kategori->id}}')">Delete Kategori</a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-info">{{ $kategori->name }}</td>
                            <td>{{ $kategori->description }}</td>
                            <td>{{$kategori->code}}</td>
                            <td>
                                <span class="badge bg-light-success">Aktif</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add User</h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal" method="post" action="/superadmin/kategori/store">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="fname-icon">Nama</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                            <input type="text" id="credit-card" class="form-control" name="name"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="email-icon">Deskripsi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="mail"></i></span>
                                            <input type="text" id="file-text" class="form-control" name="description" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="contact-icon">Code</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="percent"></i></span>
                                            <input type="text" id="contact-icon" class="form-control" name="code" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-start" id="editworkerskill" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Worker Skill</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal" method="post" action="/superadmin/workerskills/update">@csrf
                        <input type="hidden" name="id" id="idskill">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="fname-icon">Skill</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                            <input type="text" id="nameskill" class="form-control" name="name"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="email-icon">Deskripsi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="mail"></i></span>
                                            <input type="text" id="deskripsiskill" class="form-control" name="description" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="contact-icon">Gaji</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="percent"></i></span>
                                            <input type="number" id="salaryskill" class="form-control" name="salary" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-warning me-1">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
