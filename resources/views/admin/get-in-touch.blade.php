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
                        <h4 class="page-title">Get In Touch</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">List</h4>
                            <p class="text-muted font-13 mb-4"><!-- Table Description --></p>

                            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>phone_number</th>
                                        <th>subject</th>
                                        <th>message</th>
                                        <!-- <th>status</th> -->
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ ($data->name) }}</td>
                                            <td>{{ ($data->email) }}</td>
                                            <td>{{ ($data->phone_number) }}</td>
                                            <td>{{ ($data->subject) }}</td>
                                            <td>{{ ($data->message) }}</td>
                                            <!-- <td>
                                                @if($data->status == 1)
                                                    <a href="">
                                                        <span class="badge badge-success">active</span>
                                                    </a>
                                                @elseif($data->status == 0)
                                                    <a href="">
                                                        <span class="badge badge-warning">Blocked</span>
                                                    </a>
                                                @endif
                                            </td> -->

                                            <td>
                                                <!-- <a href="{{ route('admin.employees.index', ['id' => $data->id]) }}"><i data-feather="eye"></i></a> -->
                                                &emsp;
                                                <a href="#reject-modal" data-toggle="modal"><i data-feather="x-circle"></i></a>
                                            </td>
                                        </tr>
                                        <div id="reject-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.get-in-touch.destroy', ['get_in_touch' => $data->id]) }}">
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
                                    <!-- <tr>
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
                                    </tr> -->
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
