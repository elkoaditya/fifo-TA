@extends('assets/body')
{{------------------------------------------- CSS ---------------------------------------}}
@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/editors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/editors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/forms/select/select2.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/form-quill-editor.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/pages/app-email.css">

@endsection

{{------------------------------------------- JS ---------------------------------------}}
@section('js')

    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/editors/quill/katex.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/pages/app-email.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

@endsection
{{------------------------------------------- Content ---------------------------------------}}
@section('content')

    <div class="email-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content email-app-sidebar">
                        <div class="email-app-menu">
                            <div class="form-group-compose text-center compose-btn">
                                <button type="button" class="compose-email btn btn-primary w-100" data-bs-backdrop="false" data-bs-toggle="modal" data-bs-target="#compose-mail">
                                    Compose
                                </button>
                            </div>

                            <div class="sidebar-menu-list">
                                <h6 class="section-label mb-1 px-2">Filter</h6>
                                <div class="list-group list-group-messages">
                                    @isset(\Illuminate\Support\Facades\Request::query()['filter'])
                                        <a href="?filter=pending" class="list-group-item list-group-item-action {{\Illuminate\Support\Facades\Request::query()['filter'] == 'pending' ? 'active' : ''}}">
                                            <i data-feather="alert-triangle" class="font-medium-3 me-50"></i>
                                            <span class="align-middle">Pending</span>
                                            <span class="badge badge-light-warning rounded-pill float-end">3</span>
                                        </a>
                                        <a href="?filter=aproved" class="list-group-item list-group-item-action {{\Illuminate\Support\Facades\Request::query()['filter'] == 'aproved' ? 'active' : ''}}">
                                            <i data-feather="check" class="font-medium-3 me-50"></i>
                                            <span class="align-middle">Aproved</span>
                                            <span class="badge badge-light-success rounded-pill float-end">3</span>
                                        </a>
                                        <a href="?filter=deleted" class="list-group-item list-group-item-action {{\Illuminate\Support\Facades\Request::query()['filter'] == 'deleted' ? 'active' : ''}}">
                                            <i data-feather="trash-2" class="font-medium-3 me-50"></i>
                                            <span class="align-middle">Deleted</span>
                                            <span class="badge badge-light-danger rounded-pill float-end">3</span>
                                        </a>
                                    @else
                                        <a href="?filter=pending" class="list-group-item list-group-item-action active">
                                            <i data-feather="alert-triangle" class="font-medium-3 me-50"></i>
                                            <span class="align-middle">Pending</span>
                                            <span class="badge badge-light-warning rounded-pill float-end">3</span>
                                        </a>
                                        <a href="?filter=aproved" class="list-group-item list-group-item-action">
                                            <i data-feather="check" class="font-medium-3 me-50"></i>
                                            <span class="align-middle">Aproved</span>
                                            <span class="badge badge-light-success rounded-pill float-end">3</span>
                                        </a>
                                        <a href="?filter=deleted" class="list-group-item list-group-item-action">
                                            <i data-feather="trash-2" class="font-medium-3 me-50"></i>
                                            <span class="align-middle">Deleted</span>
                                            <span class="badge badge-light-danger rounded-pill float-end">3</span>
                                        </a>
                                    @endisset
                                </div>
                                <!-- <hr /> -->
                                <h6 class="section-label mt-3 mb-1 px-2">Labels</h6>
                                <div class="list-group list-group-labels">
                                    <a href="#" class="list-group-item list-group-item-action"><span class="bullet bullet-sm bullet-success me-1"></span>Aproved</a>
                                    <a href="#" class="list-group-item list-group-item-action"><span class="bullet bullet-sm bullet-warning me-1"></span>Pending</a>
                                    <a href="#" class="list-group-item list-group-item-action"><span class="bullet bullet-sm bullet-danger me-1"></span>Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <!-- Email list Area -->
                        <div class="email-app-list">
                            <!-- Email search starts -->
                            <div class="app-fixed-search d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none ms-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="d-flex align-content-center justify-content-between w-100">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                        <input type="text" class="form-control" id="email-search" placeholder="Search email" aria-label="Search..." aria-describedby="email-search" />
                                    </div>
                                </div>
                            </div>
                            <div class="email-user-list">
                                <ul class="email-media-list">
                                    <li class="d-flex user-mail mail-read">
                                        <div class="mail-left pe-50">
                                            <div class="avatar">
                                                <img src="{{ asset('vuexy') }}/app-assets/images/box.png" alt="avatar img holder" />
                                            </div>
                                            <div class="user-action">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck1" />
                                                    <label class="form-check-label" for="customCheck1"></label>
                                                </div>
                                                <span class="email-favorite"><i data-feather="star"></i></span>
                                            </div>
                                        </div>
                                        <div class="mail-body">
                                            <div class="mail-details">
                                                <div class="mail-items">
                                                    <h5 class="mb-25">Tonny Deep</h5>
                                                    <span class="text-truncate">🎯 Focused impactful open system </span>
                                                </div>
                                                <div class="mail-meta-item">
                                                    <span class="me-50 bullet bullet-success bullet-sm"></span>
                                                    <span class="mail-date">4:14 AM</span>
                                                </div>
                                            </div>
                                            <div class="mail-message">
                                                <p class="text-truncate mb-0">
                                                    Hey John, bah kivu decrete epanorthotic unnotched Argyroneta nonius veratrine preimaginary saunders
                                                    demidolmen Chaldaic allusiveness lorriker unworshipping ribaldish tableman hendiadys outwrest unendeavored
                                                    fulfillment scientifical Pianokoto CheloniaFreudian sperate unchary hyperneurotic phlogiston duodecahedron
                                                    unflown Paguridea catena disrelishable Stygian paleopsychology cantoris phosphoritic disconcord fruited
                                                    inblow somewhatly ilioperoneal forrard palfrey Satyrinae outfreeman melebiose
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="no-results">
                                    <h5>No Items Found</h5>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="compose-mail" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-transparent">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-sm-5 mx-50 pb-5">
                                        <h1 class="text-center mb-1" id="addNewCardTitle">Add New Card</h1>
                                        <p class="text-center">Add card for future billing</p>

                                        <!-- form -->
                                        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                                            <div class="col-12">
                                                <label class="form-label" for="modalAddCardNumber">Card Number</label>
                                                <div class="input-group input-group-merge">
                                                    <input id="modalAddCardNumber" name="modalAddCard" class="form-control add-credit-card-mask" type="text" placeholder="1356 3215 6548 7898" aria-describedby="modalAddCard2" data-msg="Please enter your credit card number" />
                                                    <span class="input-group-text cursor-pointer p-25" id="modalAddCard2">
                                                <span class="add-card-type"></span>
                                            </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="modalAddCardName">Name On Card</label>
                                                <input type="text" id="modalAddCardName" class="form-control" placeholder="John Doe" />
                                            </div>

                                            <div class="col-6 col-md-3">
                                                <label class="form-label" for="modalAddCardExpiryDate">Exp. Date</label>
                                                <input type="text" id="modalAddCardExpiryDate" class="form-control add-expiry-date-mask" placeholder="MM/YY" />
                                            </div>

                                            <div class="col-6 col-md-3">
                                                <label class="form-label" for="modalAddCardCvv">CVV</label>
                                                <input type="text" id="modalAddCardCvv" class="form-control add-cvv-code-mask" maxlength="3" placeholder="654" />
                                            </div>

                                            <div class="col-12">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-switch form-check-primary me-25">
                                                        <input type="checkbox" class="form-check-input" id="saveCard" checked />
                                                        <label class="form-check-label" for="saveCard">
                                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                        </label>
                                                    </div>
                                                    <label class="form-check-label fw-bolder" for="saveCard">Save Card for future billing?</label>
                                                </div>
                                            </div>

                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
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
    </div>

@endsection
