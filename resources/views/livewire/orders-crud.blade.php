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
                  <h1 class="m-0 d-inline">{{$titlePage}}</h1>
                  <a href="{{route('orders.create')}}" class="d-inline btn btn-primary float-right">Add Request</a>
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
                                @foreach ($statuses as $status)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $documentStatus == $status->id ? 'active' : null }}" wire:click.prevent="changeStatus({{$status->id}})" href="#">
                                            {{$status->name}}
                                        </a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                <a class="nav-link {{ $documentStatus == '' ? 'active' : null }}" wire:click.prevent="changeStatus('')" href="#">All</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content p-3">
                            <div class="tab-pane active" id="pending">
                                <div class="row">
                                    <div class="form-group col-3 mt-2">
                                        <input type="text"  class="form-control border-secondary" placeholder="Search...." wire:model.debounce.300ms="searchTerm" />
                                    </div>
                                    <div class="form-group col-3 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortId">
                                            <option value="">All</option>
                                            @foreach ($documentTypes as $documentType)
                                            <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortBy">
                                            <option value="created_at">Date Created</option>
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
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="perPage">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="250">250</option>
                                        </select>
                                    </div>
                                    @if ($documentStatus != 3 && $documentStatus != 4)
                                        <div class="form-group col-sm-12 mb-2">
                                            <button class="btn btn-primary" wire:click.prevent="updateConfirm" @if($bulkDisabled) disabled @endif>Update
                                                <span class="badge badge-warning right">
                                                    {{count($selectedItems)}}
                                                </span></button>
                                        </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    @if ($documentStatus != 3 && $documentStatus != 4)
                                                        <th class="text-center">
                                                            @if ($documentStatus != '')
                                                            <input type="checkbox" wire:model="selectAll">
                                                            @endif
                                                        </th>
                                                    @endif
                                                    <th>Control No</th>
                                                    <th>Name</th>
                                                    <th>Document Type</th>
                                                    <th>Department</th>
                                                    <th>Status</th>
                                                    <th>OR Number</th>
                                                    <th>Date Created</th>
                                                    <th>Cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $index => $order)
                                                <tr>
                                                    @if ($documentStatus != 3 && $documentStatus != 4)
                                                        <td class="text-center">
                                                            @if ($order->status_id != 3 && $order->status_id != 4)
                                                            <input type="checkbox" wire:model="selectedItems.{{$order->id}}" name="selectedItems[{{$order->id}}]" value="{{$order->status_id}}">
                                                            @endif
                                                        </td>
                                                    @endif
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
                                                    <td>{{$order->created_at->diffForHumans()}}</td>
                                                    <td>{{$order->cost}}</td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                    <td colspan="7" class="text-center">No Items Available</td>
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

