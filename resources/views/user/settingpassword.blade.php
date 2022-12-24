@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')

@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')

@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
{{--        <div class="content-header row">--}}
{{--            <div class="content-header-left col-md-9 col-12 mb-2">--}}
{{--                <div class="row breadcrumbs-top">--}}
{{--                    <div class="col-12">--}}
{{--                        <h2 class="content-header-title float-start mb-0">Security</h2>--}}
{{--                        <div class="breadcrumb-wrapper">--}}
{{--                            <ol class="breadcrumb">--}}
{{--                                <li class="breadcrumb-item"><a href="index.html">Home</a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item"><a href="#">Account Settings</a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item active">Security--}}
{{--                                </li>--}}
{{--                            </ol>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills mb-2">
                        <!-- account -->
                        <li class="nav-item">
                            <a class="nav-link" href="/user/setting">
                                <i data-feather="user" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Account</span>
                            </a>
                        </li>
                        <!-- security -->
                        <li class="nav-item">
                            <a class="nav-link active" href="page-account-settings-security.html">
                                <i data-feather="lock" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Security</span>
                            </a>
                        </li>
                    </ul>

                    <!-- security -->

                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Change Password</h4>
                        </div>
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form class="validate-form" action="/user/setting/savepassword" method="post"> @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="account-old-password">Current password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="account-old-password" name="oldpassword" placeholder="Enter current password" data-msg="Please current password" />
                                            <div class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="account-new-password">New Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" id="account-new-password" name="password" class="form-control" placeholder="Enter new password" />
                                            <div class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="account-retype-new-password" name="password_confirmation" placeholder="Confirm your new password" />
                                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="fw-bolder">Password requirements:</p>
                                        <ul class="ps-1 ms-25">
                                            <li class="mb-50">Minimum 8 characters long - the more, the better</li>
                                            <li class="mb-50">At least one lowercase character</li>
                                            <li>At least one number, symbol, or whitespace character</li>
                                        </ul>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" onclick="location.href='/redirect/home'">Back home</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>

                    <!-- recent device -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Recent devices</h4>
                        </div>
                        <div class="card-body my-2 py-25">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap text-center">
                                    <thead>
                                    <tr>
                                        <th>BROWSER</th>
                                        <th>DEVICE</th>
                                        <th>LOCATION</th>
                                        <th>RECENT ACTIVITY</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($historys as $history)
                                        <tr>
                                            <td>{{$history->browser}}</td>
                                            <td>{{$history->platform}}</td>
                                            <td>{{$history->v_platform}}</td>
                                            <td>{{\Carbon\Carbon::parse($history->created_at)->toDateTimeString()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- / recent device -->

                    <!--/ security -->
                </div>
            </div>
            <!-- two factor auth modal -->
            <div class="modal fade" id="twoFactorAuthModal" tabindex="-1" aria-labelledby="twoFactorAuthTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 mx-50">
                            <h1 class="text-center mb-1" id="twoFactorAuthTitle">Select Authentication Method</h1>
                            <p class="text-center mb-3">
                                you also need to select a method by which the proxy
                                <br />
                                authenticates to the directory serve
                            </p>

                            <div class="custom-options-checkable">
                                <input class="custom-option-item-check" type="radio" name="twoFactorAuthRadio" id="twoFactorAuthApps" value="apps-auth" checked />
                                <label for="twoFactorAuthApps" class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2 mb-2">
                                    <span><i data-feather="settings" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
                                    <span>
                                            <span class="custom-option-item-title h3">Authenticator Apps</span>
                                            <span class="d-block mt-75">
                                                Get codes from an app like Google Authenticator, Microsoft Authenticator, Authy or 1Password.
                                            </span>
                                        </span>
                                </label>

                                <input class="custom-option-item-check" type="radio" name="twoFactorAuthRadio" value="sms-auth" id="twoFactorAuthSms" />
                                <label for="twoFactorAuthSms" class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2">
                                    <span><i data-feather="message-square" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
                                    <span>
                                            <span class="custom-option-item-title h3">SMS</span>
                                            <span class="d-block mt-75">We will send a code via SMS if you need to use your backup login method.</span>
                                        </span>
                                </label>
                            </div>

                            <button id="nextStepAuth" class="btn btn-primary float-end mt-3">
                                <span class="me-50">Continue</span>
                                <i data-feather="chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / two factor auth modal -->

            <!-- add authentication apps modal -->
            <div class="modal fade" id="twoFactorAuthAppsModal" tabindex="-1" aria-labelledby="twoFactorAuthAppsTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth-apps">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 mx-50">
                            <h1 class="text-center mb-2 pb-50" id="twoFactorAuthAppsTitle">Add Authenticator App</h1>

                            <h4>Authenticator Apps</h4>
                            <p>
                                Using an authenticator app like Google Authenticator, Microsoft Authenticator, Authy, or 1Password, scan the
                                QR code. It will generate a 6 digit code for you to enter below.
                            </p>

                            <div class="d-flex justify-content-center my-2 py-50">
                                <img class="img-fluid" src="../../../app-assets/images/icons/qrcode.png" width="122" alt="QR Code" />
                            </div>

                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading">ASDLKNASDA9AHS678dGhASD78AB</h4>
                                <div class="alert-body fw-normal">
                                    If you having trouble using the QR code, select manual entry on your app
                                </div>
                            </div>

                            <form class="row gy-1" onsubmit="return false">
                                <div class="col-12">
                                    <input class="form-control" id="authenticationCode" type="text" placeholder="Enter authentication code" />
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="reset" class="btn btn-outline-secondary mt-2 me-1" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary mt-2">
                                        <span class="me-50">Continue</span>
                                        <i data-feather="chevron-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / add authentication apps modal-->

            <!-- add authentication sms modal-->
            <div class="modal fade" id="twoFactorAuthSmsModal" tabindex="-1" aria-labelledby="twoFactorAuthSmsTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth-sms">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 mx-50">
                            <h1 class="text-center mb-2 pb-50" id="twoFactorAuthSmsTitle">`</h1>
                            <h4>Verify Your Mobile Number for SMS</h4>
                            <p>Enter your mobile phone number with country code and we will send you a verification code.</p>
                            <form class="row gy-1 mt-1" onsubmit="return false">
                                <div class="col-12">
                                    <input class="form-control phone-number-mask" type="text" placeholder="Mobile number with country code" />
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="reset" class="btn btn-outline-secondary mt-1 me-1" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary mt-1">
                                        <span class="me-50">Continue</span>
                                        <i data-feather="chevron-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / add authentication sms modal-->

        </div>
    </div>
@endsection
