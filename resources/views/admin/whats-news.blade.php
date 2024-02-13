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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Content Management</a></li>
                                <li class="breadcrumb-item active">Banners</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Banners</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"> 
                                Banner List &emsp;
                                <a href="#upload-banner" data-toggle="modal" class="btn btn-dark">Upload New</a>
                            </h4>
                            <p class="text-muted font-13 mb-4"><!-- Table Description --></p>

                            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                        <th>title</th>
                                        <th>header</th>
                                        <th>description</th>
                                        <th>media</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ ($data->title) }}</td>
                                        <td>{{ ($data->header) }}</td>
                                        <td>{{ ($data->description) }}</td>
                                        <!-- <td>{{ ($data->media) }}</td> -->
                                        <td>
                                            <a href="#image-view-modal" data-toggle="modal" onclick="setImage('assets/images/users/user-1.jpg')">
                                                <img src="{{ asset($data->media) }}" style="height: 60px;" alt="" class="img-thumbnail">
                                            </a>
                                        </td> 
                                        <!-- <td><span class="badge badge-success">{{ asset($data->media) }}</span></td> -->
                                        <td>
                                            <!-- <a href="#" title="Mark as Active"><i data-feather="thumbs-up"></i></a>
                                            &emsp;
                                            <a href="#" title="Mark as In-active"><i data-feather="thumbs-down"></i></a>
                                            &emsp; -->
                                            <a href="#reject-modal" data-toggle="modal"><i data-feather="trash"></i></a>
                                        </td>
                                    </tr>
                                    <div id="reject-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.banners.destroy', ['banner' => $data->id]) }}">
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

    <div id="upload-banner" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Upload </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" value='' class="form-control" name="title" required placeholder=" Title">
                            </div>
                            <div class="form-group">
                                <label>	header <span class="text-danger">*</span></label>
                                <input type="text" value='' class="form-control" name="header" required placeholder=" 	header">
                            </div>
                            <!-- <div class="form-group">
                                <label>Date <span class="text-danger">*</span></label>
                                <input type="date" value="" class="form-control" name="date" required placeholder="Select date">
                            </div> -->
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="editor" class="form-control" required placeholder="Write your complete description here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>media <span class="text-danger">(Browse picture if you want to change the image. Otherwise, Ignore it.)</span></label>
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
