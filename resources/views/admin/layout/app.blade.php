<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}"> -->

        <!-- plugin css -->
        <!-- <link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{asset('assets/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{asset('assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
        <link href="{{asset('assets/css/custom-style.css')}}" rel="stylesheet" type="text/css" />

        <!-- icons -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
        <script src="https://cdn.ckeditor.com/ckeditor5/44.0.4/classic/ckeditor.js"></script>

    </head>

    <body class="loading">
    @if(session('success'))
    <div class="alert alert-success " id="success-alert">
        {{ session('success') }}
    </div>

    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $("#success-alert").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 30);
        });
    </script>
@endif


        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="javascript:void(0)" style="color:black;">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
            
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="color:black;">
                                <i class="fe-bell noti-icon"></i>
                                <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
    
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-right">
                                            <a href="" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
    
                                <div class="noti-scroll" data-simplebar>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Cristina Pride</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">1 min ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Karen Robinson</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Wow ! this admin looks good and awesome design</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <p class="notify-details">New user registered.
                                            <small class="text-muted">5 hours ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">4 days ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                </div>
    
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fe-arrow-right"></i>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1" style="color:black;">
                                    Geneva <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <a href="change-password" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>Change Password</span>
                                </a>
            
                                <!-- item-->
                                <a href="logout" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>    
                            </div>
                        </li>    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index" class="logo logo-dark text-center">
                            <span class="logo-sm">
                            <img src="https://works.webwonderz.in/captains_deck/images/logo.png" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                            <img src="https://works.webwonderz.in/captains_deck/images/logo.png" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>
    
                        <a href="index" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="https://works.webwonderz.in/captains_deck/images/logo.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                            <img src="https://works.webwonderz.in/captains_deck/images/logo.png" alt="" height="22">
                                <span>Captains Deck Admin</span>
                            </span>
                        </a>
                    </div>
    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light" style="color:black;">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
                <div class="h-100" data-simplebar>
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul id="side-menu">
                            <li class="menu-title">Navigation</li>
                            <li>
                                <a href="dashboard">
                                    <i data-feather="airplay"></i>
                                    <span> Dashboards </span>
                                </a>
                            </li>

                            <li class="menu-title mt-2">Management</li>

                            <!-- <li>
                                <a href="list-users">
                                    <i data-feather="users"></i>
                                    <span> Users </span>
                                </a>
                            </li> -->
                            <li>
                                <a href="#sidebarBranchOffice" data-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Manage Employee </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarBranchOffice">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="employees"> Employee </a>
                                        </li>
                                        <li>
                                            <a href="employee-positions"> Employee Positions </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>                            
                            <li>
                                <a href="#sidebarTeleCallers" data-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> Forms </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTeleCallers">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="get-in-touch"> Get in touch </a>
                                        </li>
                                        <li>
                                            <a href="careerss"> Apply for a position </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#menus" data-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> Menu </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="menus">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="menus">Meal Menus </a>
                                        </li>
                                        <li>
                                            <a href="meal-categories"> Meal Categories </a>
                                        </li>
                                        <li>
                                            <a href="meal-subcategories"> Meal SubCategories </a>
                                        </li>
                                        <li>
                                            <a href="meal-subsubcategories"> Meal SubSubCategories </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- <li class="menu-title mt-2">CMS Management</li> -->

                           

                            <li class="menu-title mt-2"> Content Management </li>
                            <li>
                                <a href="#sidebarOrders" data-toggle="collapse">
                                    <i data-feather="truck"></i>
                                    <span> CMS Management </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarOrders">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="about"> About Us </a>
                                        </li>
                                        <li>
                                            <a href="Careers"> Careers </a>
                                        </li>
                                        <li>
                                            <a href="Location"> LOCATION </a>
                                        </li>
                                        <li>
                                            <a href="Privacy-Policy"> Privacy Policy </a>
                                        </li>
                                        <li>
                                            <a href="contactInfo"> Contact Info </a>
                                        </li>
                                        <li>
                                            <a href="Disclaimer"> Disclaimer </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="banner">
                                    <i data-feather="image"></i>
                                    <span> Banner Management </span>
                                </a>
                            </li>
                            <li>
                                <a href="whats-news">
                                    <i data-feather="settings"></i>
                                    <span> whats-news </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="available-offers">
                                    <i data-feather="settings"></i>
                                    <span> available-offers </span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="terms-and-conditions">
                                    <i data-feather="file-text"></i>
                                    <span>   </span>
                                </a>
                            </li>
                            <li>
                                <a href="terms-and-conditions">
                                    <i data-feather="file-text"></i>
                                    <span>   </span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="terms-and-conditions">
                                    <i data-feather="file-text"></i>
                                    <span>   </span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="list-notification">
                                    <i data-feather="send"></i>
                                    <span> Manage Notification </span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="list-category">
                                    <i data-feather="layers"></i>
                                    <span> Category Management </span>
                                </a>
                            </li> -->
                            <li>
                                <a href="events">
                                    <i data-feather="list"></i>
                                    <span> Events </span>
                                </a>
                            </li>
                            <li>
                            <a href="gallerys">
                                <i data-feather="cast"></i>
                                <span> Gallery </span>
                            </a>

                            </li>
                            <li>
                                <a href="blog">
                                    <i data-feather="pen-tool"></i>
                                    <span> Blogs </span>
                                </a>
                            </li>
                        </ul>
                    </div> <!-- End Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            @yield('content')

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        
        <div id="upload-blog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Upload Blog</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" value='' class="form-control" name="title" required placeholder="Blog Title">
                            </div>
                            <div class="form-group">
                                <label>Header <span class="text-danger">*</span></label>
                                <input type="text" value='' class="form-control" name="header" required placeholder="Blog header">
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="editor" class="form-control" required placeholder="Write your complete description here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Picture <span class="text-danger">(Browse picture if you want to change the image. Otherwise, Ignore it.)</span></label>
                                <input type="file" value="" class="form-control" name="media" required accept="image/*">                                
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                &ensp;
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="edit-blog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Edit Blog</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" required placeholder="Blog Title">
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control summernote" required placeholder="Write your complete description here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Picture <span class="text-danger">(Browse picture if you want to change the image. Otherwise, Ignore it.)</span></label>
                                <input type="file" class="form-control" name="blog_image" required accept="image/*">                                
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                &ensp;
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="upload-picture" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('admin.gallerys.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Upload Picture</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Picture <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="media[]" required accept="image/*">
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                &ensp;
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="upload-video" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('admin.gallerys.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Upload Video</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Video <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="media[]" required accept="Video/*">
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                &ensp;
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="uploadYoutubeLink" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('admin.gallerys.youtubeLinkStore') }}" enctype="multipart/form-data">
                     @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Upload Video</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Video Link <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="video_link" required placeholder="Only YouTube Link Allowed">
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                &ensp;
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
       

        <!-- Vendor js -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>

        <!-- Plugins js-->
        <!-- <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script> -->
        <!-- <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script> -->

        <!-- Dashboard 2 init -->
        <script src="{{asset('assets/js/pages/dashboard-2.init.js')}}"></script>

        <!-- Third Party js-->
        <!-- <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
        <script src="https://apexcharts.com/samples/assets/ohlc.js"></script> -->

        <!-- init js -->
        <!-- <script src="assets/js/pages/apexcharts.init.js"></script> -->

        <!-- App js-->
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        <script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

        
    </body>
</html>