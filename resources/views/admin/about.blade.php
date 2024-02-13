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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">MACJ</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Content Management</a></li>
                                <li class="breadcrumb-item active">About Us</li>
                            </ol>
                        </div>
                        <h4 class="page-title"> {{ ($datas->title) }} </h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card-box">
                        <h4 class="mb-4">Update / Set {{ ($datas->title) }}</h4>
                        <form method="post" action="{{ $form_route ?? url('#') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ ($datas->id) }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" placeholder="Enter Your Full description" rows="20" style="resize: none;" required>{{ ($datas->description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="text-right">
                                    <button type="reset" class="btn btn-danger waves-effect waves-light m-r-5"><i class="mdi mdi-delete"></i></button>
                                    <button type="submit" class="btn btn-success waves-effect waves-light"> <span>Update</span> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
