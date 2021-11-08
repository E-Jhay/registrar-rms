@push('css')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
<style>
  td, th{
    text-align: center;
  }
</style>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1>Quarterly Reports</h1>
        <div class="input-group mt-2">
            <div class="input-group-prepend mb-2">
                <div class="input-group-text">Year</div>
            </div>
            <input type="number" class="form-control col-sm-2" wire:model="year" placeholder="YYYY" min="2020" max="2100">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Quarter</div>
            </div>
            <select class="form-control custom-select col-sm-2" wire:model="quarter">
                <option value="" disabled>Select Quarter</option>
                <option value="1st">1st Quarter</option>
                <option value="2nd">2nd Quarter</option>
                <option value="3rd">3rd Quarter</option>
                <option value="4th">4th Quarter</option>
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
                      Quarterly Report
                    </h4>
                    <h5>{{$quarter. " Quarter of " .$year}}</h5>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Year-Quarter</th>
                                <th>Tracking Number</th>
                                <th>Request Type</th>
                                <th>Date Received</th>
                                <th>Title of Request</th>
                                <th>Extension?</th>
                                <th>Status</th>
                                <th>Date Finished</th>
                                <th>Days Lapsed</th>
                                <th>Cost</th>
                                <th>Appeal/s filed</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse ($report as $key => $value)
                              @foreach ($value as $subKey => $subValue)
                                <tr>
                                  <td>{{$quarter. " " .$year}}</td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                      {{$subSubValue['ctr_no']}}<br>
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                      {{$documentCode[$subSubValue['request_type']]}}
                                      @if ($subSubKey < count($subValue))
                                      ,
                                      @endif
                                      <br>
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                    {{$subSubValue['date_received']}}<br>
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                    {{$documentType[$subSubValue['title_of_request']]}}
                                    @if ($subSubKey < count($subValue))
                                    ,
                                    @endif
                                    <br>
                                    @endforeach
                                    of {{$key}}
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                    {{$subSubValue['extension']}}<br>
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                    {{$status[$subSubValue['status']]}}<br>
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                      {{$subSubValue['date_finished']}}<br>
                                    @endforeach</td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                    {{$subSubValue['days_lapsed']}}<br>
                                    @endforeach
                                  </td>
                                  <td>
                                    {{$costPerCustomer[$key][$subKey]['cost']}}
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                    {{$subSubValue['appeals']}}<br>
                                    @endforeach</td>
                                  </td>
                                  <td>
                                    @foreach ($subValue as $subSubKey => $subSubValue)
                                    {{$subSubValue['remarks']}}<br>
                                    @endforeach
                                  </td>
                                </tr>
                              @endforeach
                          @empty
                              <tr>
                                <td colspan="12" class="text-center">No Items Available</td>
                              </tr>
                          @endforelse
                        </tbody>
                    </table>
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



