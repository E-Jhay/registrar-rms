<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Fill-out form</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="form-group col-4">
                        <label>Name</label>
                        <input type="text" wire:model.lazy="name" class="form-control" value="{{old('name')}}">
                        @error('name')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label>Code</label>
                        <input type="text" wire:model.lazy="code" class="form-control" value="{{old('code')}}">
                        @error('code')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label>Days Of Expiry</label>
                        <input type="number" wire:model.lazy="days_before_expire" class="form-control" value="{{old('days_before_expire')}}">
                        @error('days_before_expire')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label>Price</label>
                        <input type="number" wire:model.lazy="price" class="form-control" value="{{old('price')}}">
                        @error('price')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-primary">Insert Document</button>
                      <button wire:click.prevent="closeModal" class="btn btn-warning float-right">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>