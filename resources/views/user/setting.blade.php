@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')

@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')

@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills mb-2">
                <!-- account -->
                <li class="nav-item">
                    <a class="nav-link active" href="page-account-settings-account.html">
                        <i data-feather="user" class="font-medium-3 me-50"></i>
                        <span class="fw-bold">Account</span>
                    </a>
                </li>
                <!-- security -->
                <li class="nav-item">
                    <a class="nav-link" href="/user/security">
                        <i data-feather="lock" class="font-medium-3 me-50"></i>
                        <span class="fw-bold">Security</span>
                    </a>
                </li>
            </ul>

            <!-- profile -->
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Profile Details</h4>
                </div>
                <div class="card-body py-2 my-25">
                    <!-- header section -->
                    <div class="d-flex">
                        <a href="#" class="me-25">
                            <img src="{{$user->profile}}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                        </a>
                        <!-- upload and reset button -->
                        <div class="d-flex align-items-end mt-75 ms-1">
                            <div>
                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                <input type="file" id="account-upload" hidden accept="image/*" />
                                <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                            </div>
                        </div>
                        <!--/ upload and reset button -->
                    </div>
                    <!--/ header section -->

                    <!-- form -->
                    <form class="validate-form mt-2 pt-50" method="post" action="/user/setting/save">@csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="accountFirstName">Username</label>
                                <input type="text" class="form-control" id="accountFirstName" name="username" placeholder="John Budi" value="{{$user->username}}" data-msg="Please enter first name" />
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="accountFirstName">Role</label>
                                <input type="text" class="form-control" id="accountFirstName" name="#" placeholder="John Budi" disabled value="{{$user->username}}" data-msg="Please enter first name" />
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="accountFirstName">Full Name</label>
                                <input type="text" class="form-control" id="accountFirstName" name="name" placeholder="John Budi" value="{{$user->name}}" data-msg="Please enter first name" />
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="accountEmail">Email</label>
                                <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="{{$user->detail->email}}" />
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="accountOrganization">Nomor Whatsapp</label>
                                <input type="text" class="form-control" id="accountOrganization" name="nowa" placeholder="Nomor whatsapp" value="{{$user->detail->nowa}}" />
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="accountPhoneNumber">Alamat Rumah</label>
                                <input type="text" class="form-control account-number-mask" id="accountPhoneNumber" name="alamat" placeholder="Alamat" value="{{$user->detail->alamat}}" />
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="accountAddress">About Me</label>
                                <input type="text" class="form-control" id="accountAddress" name="about" placeholder="Your Address" value="{{$user->detail->about}}"/>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary mt-1" onclick="location.href='/redirect/home'">Back Home</button>
                            </div>
                        </div>
                    </form>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
@endsection
