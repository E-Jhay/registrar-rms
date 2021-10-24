<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">Accounts</h1>
                    <button wire:click.prevent="create" class="d-inline btn btn-primary float-right">Add Account</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if($isOpen)
                <div class="row">
                    @include('livewire.accounts-create')
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="row p-2">
                            <div class="form-group col-4">
                                <input type="text"  class="form-control border-secondary" placeholder="Search...." wire:model.debounce.300ms="searchTerm" />
                            </div>
                            <div class="form-group col-3">
                                <select class="form-control custom-select border-secondary" wire:model="sortBy">
                                    <option value="created_at">Date Created</option>
                                    <option value="name">Name</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <select class="form-control custom-select border-secondary" wire:model="sortDirection">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <select class="form-control custom-select border-secondary" wire:model="perPage">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="250">250</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accounts as $account)
                                    <tr>
                                        <td>{{$account->id}}</td>
                                        <td>{{$account->name}}</td>
                                        <td>{{$account->email}}</td>
                                        <td>{{$account->created_at}}</td>
                                        <td class="text-center">
                                            <button class="btn" wire:click="edit({{$account->id}})"><i class="fas fa-edit text-primary"></i></button>
                                            <button class="btn" wire:click="destroyConfirm({{$account->id}})"><i class="fas fa-trash-alt text-danger"></i></button>
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
                                Showing {{$accounts->firstItem()}} to {{$accounts->lastItem()}} out of {{$accounts->total()}} items.
                            </p>
                            {{ $accounts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
      <!-- /.content -->
</div>