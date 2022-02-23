@push('css')
<style>
    .nav-tabs .nav-link{
        color: #000;
    }
    .nav-tabs .nav-link.active{
        color: #fff;
        background-color: #007bff;
        border-color: trasparent;
    }
</style>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-12">
                  <h1 class="m-0 d-inline">Logs</h1>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->
      
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-title">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                <a class="nav-link {{ $documentStatus == '' ? 'active' : null }}" wire:click.prevent="changeStatus('')" href="#">All</a>
                                </li>
                                @foreach ($statuses as $status)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $documentStatus == $status->id ? 'active' : null }}" wire:click.prevent="changeStatus({{$status->id}})" href="#">
                                            {{$status->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content p-3">
                            <div class="tab-pane active" id="pending">
                                <div class="row">
                                    <div class="form-group col-3 mt-2">
                                        <input type="text"  class="form-control border-secondary" placeholder="Search by (name/ctr_no/or_no)" wire:model.debounce.300ms="searchTerm" />
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortId">
                                            <option value="">All</option>
                                            @foreach ($documentTypes as $documentType)
                                            <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortUser">
                                            <option value="">All</option>
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortBy">
                                            <option value="updated_at">Updated At</option>
                                            <option value="created_at">Created At</option>
                                            <option value="name">Name</option>
                                            <option value="department_id">Department</option>
                                            <option value="ctr_no">Control Number</option> 
                                            <option value="or_no">OR Number</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortDirection">
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-1 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="perPage">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="250">250</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Control No</th>
                                                    <th>Name</th>
                                                    <th>Document Type</th>
                                                    <th>Department</th>
                                                    <th>Status</th>
                                                    <th>OR Number</th>
                                                    <th>Date Updated</th>
                                                    @if ($documentStatus == 3)
                                                        <th>Claimed By</th>
                                                    @else
                                                        <th>Cost</th>
                                                    @endif
                                                    <th>Updated By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $index => $order)
                                                <tr>
                                                    <td>{{$order->ctr_no}}</td>
                                                    <td>{{$order->name}}</td>
                                                    <td>{{$order->document_type->name}}</td>
                                                    <td>{{$order->department->name}}</td>
                                                    <td>
                                                        <div class="@if($order->status_id == 1)
                                                            bg-danger 
                                                            @elseif($order->status_id == 2)
                                                            bg-primary
                                                            @elseif($order->status_id == 3)
                                                            bg-success
                                                            @elseif($order->status_id == 4)
                                                            bg-warning
                                                            @endif
                                                         rounded px-1">{{$order->status->name}}</div>
                                                    </td>
                                                    <td>{{$order->or_no}}</td>
                                                    <td>{{$order->updated_at}}</td>
                                                    @if ($documentStatus == 3)
                                                        <td>{{$order->claimedBy}}</td>
                                                    @else
                                                        <td>{{$order->cost}}</td>
                                                    @endif

                                                    @if ($order->user_id == 1)
                                                        <td> </td>
                                                    @else
                                                        <td>
                                                            {{$order->updatedBy->name}}
                                                            @if ($order->user_id == auth()->user()->id)
                                                                (Me)
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                                @empty
                                                    <tr>
                                                    <td colspan="9" class="text-center">No Items Available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            </table>
                                            <p>
                                                Showing {{$orders->firstItem()}} to {{$orders->lastItem()}} out of {{$orders->total()}} items.
                                            </p>
                                            {{ $orders->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

