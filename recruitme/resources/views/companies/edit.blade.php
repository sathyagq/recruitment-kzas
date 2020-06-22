@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                    Edit Company
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
                        <form action="{{route('companies.update',['company' => $company])}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$company->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$company->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Webiste</label>
                                        <input type="text" class="form-control" name="website" value="{{$company->website}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{route('companies.show', ['company' => $company])}}" class="btn btn-secondary">Cancel</a>
                                </div>
                                <div class="form-group logo-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control-file" name="logo" id="logo">
                                    <div class="d-none text-danger font-weight-bold" id="logo-feedback"></div>
                                    <img class="logo-preview" src="{{$company->logo_url}}" alt="" id="logo-preview">
                                    <input type="text" class="form-control-file" name="logo-url"
                                           value="{{$company->logo_url}}" id="logo_url">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('#logo').change(function(){
            let fd = new FormData();
            let files = $('#logo')[0].files[0];
            fd.append('logo',files);

            $.ajax({
                url: 'http://api-php.loc/',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.status == "success"){
                        $('#logo-preview').attr("src",response.logo_url);
                        $('#logo-url').val(response.logo_url);
                        $('#logo-feedback').addClass("d-none");
                    }else{
                        feedback.append("<p>"+response.message+"</p>");
                        feedback.removeClass("d-none");
                        $('#logo').val('');
                    }
                },
            });
        });
    </script>
@endsection
