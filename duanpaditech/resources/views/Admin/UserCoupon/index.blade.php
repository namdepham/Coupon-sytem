@extends('admin.layouts.master')

@section('title', 'User Coupon list')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <h3 class="title-5 m-b-35 table-data__tool-left">User Coupon List</h3>
                            <div class="table-data__tool-left">
                                <form>
                                    <div class="input-group input-daterange">
                                        <form action="{{ route('user.coupon.index') }}" method="GET">
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" name="start_date">
                                                <input type="date" class="form-control" name="end_date">
                                                <button class="btn btn-primary" type="submit">GET</button>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                            </div>
                            <div class="table-data__tool-right">
                                <form method="post" action="{{ route('exportFile.user.coupon') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        Export Data
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Coupon Name</th>
                                    <th>Phonenumber</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                @foreach($data as $key => $row)
                                    <tr class="text-center">
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->coupon_name }}</td>
                                        <td>{{ $row->phonenumber }}</td>
                                        <td>{{ $row->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
