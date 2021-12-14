@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="m-0 d-inline">Dashboard</h1>
                <a href="{{route('orders.create')}}" class="btn btn-primary float-right">Request Document</a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$allOrders}}</h3>
                        <p>All Requests This Month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$pendingOrders}}</h3>
                        <p>Pending Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$claimableOrders}}</h3>
                        <p>Claimable Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$ReleasedOrders}}</h3>
                        <p>Released Orders this month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.content -->
            <!-- ./col -->
            <div class="col-12 col-sm-3 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Requests</div>
                    </div>
                    <div class="card-body">
                        <div id="barChart" style="height: 23rem;" ></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Request Statuses</div>
                    </div>
                    <div class="card-body">
                        <div id="pieChart" style="height: 23rem;" ></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script>
    const Barchart = new Chartisan({
      el: '#barChart',
      url: "@chart('dashboard_chart')",
      hooks: new ChartisanHooks()
        .colors(['#17a2b8'])
    });

    const Piechart = new Chartisan({
      el: '#pieChart',
      url: "@chart('pie_chart')",
      hooks: new ChartisanHooks()
        .datasets('doughnut')
        .pieColors(['#dc3545', '#007bff', '#28a745', '#ffc107'])
    });
</script>
@endpush

