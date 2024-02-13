@extends('admin.layout.app')


@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">                        
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">MACJ</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm bg-blue rounded">
                                    <i class="fe-users avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">
                                        <span data-plugin="counterup">12,145</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Active Users</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->

                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm bg-blue rounded">
                                    <i class="fe-users avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">
                                        <span data-plugin="counterup">12,145</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Branch Office</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->

                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm bg-blue rounded">
                                    <i class="fe-users avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">
                                        <span data-plugin="counterup">12,145</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Telecallers</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->

                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm bg-blue rounded">
                                    <i class="fe-help-circle avatar-title font-22 text-white text-center p-1"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">
                                        <span data-plugin="counterup">12,145</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Enqueries</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">                        
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widgets">
                                <a href="javascript:void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#notification" role="button" aria-expanded="false" aria-controls="notification"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript:void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0">Enquiry Summary</h4>

                            <div id="notification" class="collapse pt-3 show">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Time Period</th>
                                                <th colspan="4">Enquery Count</th>
                                            </tr>
                                            <tr>
                                                <th>In Queue</th>
                                                <th>Completed</th>
                                                <th>Rejected</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>April, 2022</td>
                                                <td>0</td>
                                                <td>750</td>
                                                <td>14</td>
                                                <td>764</td>
                                            </tr>
                                            <tr>
                                                <td>March, 2022</td>
                                                <td>0</td>
                                                <td>800</td>
                                                <td>72</td>
                                                <td>872</td>
                                            </tr>
                                            <tr>
                                                <td>February, 2022</td>
                                                <td>8</td>
                                                <td>300</td>
                                                <td>22</td>
                                                <td>330</td>
                                            </tr>
                                            <tr>
                                                <td>January, 2022</td>
                                                <td>0</td>
                                                <td>500</td>
                                                <td>45</td>
                                                <td>545</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table responsive-->
                            </div> <!-- collapsed end -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <script>document.write(new Date().getFullYear())</script> &copy; MACJ 
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>
@stop
