@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                    Employee Details
                    <div class="d-flex flex-row">
                        <a href="{{route('employees.edit',['employee'=>$employee])}}" type="button" class="btn
                        btn-primary mr-1"
                           data-toggle="tooltip" data-placement="top" title="Edit employee">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{route('employees.destroy',['employee'=>$employee])}}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                    data-placement="top" title="Delete employee"
                                    onclick="return confirm('Are you sure? There is no coming back!')"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex flex-column justify-content-between">
                        <div class="d-flex flex-row">
                            <p class="mr-3">Name:</p>
                            <p class="font-weight-bold">{{$employee->name}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">Email:</p>
                            <p class="font-weight-bold">{{$employee->email}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">Phone:</p>
                            <p class="font-weight-bold">{{$employee->phone}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">CPF:</p>
                            <p class="font-weight-bold">{{$employee->cpf}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">CEP:</p>
                            <p class="font-weight-bold">{{$employee->address->CEP}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">Street:</p>
                            <p class="font-weight-bold">{{$employee->address->street}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">Number:</p>
                            <p class="font-weight-bold">{{$employee->address->number}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">Complement:</p>
                            <p class="font-weight-bold">{{$employee->address->complement}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">City:</p>
                            <p class="font-weight-bold">{{$employee->address->city}}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="mr-3">State:</p>
                            <p class="font-weight-bold">{{$employee->address->state}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
