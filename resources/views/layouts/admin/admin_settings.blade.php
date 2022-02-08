
@extends('layouts.admin_layout.admin_layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Update Admin Password</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form rolf="form" method="post" action="{{ url('/admin/update-pwd') }}" name="updatePasswordForm" id="updatePasswordForm">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputName">Admin Name</label>
                                            <input type="text" class="form-control" value="{{ $adminDetails->name }}" placeholder="Enter Admin/Sub Admin Name" id="admin_name" name="admin_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Admin Email</label>
                                            <input class="form-control" value="{{ $adminDetails->email }}" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputType">Admin Type</label>
                                            <input class="form-control" value="{{ $adminDetails->type }}" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Current Password</label>
                                            <input type="password" class="form-control"
                                                placeholder="Enter Current Password" id="current_password" name="current_password">
                                                <span id="checkCurrentPwd"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">New Password</label>
                                            <input type="password" class="form-control"
                                                placeholder="Enter New Password" id="new_password" name="new_password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirm Password</label>
                                            <input type="password" class="form-control"
                                                placeholder="Confirm New Password" id="confirm_password" name="confirm_password">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->
@endsection('content')
