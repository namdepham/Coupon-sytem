@extends('admin.layouts.master')

@section('title', 'Store list')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <h3 class="title-5 m-b-35 table-data__tool-left">Store List</h3>
                            <div class="table-data__tool-right">
                                <a href="{{ route('import.stores') }}" class="btn btn-outline-success">
                                    <i class="zmdi zmdi-plus mr-1"></i>Import Stores
                                </a>
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
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Address</th>
                                    <th>QR Code</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $row)
                                    <tr class="text-center">
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->app->name }}</td>
                                        <td>{{ $row->address }}</td>
                                        <td>
                                            {{ Storage::disk('public')->put("qr.png", QrCode::format('png')->size(200)->generate(url('/stamp/app/' . $row->app->id .'/'.'store'.'/'.$row->id)) ) }}
                                            <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(url('/stamp/app/' . $row->app->id .'/'.'store'.'/'.$row->id))) !!} "
                                               download="qr.png">
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                                            ->size(100)->generate(url('/stamp/app/' . $row->app->id .'/'.'store'.'/'.$row->id))) !!}"
                                                     style="margin-bottom: 10px;">
                                            </a>
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
