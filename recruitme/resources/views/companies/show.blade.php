@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                    Company Details
                    <div class="d-flex flex-row">
                        <a href="{{ route('employees.filter', ['company' => $company]) }}" type="button"
                           class="btn btn-success mr-1" data-toggle="tooltip" data-placement="top"
                           title="View employees">
                            <i class="fas fa-users"></i>
                        </a>
                        <a href="{{ route('companies.edit', ['company' => $company]) }}" type="button"
                           class="btn btn-primary mr-1"
                           data-toggle="tooltip" data-placement="top" title="Edit company">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('companies.destroy', ['company' => $company]) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                    data-placement="top" title="Delete company"
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
                    <div class="d-flex flex-lg-row flex-md-column-reverse
                    justify-content-between align-items-center">
                        <div>
                            <div class="d-flex flex-row">
                                <p class="mr-3">Name:</p>
                                <p class="font-weight-bold">{{$company->name}}</p>
                            </div>
                            <div class="d-flex flex-row">
                                <p class="mr-3">Email:</p>
                                <p class="font-weight-bold">{{$company->email}}</p>
                            </div>
                            <div class="d-flex flex-row">
                                <p class="mr-3">Website:</p>
                                <a href="{{$company->website}}" class="font-weight-bold">{{$company->website}}</a>
                            </div>
                        </div>
                        <div>
                            <img class="logo" src="{{$company->logo_url}}" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
