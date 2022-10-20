@extends('admin.layouts.master')

@section('title', 'Add Stamp Card')

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
                                <h3>Add Stamp Card</h3>
                            </div>
                            <form action=" {{ route('stamp.store') }} " method="post" class="form-horizontal"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Number of ticks</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" id="name" name="config_stamp"
                                                   placeholder="Number of ticks" class="form-control" min="1" step="1">
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
