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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Users</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Users List</h4>
                            <p class="text-muted font-13 mb-4"><!-- Table Description --></p>

                            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>E-mail</th>
                                        <th>Enquiry Made</th>
                                        <th>Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Tiger Nixon</td>
                                        <td>9874758596</td>
                                        <td>tiger@gmail.com</td>
                                        <td>148</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>
                                            <a href="view-user.html"><i data-feather="eye"></i></a>
                                            &emsp;
                                            <a href="#reject-modal" data-toggle="modal"><i data-feather="x-circle"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Tiger Nixon</td>
                                        <td>9874758596</td>
                                        <td>tiger@gmail.com</td>
                                        <td>254</td>
                                        <td><span class="badge badge-warning">Temporary Blocked</span></td>
                                        <td>
                                            <a href="view-user.html"><i data-feather="eye"></i></a>
                                            &emsp;
                                            <a href="#reject-modal" data-toggle="modal"><i data-feather="x-circle"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Tiger Nixon</td>
                                        <td>9874758596</td>
                                        <td>tiger@gmail.com</td>
                                        <td>152</td>
                                        <td><span class="badge badge-danger">Rejected</span></td>
                                        <td>
                                            <a href="view-user.html"><i data-feather="eye"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div><!-- end row-->                        
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
