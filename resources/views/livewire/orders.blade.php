<form action="{{route('orders.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-4">
            <label for="mobile">Mobile</label>
            <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}">
        </div>
        <div class="form-group col-4">
            <label for="inputName">OR Number</label>
            <input type="or_no" name="or_no" class="form-control" value="{{old('or_no')}}">
        </div>
    </div>
    <hr class="col-12 bg-primary">
    <div class="row">
        <div class="col-6"><label>Name</label></div>
        <div class="col-4"><label>Document Type</label></div>
    </div>
    @foreach ($orderItems as $index => $orderItem)
        <div class="row">
            <div class="form-group col-6">
                <input type="text" class="form-control" name="orderItems[{{$index}}][name]" wire:model="orderItems.{{$index}}.name">
            </div>
            <div class="form-group col-4">
                <select class="form-control custom-select" name="orderItems[{{$index}}][document_type_id]"
                wire:model="orderItems.{{$index}}.document_type_id">
                <option value="" disabled>Select document</option>
                    @foreach ($document_types as $document_type)
                        <option value="{{$document_type->id}}">{{$document_type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-2">
                <div class="float-left">
                    <a href="#" wire:click.prevent="removeItem({{$index}})" class="btn btn-block btn-danger">X</a>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="form-group col-12">
          <button class="btn btn-secondary" wire:click.prevent="addItem">Add another row</button>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
          <button type="submit" class="btn btn-primary">Insert Request/s</button>
        </div>
    </div>
</form>