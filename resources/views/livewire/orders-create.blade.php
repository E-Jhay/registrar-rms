<form wire:submit.prevent="storeItem">
    @csrf
    <div class="row">
        <div class="form-group col-4">
            <label for="mobile">Mobile</label>
            <input type="number/text" wire:model.lazy="mobile" class="form-control" value="{{old('mobile')}}">
            @error('mobile')
                <div class="text-danger">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group col-4">
            <label for="inputName">OR Number</label>
            <input type="text" wire:model.lazy="or_no" class="form-control" value="{{old('or_no')}}">
            @error('or_no')
                <span class="text-danger">
                    {{$message}}
                </span>
            @enderror
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
                <input type="text" class="form-control" name="orderItems[{{$index}}][name]" wire:model.lazy="orderItems.{{$index}}.name">
                @if ($errors->has('orderItems.' . $index . '.name'))
                    <span class="text-danger">
                        {{ $errors->first('orderItems.' . $index . '.name') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-4">
                <select class="form-control custom-select" name="orderItems[{{$index}}][document_type_id]"
                wire:model="orderItems.{{$index}}.document_type_id">
                <option value="" disabled>Select document</option>
                    @foreach ($document_types as $document_type)
                        <option value="{{$document_type->id - 1}}">{{$document_type->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('orderItems.' . $index . '.document_type_id'))
                    <span class="text-danger">
                        {{ $errors->first('orderItems.' . $index . '.document_type_id') }}
                    </span>
                @endif
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
          <button type="submit"class="btn btn-primary">Insert Request/s</button>
        </div>
    </div>
</form>