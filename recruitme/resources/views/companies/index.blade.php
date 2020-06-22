@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                    Companies
                    <a href="{{ route('companies.create') }}" type="button" class="btn btn-primary"
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
                    @if($companies->count())
                        <table class="table table-hover table-responsive-lg">
                            <thead>
                                <tr>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Website</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td scope="row">
                                        <img src="{{$company->logo_url}}" alt="">
                                    </td>
                                    <td scope="row">{{$company->name}}</td>
                                    <td scope="row">{{$company->email}}</td>
                                    <td scope="row"><a href="{{$company->website}}" target="_blank">{{$company->website}}</a></td>
                                    <td scope="row">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{route('companies.edit', ['company' => $company])}}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Edit">
                                                <i class="fa fa-pen text-muted"></i>
                                            </a>
                                            <a href="{{route('companies.show', ['company' => $company])}}" data-toggle="tooltip" data-placement="top"
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
                            {{$companies->links()}}
                        </div>
                    @else
                        <div class="text-center">
                            <p>No registered companies yet.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
