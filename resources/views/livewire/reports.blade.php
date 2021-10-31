<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-12">
                  <h1 class="m-0 d-inline">Reports</h1>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->
      
    <section class="content">
        <div class="container-fluid">
            <div class="card p-2">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Month</label>
                            <select class="form-control custom-select" wire:model="month">
                                <option value="" disabled>Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" onclick="print()">Print</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-gradient-info">
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
                                        <td class="text-center">Total</td>
                                        <td class="text-center">{{$totalCount}}</td>
                                    </tr>
                                    {{-- <div>{{$orders}}</div>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{$order->document_type->name}}</td>
                                            <td>{{$order->department->name}}</td>
                                            <td>{{$order->ordersCount}}</td>
                                            <td class="text-center">
                                                <button class="btn" wire:click="edit({{$order->id}})"><i class="fas fa-edit text-primary"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Items Available</td>
                                        </tr>
                                    @endforelse --}}
                                </tbody>
                                </table>
                                {{-- <p>
                                    Showing {{$orders->firstItem()}} to {{$orders->lastItem()}} out of {{$orders->total()}} items.
                                </p>
                                {{ $orders->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


