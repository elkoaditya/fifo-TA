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
                        <div class="modal modal-sticky" id="compose-mail" data-bs-keyboard="false">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content p-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Compose Mail</h5>
                                        <div class="modal-actions">
                                            <a href="#" class="text-body me-75"><i data-feather="minus"></i></a>
                                            <a href="#" class="text-body me-75 compose-maximize"><i data-feather="maximize-2"></i></a>
                                            <a class="text-body" href="#" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></a>
                                        </div>
                                    </div>
                                    <div class="modal-body flex-grow-1 p-0">
                                        <form class="compose-form">
                                            <div class="compose-mail-form-field select2-primary">
                                                <label for="email-to" class="form-label">To: </label>
                                                <div class="flex-grow-1">
                                                    <select class="select2 form-select w-100" id="email-to" multiple>
                                                        <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                        <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                        <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                        <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <a class="toggle-cc text-body me-1" href="#">Cc</a>
                                                    <a class="toggle-bcc text-body" href="#">Bcc</a>
                                                </div>
                                            </div>
                                            <div class="compose-mail-form-field cc-wrapper">
                                                <label for="emailCC" class="form-label">Cc: </label>
                                                <div class="flex-grow-1">
                                                    <!-- <input type="text" id="emailCC" class="form-control" placeholder="CC"/> -->
                                                    <select class="select2 form-select w-100" id="emailCC" multiple>
                                                        <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                        <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                        <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                        <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                                    </select>
                                                </div>
                                                <a class="text-body toggle-cc" href="#"><i data-feather="x"></i></a>
                                            </div>
                                            <div class="compose-mail-form-field bcc-wrapper">
                                                <label for="emailBCC" class="form-label">Bcc: </label>
                                                <div class="flex-grow-1">
                                                    <!-- <input type="text" id="emailBCC" class="form-control" placeholder="BCC"/> -->
                                                    <select class="select2 form-select w-100" id="emailBCC" multiple>
                                                        <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                        <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                        <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                        <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                                    </select>
                                                </div>
                                                <a class="text-body toggle-bcc" href="#"><i data-feather="x"></i></a>
                                            </div>
                                            <div class="compose-mail-form-field">
                                                <label for="emailSubject" class="form-label">Subject: </label>
                                                <input type="text" id="emailSubject" class="form-control" placeholder="Subject" name="emailSubject" />
                                            </div>
                                            <div id="message-editor">
                                                <div class="editor" data-placeholder="Type message..."></div>
                                                <div class="compose-editor-toolbar">
                                                    <span class="ql-formats me-0">
                                                        <select class="ql-font">
                                                            <option selected>Sailec Light</option>
                                                            <option value="sofia">Sofia Pro</option>
                                                            <option value="slabo">Slabo 27px</option>
                                                            <option value="roboto">Roboto Slab</option>
                                                            <option value="inconsolata">Inconsolata</option>
                                                            <option value="ubuntu">Ubuntu Mono</option>
                                                        </select>
                                                    </span>
                                                    <span class="ql-formats me-0">
                                                        <button class="ql-bold"></button>
                                                        <button class="ql-italic"></button>
                                                        <button class="ql-underline"></button>
                                                        <button class="ql-link"></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="compose-footer-wrapper">
                                                <div class="btn-wrapper d-flex align-items-center">
                                                    <div class="btn-group dropup me-1">
                                                        <button type="button" class="btn btn-primary">Send</button>
                                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <span class="visually-hidden">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#"> Schedule Send</a>
                                                        </div>
                                                    </div>
                                                    <!-- add attachment -->
                                                    <div class="email-attachement">
                                                        <label for="file-input" class="form-label">
                                                            <i data-feather="paperclip" width="17" height="17" class="ms-50"></i>
                                                        </label>

                                                        <input id="file-input" type="file" class="d-none" />
                                                    </div>
                                                </div>
                                                <div class="footer-action d-flex align-items-center">
                                                    <div class="dropup d-inline-block">
                                                        <i class="font-medium-2 cursor-pointer me-50" data-feather="more-vertical" role="button" id="composeActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        </i>
                                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="composeActions">
                                                            <a class="dropdown-item" href="#">
                                                                <span class="align-middle">Add Label</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <span class="align-middle">Plain text mode</span>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">
                                                                <span class="align-middle">Print</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <span class="align-middle">Check Spelling</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <i data-feather="trash" class="font-medium-2 cursor-pointer" data-bs-dismiss="modal"></i>
                                                </div>
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
