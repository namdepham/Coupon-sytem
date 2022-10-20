@extends('admin.layouts.master')

@section('title', 'List stamps')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <h3 class="title-5 m-b-35 table-data__tool-left">Stamp List</h3>
                            <div class="table-data__tool-right">
                                <a href="{{ route('stamp.create') }}" class="btn btn-outline-success">
                                    <i class="zmdi zmdi-plus mr-1"></i>Add more stamp
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Brand</th>
                                    <th>Max ticks</th>
                                    <th>Allow multiple ticks in a day</th>
                                    <th colspan="4" class="text-center">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $row)
                                    <tr class="text-center">
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->config_stamp }}</td>
                                        <td>
                                            {{ $row->in_many_times === 1 ? "Active": "Inactive" }}
                                        </td>
                                        <td>
                                            <a href="{{ route('image.create',['stamp_id' => $row->id]) }}"
                                               class="btn btn-outline-primary"><i
                                                    class="fa fa-edit"></i> Add Stamp Image</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('image.index') }}" class="btn btn-outline-primary"><i
                                                    class="fa fa-view"></i> View Stamp Image</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('stamp.edit', $row) }}" class="btn btn-outline-primary"><i
                                                    class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('stamp.destroy', $row->id) }}" method="POST">
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
                            </div>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




