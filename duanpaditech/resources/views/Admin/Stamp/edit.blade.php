@extends('admin.layouts.master')

@section('title', 'Edit stamp')

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
                            <form action=" {{ route('stamp.update', $data) }} " method="post" class="form-horizontal"
                                  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Number of ticks</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" id="name" name="config_stamp"
                                                   placeholder="Number of ticks" class="form-control" min="1" step="1"
                                                   value="{{ $data->config_stamp }}">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Can tick multiple times</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="in_many_times" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Apps</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="image" name="app_id"
                                                   placeholder="Number of ticks" class="form-control"
                                                   value="{{ $data->app_id }}" readonly>
                                            {{--                                            {{ $data->app->name }}--}}
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
