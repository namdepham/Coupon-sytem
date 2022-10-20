@extends('admin.layouts.master')

@section('title', 'Add Coupon')

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
                                <h3>Add coupon</h3>
                            </div>
                            <form action=" {{ route('coupon.store') }} " method="post" class="form-horizontal"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Name</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="name" name="name"
                                                   placeholder="Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="image" class="form-control-label">Image</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" id="image" name="image"
                                                   placeholder="Image type" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="logo" class="form-control-label">Description</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="description" name="description"
                                                   placeholder="Description" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="config_coupon" class="form-control-label">Config coupon</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" id="config_coupon" name="config_coupon"
                                                   placeholder="Config Coupon" class="form-control" min="1" step="1">
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center" >
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Apps</label>
                                        </div>
                                        <div class="col-md-5">
                                            @if(! Auth::guard('admin')->user()->app_id)
                                                <select name="app_id" class="form-control">
                                                    @foreach($apps as $app)
                                                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input name="app_id" class="form-control"
                                                       value="{{ Auth::guard('admin')->user()->app_id }}" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center" >
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Stamp of App</label>
                                        </div>
                                        <div class="col-md-5">
                                            @if(isset($stamps))
                                                <select name="stamp_id" class="form-control">
                                                    @foreach($stamps as $stamp)
                                                        <option value="{{ $stamp->id }}">{{ $stamp->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input name="stamp_id" class="form-control" value="{{ $stamp_id }}"
                                                       readonly>
                                            @endif
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
