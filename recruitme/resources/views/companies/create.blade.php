@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                    New Company
                    <a href="{{ route('companies.index') }}" class="text-muted" data-toggle="tooltip"
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
                        <form action="{{route('companies.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Webiste</label>
                                        <input type="text" class="form-control" name="website">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <div class="form-group logo-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control-file" name="logo" id="logo">
                                    <div class="d-none text-danger font-weight-bold" id="logo-feedback"></div>
                                    <img src="" alt="" class="logo-preview mt-2" id="logo-preview">
                                    <input hidden type="text" class="form-control-file" name="logo_url" id="logo-url">
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
            let feedback = $('#logo-feedback');
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
                    }else {
                        feedback.append("<p>"+response.message+"</p>");
                        feedback.removeClass("d-none");
                        $('#logo').val('');
                    }
                },
            });
        });
    </script>
@endsection
