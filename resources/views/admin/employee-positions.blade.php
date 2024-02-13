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
                        <h4 class="page-title">Users
                        &emsp;
                                <a href="#upload-data" data-toggle="modal" class="btn btn-dark waves-effect waves-light">Create New</a>
                        </h4>
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
                                        <th>employe_position_type</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ ($data->position) }}</td>
                                            <td>
                                                @if($data->status == 1)
                                                    <a href="">
                                                        <span class="badge badge-success">active</span>
                                                    </a>
                                                @elseif($data->status == 0)
                                                    <a href="">
                                                        <span class="badge badge-warning">Blocked</span>
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                &emsp;
                                                <a href="#reject-modal" data-toggle="modal"><i data-feather="x-circle"></i></a>
                                            </td>
                                        </tr>
                                        <div id="reject-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.employee-positions.destroy', ['employee_position' => $data->id]) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="standard-modalLabel">Remove Media</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>                    
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Are you sure to remove this permanently?</label>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                &ensp;
                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div><!-- end row-->                        
        </div> <!-- container -->
    </div> <!-- content -->

    <div id="upload-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Upload new employe position</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Position Name <span class="text-danger">*</span></label>
                                <input type="text" value='' class="form-control" name="position" required placeholder=" position">

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
