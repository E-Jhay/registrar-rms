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
                    <div class="card p-2">
                        <div class="card-title">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{ $documentStatus == 1 ? 'active' : null }}" wire:click.prevent="changeStatus(1)" href="#">
                                        Pending
                                    </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link {{ $documentStatus == 2 ? 'active' : null }}" wire:click.prevent="changeStatus(2)" href="#">Finished</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link {{ $documentStatus == '' ? 'active' : null }}" wire:click.prevent="changeStatus('')" href="#">All</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="pending">
                                <div class="row">
                                    <div class="col-sm-12 my-2">
                                        <input type="text"  class="form-control float-right col-4" placeholder="Search...." wire:model="searchTerm" />
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th wire:click="sort('id')" style="cursor: pointer">
                                                        Id
                                                        @include('layouts.partials.sort-icon', ['field' => 'id'])
                                                    </th>
                                                    <th wire:click="sort('ctr_no')" style="cursor: pointer">
                                                        Control No
                                                        @include('layouts.partials.sort-icon', ['field' => 'ctr_no'])
                                                    </th>
                                                    <th wire:click="sort('name')" style="cursor: pointer">
                                                        Name
                                                        @include('layouts.partials.sort-icon', ['field' => 'name'])
                                                    </th>
                                                    <th wire:click="sort('document_type_id')" style="cursor: pointer">
                                                        Document Type
                                                        @include('layouts.partials.sort-icon', ['field' => 'document_type_id'])
                                                    </th>
                                                    <th wire:click="sort('status_id')" style="cursor: pointer">
                                                        Status
                                                        @include('layouts.partials.sort-icon', ['field' => 'status_id'])
                                                    </th>
                                                    <th wire:click="sort('or_no')" style="cursor: pointer">
                                                        OR No
                                                        @include('layouts.partials.sort-icon', ['field' => 'or_no'])
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $order)
                                                <tr>
                                                    <td>{{$order->id}}</td>
                                                    <td>{{$order->ctr_no}}</td>
                                                    <td>{{$order->name}}</td>
                                                    <td>{{$order->document_type->name}}</td>
                                                    <td>{{$order->status->name}}</td>
                                                    <td>{{$order->or_no}}</td>
                                                    <td>
                                                        <button wire:click="edit({{ $order->id }})"
                                                            class="btn btn-primary btn-sm">Edit</button>
                                                        <button wire:click="delete({{ $order->id }})"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
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
