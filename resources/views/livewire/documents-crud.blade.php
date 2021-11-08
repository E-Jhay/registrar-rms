<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">Documents</h1>
                    <button wire:click="create()" class="d-inline btn btn-primary float-right">Add Document</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if($isOpen)
                    @include('livewire.documents-create')
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th class="text-center">Days before Expire</th>
                                    <th class="text-center">Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documents as $document)
                                    <tr>
                                        <td>{{$document->name}}</td>
                                        <td>{{$document->code}}</td>
                                        <td class="text-center">{{$document->days_before_expire}}</td>
                                        <td class="text-center">{{$document->price}}</td>
                                        <td class="text-center">
                                            <button class="btn" wire:click="edit({{$document->id}})"><i class="fas fa-edit text-primary"></i></button>
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
                                Showing {{$documents->firstItem()}} to {{$documents->lastItem()}} out of {{$documents->total()}} items.
                            </p>
                            {{ $documents->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
      <!-- /.content -->
</div>