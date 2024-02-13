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
                                <li class="breadcrumb-item active">Gallery</li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            Gallery &emsp;
                            <a href="#upload-picture" data-toggle="modal" class="btn btn-dark waves-effect waves-light">Upload Picture</a> 
                            &ensp;
                            <a href="#upload-video" data-toggle="modal" class="btn btn-dark waves-effect waves-light">Upload Video</a>
                            &ensp;
                            <a href="#uploadYoutubeLink" data-toggle="modal" class="btn btn-dark waves-effect waves-light">Upload Youtube Link</a>
                        </h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                @foreach($datas as $data)
                    @if($data->media_types == 'image')
                        <div class="col-md-6 col-xl-4">
                            <div class="card-box product-box">
                                <div class="product-action">
                                    <a href="#GalleryData" data-toggle="modal" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></a>
                                </div>
                                <img src="{{ asset($data->media) }}" alt="product-pic" class="img-fluid" />
                            </div> <!-- end card-box-->
                        </div> <!-- end col-->

                        <div id="GalleryData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <form method="POST" action="{{ route('admin.gallerys.destroy', ['gallery' => $data->id]) }}">
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
                    @elseif($data->media_types == 'video')
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box product-box">
                            <div class="product-action">
                                <a href="#GalleryData" data-toggle="modal" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></a>
                            </div>
                            <video width="100%" height="240" controls>
                                <source src="{{ asset($data->media) }}" type="video/mp4">
                            </video>
                        </div>
                    </div> 

                    <div id="GalleryData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <form method="POST" action="{{ route('admin.gallerys.destroy', ['gallery' => $data->id]) }}">
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
                    @elseif($data->media_types == 'youtube')
                    <!-- {{ ($data->media) }} -->
                        <div class="col-md-6 col-xl-4">
                            <div class="card-box product-box">
                                <div class="product-action">
                                    <a href="#GalleryData" data-toggle="modal" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></a>
                                </div>
                                <iframe width="100%" height="240" src="{{ ($data->media) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        

                        <div id="GalleryData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <form method="POST" action="{{ route('admin.gallerys.destroy', ['gallery' => $data->id]) }}">
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
                    @endif
                @endforeach
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
