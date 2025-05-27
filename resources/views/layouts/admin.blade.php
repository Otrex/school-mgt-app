<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        {{ seo()->render() }}
        @if (!is_staging())
        <meta content="Telage Concepts, Technology Education, Tech Ecosystem, Nigeria Tech, Africa Tech, Ed-Tech" name="keywords">
        @endif

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/iziToast/iziToast.min.css') }}" rel="stylesheet">

        {{-- Alpine Js Library --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <!-- Template Main CSS File -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/loading-animation.css') }}" rel="stylesheet">

        @livewireStyles

        <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
}
</style>
    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('index') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                    <span class="d-none d-lg-block">Admin</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>

            <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#">
                            <i class="bi bi-search"></i>
                        </a>
                    </li><!-- End Search Icon-->
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-primary badge-number">4</span>
                        </a><!-- End Notification Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                You have 4 new notifications
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>Lorem Ipsum</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>30 min. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-x-circle text-danger"></i>
                                <div>
                                    <h4>Atque rerum nesciunt</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>1 hr. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <div>
                                    <h4>Sit rerum fuga</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>2 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <h4>Dicta reprehenderit</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </li>

                        </ul><!-- End Notification Dropdown Items -->
                    </li><!-- End Notification Nav -->

                    <li class="nav-item dropdown">

                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-chat-left-text"></i>
                            <span class="badge bg-success badge-number">3</span>
                        </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="{{ asset('img/messages-1.jpg') }}" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>
                    </ul><!-- End Messages Dropdown Items -->

                    </li><!-- End Messages Nav -->
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <div class="user-word-avatar-nav">
                                {{ auth('admin')->user()->first_name[0]."".auth('admin')->user()->last_name[0] }}
                            </div>
                            <span class="d-none d-md-block dropdown-toggle ps-2">
                                {{ strtoupper(auth('admin')->user()->first_name[0]) }}. {{ ucwords(auth('admin')->user()->last_name) }}
                            </span>
                        </a><!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ ucwords(auth('admin')->user()->fullname) }}</h6>
                            <span>Level {{ auth('admin')->user()->level }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.setting') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            @livewire('auth.admin-logout')
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->
        </header><!-- End Header -->
        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                @if (is_superAdmin() || is_admin())
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-heading">School Membership</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-people"></i>
                        <span>Students</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.student.add') }}">
                            <i class="bi bi-circle"></i><span>Add Student</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.students') }}">
                            <i class="bi bi-circle"></i><span>All Student</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-heading">Community Management</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#communities" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-globe-asia-australia"></i>
                        <span>Members</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="communities" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.communities.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Member</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.communities') }}">
                            <i class="bi bi-circle"></i><span>All Member</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.communities.patrons') }}">
                            <i class="bi bi-circle"></i><span> Patrons </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#community-center" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-buildings"></i>
                        <span>Centers</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="community-center" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.community-center.add') }}">
                            <i class="bi bi-circle"></i><span>Add Community Center</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.community-center') }}">
                            <i class="bi bi-circle"></i><span>All Community Center</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.community-center.maintenance') }}">
                            <i class="bi bi-circle"></i><span>Maintenance</span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#community-resource" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-nut"></i>
                        <span>Resources</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="community-resource" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.community-resource.add') }}">
                            <i class="bi bi-circle"></i><span>Add Resource/Asset</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.community-resource') }}">
                            <i class="bi bi-circle"></i><span>All Resources/Assets</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}





                <li class="nav-heading">Program Management</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-book"></i>
                        <span>Programs</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.course.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Program</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.courses') }}">
                            <i class="bi bi-circle"></i><span>All Programs</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#course-category" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <span>Program Category</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="course-category" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.course.category.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.course.categories') }}">
                            <i class="bi bi-circle"></i><span>All Program Category</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#exam-mgmt" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-file-earmark-medical"></i>
                        <span>Exam Management</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="exam-mgmt" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.exam.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Exam</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.exams') }}">
                            <i class="bi bi-circle"></i><span>All Exams</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#result-mgmt" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-receipt"></i>
                        <span>Result Management</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="result-mgmt" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.result.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Result</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.results') }}">
                            <i class="bi bi-circle"></i><span>All Result</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-heading">Content Management</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-newspaper"></i>
                        <span>Blog</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.blog.add') }}">
                            <i class="bi bi-circle"></i><span>Add Blog</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.blogs') }}">
                            <i class="bi bi-circle"></i><span>All Blog</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (is_superAdmin() || is_admin())
                <li class="nav-heading">Educational Institution</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#schools" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-buildings"></i>
                        <span>Schools</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="schools" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.school.add') }}">
                            <i class="bi bi-circle"></i><span>Add New School</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.schools') }}">
                            <i class="bi bi-circle"></i><span>All Schools</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#tertiary_institution" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-buildings"></i>
                        <span>Tertiary Institution</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tertiary_institution" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.tertiary.institution.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Tertiary Institution</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tertiary.institutions') }}">
                            <i class="bi bi-circle"></i><span>All Tertiary Institution</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-heading">Location Management</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#state" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-globe-americas"></i>
                        <span>State</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="state" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.states.add') }}">
                            <i class="bi bi-circle"></i><span>Add New State</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.states') }}">
                            <i class="bi bi-circle"></i><span>All State</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#local_government" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-globe-asia-australia"></i>
                        <span>Local Government</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="local_government" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.local.government.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Local Government</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.local.governments') }}">
                            <i class="bi bi-circle"></i><span>All Local Government</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#town" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-globe"></i>
                        <span>Town</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="town" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.town.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Town</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.towns') }}">
                            <i class="bi bi-circle"></i><span>All Town</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-heading">Others</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-bar-chart"></i>
                        <span>School Session</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.session.add') }}">
                            <i class="bi bi-circle"></i><span>Add New Session</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sessions') }}">
                            <i class="bi bi-circle"></i><span>All Session</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (is_superAdmin())
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#voucher" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-credit-card-2-front"></i>
                        <span>Voucher</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="voucher" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.voucher.add') }}">
                            <i class="bi bi-circle"></i><span>Generate New Voucher</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.vouchers') }}">
                            <i class="bi bi-circle"></i><span>All Voucher</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#admins" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-person-fill-lock"></i>
                        <span>Admins</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="admins" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.role.add') }}">
                            <i class="bi bi-circle"></i><span>Add Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles') }}">
                            <i class="bi bi-circle"></i><span>All Admin</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#settings" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="settings" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.setting') }}">
                            <i class="bi bi-circle"></i><span>Profile Setting</span>
                            </a>
                        </li>
                        @if (is_superAdmin())
                        <li>
                            <a href="{{ route('admin.resource-type.add') }}">
                            <i class="bi bi-circle"></i><span>Add Resource Type</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.language') }}">
                            <i class="bi bi-circle"></i><span>Language Setting</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.allthelanguages') }}">
                            <i class="bi bi-circle"></i><span>All Language Settings</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </aside>

        @yield('content')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        @livewireScripts

        <!-- Vendor JS Files -->
        <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('vendor/iziToast/iziToast.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('vendor/stackedit/stackedit.min.js') }}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('js/main.js') }}"></script>

        @stack('scripts')
    </body>
</html>
