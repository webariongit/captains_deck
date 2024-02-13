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
                                            <li class="breadcrumb-item active">User Profile</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">User Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="{{ asset($datas->picture) }}" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                    <!-- <h4 class="mb-0">Geneva McKnight</h4> -->
                                    <p class="text-muted">{{ ( '@'.$datas->employe_type) }}</p>

                                    <!-- <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Active</button>
                                    <a href="list-users.html" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">back</a> -->

                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-13">
                                            <strong>Full Name :</strong> 
                                            <span class="ml-2">{{ ($datas->name) }}</span>
                                        </p>

                                        <p class="text-muted mb-2 font-13">
                                            <strong>Mobile :</strong>
                                            <span class="ml-2">{{ ($datas->contect) }}</span>
                                        </p>

                                        <p class="text-muted mb-2 font-13">
                                            <strong>Email :</strong> 
                                            <span class="ml-2 ">{{ ($datas->email) }}</span>
                                        </p>

                                        <p class="text-muted mb-1 font-13">
                                            <strong>Address :</strong> 
                                            <span class="ml-2">{{ ($datas->address) }}</span>
                                        </p>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col-->

                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="settings">
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="" class="form-control" value="" placeholder="Enter Your Full Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone <span class="text-danger">*</span></label>
                                                            <input type="text" name="" class="form-control" value="" placeholder="Enter Your Phone Number" data-toggle="input-mask" data-mask-format="0000 000 000" required>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email <span class="text-danger">*</span></label>
                                                            <input type="email" name="" class="form-control" value="" placeholder="Enter Your Email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Gender <span class="text-danger">*</span></label><br>
                                                            <div class="radio radio-info form-check-inline">
                                                                <input type="radio" id="inlineRadio1" value="Male" name="gender" checked>
                                                                <label for="inlineRadio1"> Male </label>
                                                            </div>
                                                            <div class="radio radio-info form-check-inline">
                                                                <input type="radio" id="inlineRadio2" value="Female" name="gender">
                                                                <label for="inlineRadio2"> Female </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Profile Picture</label>
                                                            <input type="file" name="" class="form-control" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Address <span class="text-danger">*</span></label>
                                                            <textarea name="" class="form-control" placeholder="Enter Your Full Address" rows="4" style="resize: none;" required></textarea>
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
