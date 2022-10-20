@extends('admin.layouts.master')

@section('title', 'Add Admin')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- add category -->
                        <div class="card">
                            <div class="card-header">
                                <h3>Add admin</h3>
                            </div>
                            <form action=" {{ route('appAdmin.store') }} " method="post" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Name</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="name" name="name"
                                                   placeholder="Name type" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Email</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="name" name="email"
                                                   placeholder="Name type" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Password</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="password" id="name" name="password"
                                                   placeholder="Name type" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="logo" class="form-control-label">Avatar</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" id="avatar" name="image"
                                                   placeholder="Avatar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">App</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="app_id" class="form-control">
                                                <option hidden>Select the app</option>
                                                @foreach($data as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
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
