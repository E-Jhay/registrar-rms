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
                        <label for="inputName">Project Name</label>
                        <input type="text" id="inputName" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                  <label for="inputDescription">Project Description</label>
                  <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select class="form-control custom-select">
                    <option selected disabled>Select one</option>
                    <option>On Hold</option>
                    <option>Canceled</option>
                    <option>Success</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputClientCompany">Client Company</label>
                  <input type="text" id="inputClientCompany" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputProjectLeader">Project Leader</label>
                  <input type="text" id="inputProjectLeader" class="form-control">
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Porject" class="btn btn-success float-right">
          </div>
        </div>
      </section>
      <!-- /.content -->
</div>
@endsection
