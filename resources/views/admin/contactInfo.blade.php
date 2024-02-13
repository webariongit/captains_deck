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
                        <h4 class="page-title"> Contact Info </h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card-box">
                        <h4 class="mb-4">Update / Set Contact Info </h4>
                        <form method="post" action="">

                        <div class="col-lg-12 col-xl-12">
                                <div class="card-box">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="settings">
                                            <form method="post" action="/contactInfo-update" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="text-danger">*</span></label>
                                                        <input type="hidden" name="phone_code" class="form-control col-3" value="{{ $datas->phone_code }}" placeholder="Enter Your Phone Number" data-toggle="input-mask" data-mask-format="0000 000 000" required>
                                                        <input type="text" name="contact" class="form-control col-12" value="{{ $datas->contact }}" placeholder="Enter Your Phone Number" data-toggle="input-mask" data-mask-format="0000 000 000" required>
                                                    </div>
                                                </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email <span class="text-danger">*</span></label>
                                                            <input type="email" name="email" class="form-control" value="{{ ($datas->email) }}" placeholder="Enter Your Email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>facebook <span class="text-danger">*</span></label>
                                                            <input type="text" name="facebook" class="form-control" value="{{ ($datas->address) }}" placeholder="Enter Your text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>instagram <span class="text-danger">*</span></label>
                                                            <input type="text" name="instagram" class="form-control" value="{{ ($datas->facebook) }}" placeholder="Enter Your text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>twitter <span class="text-danger">*</span></label>
                                                            <input type="text" name="twitter" class="form-control" value="{{ ($datas->instagram) }}" placeholder="Enter Your text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>youtube <span class="text-danger">*</span></label>
                                                            <input type="text" name="youtube" class="form-control" value="{{ ($datas->youtube) }}" placeholder="Enter Your text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>linkedin <span class="text-danger">*</span></label>
                                                            <input type="text" name="linkedin" class="form-control" value="{{ ($datas->linkedin) }}" placeholder="Enter Your text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>order_online <span class="text-danger">*</span></label>
                                                            <input type="text" name="order_online" class="form-control" value="{{ ($datas->order_online) }}" placeholder="Enter Your text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>open_hours <span class="text-danger">*</span></label>
                                                            <input type="text" name="open_hours" class="form-control" value="{{ ($datas->open_hours) }}" placeholder="Enter Your text" required>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>open_hours <span class="text-danger">*</span></label>
                                                            <input type="email" name="" class="form-control" value="{{ ($datas->open_day) }}" placeholder="Enter Your Email" required>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Address <span class="text-danger">*</span></label>
                                                            <textarea name="address" class="form-control" placeholder="Enter Your Full Address" rows="4" style="resize: none;" required>{{ ($datas->address) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row -->
                                                
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end settings content-->

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

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
