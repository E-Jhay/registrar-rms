@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
<div class="@auth content-wrapper @endauth @guest p-4 @endguest">
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
  
                        
                    </div>
                    <div class="card-body">
                        @livewire('orders-create')
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
