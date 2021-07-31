@extends('home2')

@section('content2')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Unir regla') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store2') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="event" class="col-md-4 col-form-label text-md-right">{{ __('Evento') }}</label>

                                <div class="col-md-6">
                                    <select name="event" id="event">
                                        <option value="0 BOOTSTRAP">0 BOOTSTRAP</option>
                                        <option value="1 BOOT">1 BOOT</option>
                                        <option value="2 PERIODIC">2 PERIODIC</option>
                                        <option value="4 VALUE CHANGE">4 VALUE CHANGE</option>
                                        <option value="6 CONNECTION REQUEST">6 CONNECTION REQUEST</option>
                                        <option value="7 TRANSFER COMPLETE">7 TRANSFER COMPLETE</option>
                                        <option value="8 DIAGNOSTICS COMPLETE">8 DIAGNOSTICS COMPLETE</option>
                                        <option value="9 REQUEST DOWNLOAD">9 REQUEST DOWNLOAD</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="precondition" class="col-md-4 col-form-label text-md-right">{{ __('Condicion') }}</label>

                                <div class="col-md-6">
                                    <input id="precondition" type="text" class="form-control" name="precondition">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="regla" class="col-md-4 col-form-label text-md-right">{{ __('Regla') }}</label>

                                <div class="col-md-6">
                                    <select name="regla" id="regla">
                                    <?php
                                    for($i=0;$i<$l2;$i++) {
                                        ?>
                                        <option value="{{ $obj2[$i]->_id }}">{{ $obj2[$i]->_id }}</option>
                                    <?php
                                    }
                                    ?>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Asignar regla') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
