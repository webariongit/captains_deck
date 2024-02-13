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
                                <li class="breadcrumb-item active">Blogs</li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            Blogs &emsp;
                            <a href="#upload-blog" data-toggle="modal" class="btn btn-dark waves-effect waves-light">Create New</a>
                        </h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                @foreach($datas as $data)
                <div class="col-md-6 col-xl-4">
                    <div class="card-box product-box">
                        <div class="product-action">
                            <a href="#edit-blog" data-toggle="modal" class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-pencil"></i></a>
                            <a href="#reject-blog" data-toggle="modal" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></a>
                        </div>

                        <div class="bg-light">
                            <img src="{{ asset($data->media) }}" alt="product-pic" class="img-fluid" />
                        </div>

                        <div class="product-info">
                            <h5 class="font-16 mt-0 sp-line-1"><a href="#" class="text-dark"></a> {{ ($data->title) }}</h5>
                            <h5 class="font-16 mt-0 sp-line-1"><a href="#" class="text-dark"></a> {{ ($data->header) }}</h5>
                            <p class="text-justify">
                                {{ ($data->description) }}
                            </p>
                            <h5 class="font-13 mt-0 sp-line-1 text-right">{{ ($data->created_at) }}</h5>
                        </div> <!-- end product info-->
                    </div> <!-- end card-box-->
                </div> <!-- end col-->

                <div id="edit-blog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Edit Blog</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>                    
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" value='{{ ($data->title) }}' class="form-control" name="title" required placeholder="Blog Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Header <span class="text-danger">*</span></label>
                                        <input type="text" value='{{ ($data->header) }}' class="form-control" name="header" required placeholder="Blog header">
                                    </div>
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="editor" class="form-control" required placeholder="Write your complete description here...">{{ $data->description ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Picture <span class="text-danger">(Browse picture if you want to change the image. Otherwise, Ignore it.)</span></label>
                                        <input type="file" value="{{ asset($data->media) }}" class="form-control" name="media" required accept="image/*">                                
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
                <div id="reject-blog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <form method="POST" action="{{ route('admin.blogs.destroy', ['blog' => $data->id]) }}">
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
                <!-- <div class="col-md-6 col-xl-4">
                    <div class="card-box product-box">
                        <div class="product-action">
                            <a href="#edit-blog" data-toggle="modal" class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-pencil"></i></a>
                            <a href="#reject-modal" data-toggle="modal" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></a>
                        </div>

                        <div class="bg-light">
                            <img src="assets/images/bg-material.png" alt="product-pic" class="img-fluid" />
                        </div>

                        <div class="product-info">
                            <h5 class="font-16 mt-0 sp-line-1"><a href="#" class="text-dark">Adirondack Chair</a> </h5>
                            <p class="text-justify">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <h5 class="font-13 mt-0 sp-line-1 text-right">15th June, 2024 06:45 pm</h5>
                        </div> 
                    </div> 
                </div>  -->

            </div>
            <!-- end row-->
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
