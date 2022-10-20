@extends('admin.layouts.master')

@section('title', 'Edit Admin')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Edit admin</h3>
                            </div>
                            <form action="{{ route('appAdmin.update', $data) }}" method="post" class="form-horizontal"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-body card-block">
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Name</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="type" name="name"
                                                   placeholder="Name " class="form-control" value="{{$data->name}}">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Name</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="type" name="email"
                                                   placeholder="Email " class="form-control" value="{{$data->email}}">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="password" class="form-control-label">Password</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="password" id="password" name="password"
                                                   placeholder="Email " class="form-control"
                                                   value="{{$data->password}}">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Avatar</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" id="" name="image"
                                                   placeholder="Image" class="form-control" value="{{$data->image}}">
                                            <img src="{{asset('storage/'.$data->image)}}" alt=""/>
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">App</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="app_id" class="form-control" readonly="">
                                                @foreach($app as $app)
                                                    <option value="{{ $app->id }}">{{ $app->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

