@extends('admin.layouts.master')

@section('title', 'Edit Coupon')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Edit Coupon</h3>
                            </div>
                            <form action="{{ route('coupon.update', $data) }}" method="post" class="form-horizontal"
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
                                            <label for="name" class="form-control-label">Image</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" id="" name="image"
                                                   placeholder="image" class="form-control" value="{{$data->image}}">
                                            <img src="{{asset('storage/'.$data->image)}}" alt=""/>
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="description" class="form-control-label">Description</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="type" name="description"
                                                   placeholder="Name " class="form-control"
                                                   value="{{$data->description}}">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="config_coupon" class="form-control-label">Config coupon</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" id="type" name="config_coupon"
                                                   placeholder="Name " class="form-control"
                                                   value="{{$data->config_coupon}}" min="1" step="1">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center" style="display: none">
                                        <div class="col-md-1">
                                            <label for="description" class="form-control-label">App</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="type" name="app_id"
                                                   placeholder="Name " class="form-control" readonly
                                                   value="{{$data->app_id}}" >
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center" style="display: none">
                                        <div class="col-md-1">
                                            <label for="description" class="form-control-label">Stamp</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="type" name="stamp_id"
                                                   placeholder="Name " class="form-control" readonly
                                                   value="{{$data->stamp_id}}">
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
