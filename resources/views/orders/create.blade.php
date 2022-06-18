@extends('layouts.app')
@push('css')
<style>
    .que {
        display: flex;
        width: 95%;
        max-height: 70vh;
        overflow: auto;
        justify-content: space-around;
        border-radius: 10px;
        background-color: #fff;
        color: #111;
        margin-top: 1.5em;
        margin-inline: auto;
        padding: 3em 5em;
        box-shadow: .25em .25em .75em rgba(0,0,0,.25),
                    .125em .125em .25em rgba(0,0,0,.15);
    }

    .processing, .collect {
        text-align: center;
    }

    .title {
        font-size: 3\rem;
    }

    .que ul {
        list-style: none;
        margin: 0;
        padding: 0;
        font-size: 2.5rem;
        font-weight: 600;
    }

    .title-green {
        color: #32cd32;
    }
</style>
@endpush

@section('content')

@guest
    @livewire('que')
@endguest

  <!-- Content Wrapper. Contains page content -->
<div class="@auth content-wrapper @endauth @guest p-4 @endguest">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Request Document</h1>
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
                        <h3 class="card-title">Document Request Form</h3>
  
                        
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
