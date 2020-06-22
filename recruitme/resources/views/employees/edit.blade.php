@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                    Edit Employee
                    <a href="{{ url()->previous() }}" class="text-muted" data-toggle="tooltip"
                    data-placement="top" title="Cancel">
                        <i class="fas fa-window-close"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="{{route('employees.update',['employee'=>$employee])}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="company" class="font-weight-bold">Which company does this employee work for?</label>
                                <select class="form-control" name="company_id" value="{{$employee->company->name}}">
                                    <option disabled></option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <p class="font-weight-bold">Personal info</p>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{{$employee->name}}">
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="email">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf"
                                           value="{{$employee->cpf}}"
                                           placeholder="000.000.000-00">
                                </div>
                                <div class="form-group col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           value="{{$employee->email}}"
                                           placeholder="email@email.com">
                                </div>
                                <div class="form-group col">
                                    <label for="email">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           value="{{$employee->phone}}"
                                           placeholder="(99) 9999-9999">
                                </div>
                            </div>
                            <hr>
                            <p class="font-weight-bold">Address info</p>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cep">CEP/Postal Code</label>
                                    <input type="text" class="form-control" name="cep" id="cep"
                                           value="{{$employee->address->CEP}}">
                                </div>
                            </div>
                            <div class="alert alert-danger d-none" role="alert" id="cep-feedback">
                                <b>Sorry :(</b> This is not a valid CEP.
                            </div>
                            <div id="address-form">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="cep">Street</label>
                                        <input type="text" class="form-control" name="street" id="street"
                                               value="{{$employee->address->street}}"
                                               data-toggle="tooltip" title="Automatically filled by CEP" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="cep">Neighborhood</label>
                                        <input type="text" class="form-control" name="neighborhood" id="neighborhood"
                                               value="{{$employee->address->neighborhood}}"
                                               data-toggle="tooltip" title="Automatically filled by CEP" readonly>
                                    </div>
                                    <div class="form-group col">
                                        <label for="cep">City</label>
                                        <input type="text" class="form-control" name="city" id="city"
                                               value="{{$employee->address->city}}"
                                               data-toggle="tooltip" title="Automatically filled by CEP" readonly>
                                    </div>
                                    <div class="form-group col">
                                        <label for="cep">State</label>
                                        <input type="text" class="form-control" name="state" id="state"
                                               value="{{$employee->address->state}}"
                                               data-toggle="tooltip" title="Automatically filled by CEP" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="cep">Number</label>
                                        <input type="text" class="form-control" name="number" id="number"
                                               value="{{$employee->address->number}}">
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="cep">Complement</label>
                                        <input type="text" class="form-control" name="complement" id="complement"
                                               value="{{$employee->address->complement}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{route('employees.show', ['employee' => $employee])}}" class="btn
                            btn-secondary">Cancel</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        let cpf = $('#cpf');
        let cep = $('#cep');
        let phone = $('#phone');

        cep.mask('99999-999');
        cpf.mask('999.999.999-99');
        phone.mask('(99) 99999-9999');
        cep.on('keyup', function(){
            if (this.value.length === 9) {
                $.get( "https://viacep.com.br/ws/"+this.value+"/json/", function( data ) {
                    if(data.erro) {
                        $('#cep-feedback').removeClass('d-none');
                    } else {
                        $('#cep-feedback').addClass('d-none');
                    }
                    $('#street').val(data.logradouro);
                    $('#neighborhood').val(data.bairro);
                    $('#city').val(data.localidade);
                    $('#state').val(data.uf);
                });
            } else {
                $('#street').val('');
                $('#neighborhood').val('');
                $('#city').val('');
                $('#state').val('');
                $('#number').val('');
                $('#complement').val('');
            }
        })

    </script>
@endsection
