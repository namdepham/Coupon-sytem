@extends('admin.layouts.master')

@section('title', 'Edit Stamp Card')

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
                                <h3>Edit Stamp Image</h3>
                            </div>
                            <form action=" {{ route('image.update', $data->id) }} " method="post"
                                  class="form-horizontal"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body card-block">
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Images before ticked</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" name="image_before_ticked">
                                            <img src="{{asset('storage/'.$data->image_before_ticked)}}" alt=""/>
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Images after ticked</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" name="image_after_ticked">
                                            <img src="{{asset('storage/'.$data->image_after_ticked)}}" alt=""/>
                                        </div>
                                    </div>
                                    <div class="row form-group justify-content-center" style="display: none">
                                        <div class="col-md-1">
                                            <label for="name" class="form-control-label">Stamp belongs to Apps</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="stamp_id" value="{{ $data->stamp_id }}" readonly/>
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
