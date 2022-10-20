@extends('admin.layouts.master')

@section('title', 'List stamp images')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <h3 class="title-5 m-b-35 table-data__tool-left">Stamp image List</h3>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Brand</th>
                                    <th>Image before ticked</th>
                                    <th>Image after ticked</th>
                                    <th colspan="3" class="text-center">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $row)
                                    <tr class="text-center">
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->stamp->app->name }}</td>
                                        <td>
                                            @if($row->image_before_ticked)
                                                <img src="{{ asset('storage/'.$row->image_before_ticked) }}" alt=""
                                                     width="100px"/>
                                            @else
                                                {{ $row->image_before_ticked }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->image_after_ticked)
                                                <img src="{{ asset('storage/'.$row->image_after_ticked) }}" alt=""
                                                     width="100px"/>
                                            @else
                                                {{ $row->image_after_ticked }}
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('image.edit', $row) }}" class="btn btn-outline-primary"><i
                                                    class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('image.destroy', $row) }}" method="POST">
                                                @method ('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{$data->links()}}
                            </div>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




