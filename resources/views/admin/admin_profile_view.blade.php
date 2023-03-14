@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{ url('upload/admin_images/'.$adminData->profile_image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{ $adminData->name }}</h4>
                        <p class="card-text">
                            E-mail: {{ $adminData->email }}<br>
                            Username: {{ $adminData->username }}
                        </p>
                        <a href="{{ route('edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light">Edit profile</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection