@push('css')
<link rel="stylesheet" href="{{ asset('css/monthly.css') }}">
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1>Monthly Reports</h1>
        <div class="input-group mt-2">
          <div class="input-group-prepend">
              <div class="input-group-text">Year</div>
          </div>
          <input type="number" class="form-control col-sm-2" wire:model="year" placeholder="YYYY" min="2020" max="2100">
        </div>
        <div class="input-group mt-2">
          <div class="input-group-prepend">
              <div class="input-group-text">Month</div>
          </div>
          <select class="form-control custom-select col-sm-2" wire:model="month">
            <option value="" disabled>Select Month</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
        </div>
      </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->
      
    <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12 text-center">
                    <h4>
                      Monthly Accomplishment Report
                    </h4>
                    <h5>{{\Carbon\Carbon::createFromFormat('m', $month)->format('F')." ". $year}}</h5>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Documents</th>
                                @foreach ($departments as $department)
                                    <th class="text-center">{{$department->name}}</th>
                                @endforeach
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $document => $values)
                                <tr>
                                    <td>{{$documentTypes[$document]}}</td>
                                    @foreach ($departments as $department)
                                        <td class="text-center">{{$report[$document][$department->id]['count'] ?? '0'}}</td>
                                    @endforeach
                                    <td class="text-center">{{$totalCountPerDocs[$document] ?? '0'}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">Total</td>
                                <td class="text-center">{{$totalCount}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="prepared-by float-right mr-3 mt-2">
                      <strong>Prepared By:</strong>
                      <p>{{Auth::user()->name}}</p>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" wire:click.prevent="export('xlsx')" wire:loading.attr="disabled" class="btn btn-success float-right">
                      <i class="fas fa-file-excel"></i> Excel
                  </button>
                  <button onclick="print()"class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                  </button>
                </div>
              </div>
            </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
        </div>

    </section>
</div>



