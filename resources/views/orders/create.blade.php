@extends('layouts.admin')

@section('content')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Add Requests</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Fill-out form</h3>
  
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="inputName">Mobile</label>
                                <input type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <label for="inputName">OR Number</label>
                                <input type="text" id="inputName" class="form-control">
                            </div>
                        </div>
                        <hr class="col-12 bg-primary">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <label for="inputStatus">Document Type</label>
                                <select class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option>Success</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <div class="float-right mt-3">
                                    <a href="#" class="btn btn-block btn-danger mt-3">X</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="form-group col-12">
                              <a href="#" class="btn btn-secondary">Add another row</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                              <button type="submit" class="btn btn-primary">Insert Request/s</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        
      </section>
      <!-- /.content -->
</div>
@endsection
