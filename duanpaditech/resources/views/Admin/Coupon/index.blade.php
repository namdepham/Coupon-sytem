@extends('admin.layouts.master')

@section('title', 'List coupons')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <h3 class="title-5 m-b-35 table-data__tool-left">Coupon List</h3>
                            <div class="table-data__tool-right">
                                <a href="{{ route('coupon.create') }}" class="btn btn-outline-success">
                                    <i class="zmdi zmdi-plus mr-1"></i>Add more coupons
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Brand</th>
                                    <th>Coupon name</th>
                                    <th>Image</th>
                                    <th>Number of times to get voucher</th>
                                    <th>Description</th>
                                    <th colspan="2" class="text-center">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $row)
                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $row->app_name }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            @if($row->image)
                                                <img src="{{ asset('storage/'.$row->image) }}" alt=""
                                                     width="100px"/>
                                            @else
                                                {{ $row->image }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $row->config_coupon }}
                                        </td>
                                        <td> {{ $row->description }} </td>
                                        <td>
                                            <a href="{{ route('coupon.edit', $row) }}"
                                               class="btn btn-outline-primary"><i
                                                    class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('coupon.destroy', $row) }}" method="POST">
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




