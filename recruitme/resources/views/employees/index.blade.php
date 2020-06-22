@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                    Employees
                    <a href="{{ route('employees.create') }}" type="button" class="btn btn-primary"
                       data-toggle="tooltip" data-placement="top" title="Add new company">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if($employees->count())
                            <table class="table table-hover table-responsive-lg">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Company</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td scope="row">{{$employee->name}}</td>
                                        <td scope="row">{{$employee->email}}</td>
                                        <td scope="row">{{$employee->phone}}</td>
                                        <td scope="row">{{$employee->cpf}}</td>
                                        <td scope="row">{{$employee->company->name}}</td>
                                        <td scope="row">
                                            <div class="d-flex justify-content-between">
                                                <a href="{{route('employees.edit', ['employee' => $employee])}}"
                                                   data-toggle="tooltip"
                                                   data-placement="top" title="Edit">
                                                    <i class="fa fa-pen text-muted"></i>
                                                </a>
                                                <a href="{{route('employees.show', ['employee' => $employee])}}"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="Details">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="float-right">
                                {{$employees->links()}}
                            </div>
                        @else
                            <div class="text-center">
                                <p>No registered employee yet.</p>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
