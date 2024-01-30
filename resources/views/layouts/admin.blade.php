<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Wellican Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('dashboard/compiled/svg/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('dashboard/compiled/png/favi.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/app.css') }}" />
    @stack('css')
</head>

<body>
<div id="app">
    <div id="sidebar">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{ route('admin.home') }}">
                            <img src="{{ asset('dashboard/compiled/png/logo.png') }}" alt="Logo" srcset="" />
                        </a>
                    </div>
                    <div class="theme-toggle d-flex gap-2 align-items-center mt-2"></div>
                    <div class="sidebar-toggler x">
                        <a href="#" class="sidebar-hide d-xl-none d-block">
                            <i class="bi bi-x bi-middle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title sidebar-item active">Меню</li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-folder-fill"></i>
                            <span>Каталог</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="{{ route('admin.objects.index') }}" class="submenu-link">
                                    Объекты
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-stack"></i>
                            <span>Components</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="component-accordion.html" class="submenu-link"
                                >Accordion</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-alert.html" class="submenu-link"
                                >Alert</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-badge.html" class="submenu-link"
                                >Badge</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-breadcrumb.html" class="submenu-link"
                                >Breadcrumb</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-button.html" class="submenu-link"
                                >Button</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-card.html" class="submenu-link">Card</a>
                            </li>

                            <li class="submenu-item">
                                <a href="component-carousel.html" class="submenu-link"
                                >Carousel</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-collapse.html" class="submenu-link"
                                >Collapse</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-dropdown.html" class="submenu-link"
                                >Dropdown</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-list-group.html" class="submenu-link"
                                >List Group</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-modal.html" class="submenu-link"
                                >Modal</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-navs.html" class="submenu-link">Navs</a>
                            </li>

                            <li class="submenu-item">
                                <a href="component-pagination.html" class="submenu-link"
                                >Pagination</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-progress.html" class="submenu-link"
                                >Progress</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-spinner.html" class="submenu-link"
                                >Spinner</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-toasts.html" class="submenu-link"
                                >Toasts</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="component-tooltip.html" class="submenu-link"
                                >Tooltip</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-collection-fill"></i>
                            <span>Extra Components</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="extra-component-avatar.html" class="submenu-link"
                                >Avatar</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="extra-component-divider.html" class="submenu-link"
                                >Divider</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a
                                    href="extra-component-date-picker.html"
                                    class="submenu-link"
                                >Date Picker</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a
                                    href="extra-component-sweetalert.html"
                                    class="submenu-link"
                                >Sweet Alert</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="extra-component-toastify.html" class="submenu-link"
                                >Toastify</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="extra-component-rating.html" class="submenu-link"
                                >Rating</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Layouts</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="layout-default.html" class="submenu-link"
                                >Default Layout</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="layout-vertical-1-column.html" class="submenu-link"
                                >1 Column</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="layout-vertical-navbar.html" class="submenu-link"
                                >Vertical Navbar</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="layout-rtl.html" class="submenu-link"
                                >RTL Layout</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="layout-horizontal.html" class="submenu-link"
                                >Horizontal Menu</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-title">Forms &amp; Tables</li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Form Elements</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="form-element-input.html" class="submenu-link"
                                >Input</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-element-input-group.html" class="submenu-link"
                                >Input Group</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-element-select.html" class="submenu-link"
                                >Select</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-element-radio.html" class="submenu-link"
                                >Radio</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-element-checkbox.html" class="submenu-link"
                                >Checkbox</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-element-textarea.html" class="submenu-link"
                                >Textarea</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="form-layout.html" class="sidebar-link">
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Form Layout</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-journal-check"></i>
                            <span>Form Validation</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="form-validation-parsley.html" class="submenu-link"
                                >Parsley</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-pen-fill"></i>
                            <span>Form Editor</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="form-editor-quill.html" class="submenu-link"
                                >Quill</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-editor-ckeditor.html" class="submenu-link"
                                >CKEditor</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-editor-summernote.html" class="submenu-link"
                                >Summernote</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="form-editor-tinymce.html" class="submenu-link"
                                >TinyMCE</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="table.html" class="sidebar-link">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Table</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>Datatables</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="table-datatable.html" class="submenu-link"
                                >Datatable</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="table-datatable-jquery.html" class="submenu-link"
                                >Datatable (jQuery)</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-title">Extra UI</li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-pentagon-fill"></i>
                            <span>Widgets</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="ui-widgets-chatbox.html" class="submenu-link"
                                >Chatbox</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="ui-widgets-pricing.html" class="submenu-link"
                                >Pricing</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="ui-widgets-todolist.html" class="submenu-link"
                                >To-do List</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-egg-fill"></i>
                            <span>Icons</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="ui-icons-bootstrap-icons.html" class="submenu-link"
                                >Bootstrap Icons
                                </a>
                            </li>

                            <li class="submenu-item">
                                <a href="ui-icons-fontawesome.html" class="submenu-link"
                                >Fontawesome</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="ui-icons-dripicons.html" class="submenu-link"
                                >Dripicons</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Charts</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="ui-chart-chartjs.html" class="submenu-link"
                                >ChartJS</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="ui-chart-apexcharts.html" class="submenu-link"
                                >Apexcharts</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="ui-file-uploader.html" class="sidebar-link">
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                            <span>File Uploader</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-map-fill"></i>
                            <span>Maps</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="ui-map-google-map.html" class="submenu-link"
                                >Google Map</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="ui-map-jsvectormap.html" class="submenu-link"
                                >JS Vector Map</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-three-dots"></i>
                            <span>Multi-level Menu</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item has-sub">
                                <a href="#" class="submenu-link">First Level</a>

                                <ul class="submenu submenu-level-2">
                                    <li class="submenu-item">
                                        <a href="ui-multi-level-menu.html" class="submenu-link"
                                        >Second Level</a
                                        >
                                    </li>

                                    <li class="submenu-item">
                                        <a href="#" class="submenu-link">Second Level Menu</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="submenu-item has-sub">
                                <a href="#" class="submenu-link">Another Menu</a>

                                <ul class="submenu submenu-level-2">
                                    <li class="submenu-item">
                                        <a href="#" class="submenu-link">Second Level Menu</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-title">Pages</li>

                    <li class="sidebar-item">
                        <a href="application-email.html" class="sidebar-link">
                            <i class="bi bi-envelope-fill"></i>
                            <span>Email Application</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="application-chat.html" class="sidebar-link">
                            <i class="bi bi-chat-dots-fill"></i>
                            <span>Chat Application</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="application-gallery.html" class="sidebar-link">
                            <i class="bi bi-image-fill"></i>
                            <span>Photo Gallery</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="application-checkout.html" class="sidebar-link">
                            <i class="bi bi-basket-fill"></i>
                            <span>Checkout Page</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Authentication</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="auth-login.html" class="submenu-link">Login</a>
                            </li>

                            <li class="submenu-item">
                                <a href="auth-register.html" class="submenu-link"
                                >Register</a
                                >
                            </li>

                            <li class="submenu-item">
                                <a href="auth-forgot-password.html" class="submenu-link"
                                >Forgot Password</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-x-octagon-fill"></i>
                            <span>Errors</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="error-403.html" class="submenu-link">403</a>
                            </li>

                            <li class="submenu-item">
                                <a href="error-404.html" class="submenu-link">404</a>
                            </li>

                            <li class="submenu-item">
                                <a href="error-500.html" class="submenu-link">500</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-title">Raise Support</li>

                    <li class="sidebar-item">
                        <a
                            href="https://zuramai.github.io/mazer/docs"
                            class="sidebar-link"
                        >
                            <i class="bi bi-life-preserver"></i>
                            <span>Documentation</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a
                            href="https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md"
                            class="sidebar-link"
                        >
                            <i class="bi bi-puzzle"></i>
                            <span>Contribute</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a
                            href="https://github.com/zuramai/mazer#donation"
                            class="sidebar-link"
                        >
                            <i class="bi bi-cash"></i>
                            <span>Donate</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>@yield('pageName')</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.home') }}">Dashboard</a>
                                </li>
                                @yield('breadcrumbs')
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            @yield('content')
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>{{ date('Y') }} &copy; Welliсan</p>
                </div>
                <div class="float-end"></div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ asset('dashboard/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dashboard/compiled/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
