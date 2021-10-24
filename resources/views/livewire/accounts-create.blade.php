<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Account</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{$isNewAccount ? 'store' : 'update'}}">
                
                <div class="row" style="background-color: trasparent">
                    <div class="form-group col-6">
                        <label>Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if($isNewAccount)
                        <div class="form-group col-6">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" wire:model.lazy="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label>Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" wire:model="password_confirmation" required autocomplete="new-password">
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button wire:click.prevent="closeModal" class="btn btn-warning float-right">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>