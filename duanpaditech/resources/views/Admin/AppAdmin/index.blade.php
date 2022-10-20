@extends('admin.layouts.master')

@section('title', 'App Admin')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <h3 class="title-5 m-b-35 table-data__tool-left">App Admin List</h3>
                            <div class="table-data__tool-left">
                                <select class="form-control" name="apps" id="apps">
                                    <option value=""><a href="{{ route('appAdmin.index') }}">All</a></option>
                                    @if(count($apps) > 0)
                                        @foreach($apps as $app)
                                            <option value="{{ $app->id }}"> {{ $app->name }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('appAdmin.create') }}" class="btn btn-outline-success">
                                    <i class="zmdi zmdi-plus mr-1"></i>Add more admins
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Avatar</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                @foreach($data as $key => $row)
                                    <tr id="tbody" class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            @if($row->image)
                                                <img src="{{ asset('storage/'.$row->image) }}" alt="" width="100px"/>
                                            @else
                                                Photo is null
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('appAdmin.edit', $row->id) }}"
                                               class="btn btn-outline-primary"><i
                                                    class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('appAdmin.destroy', $row->id) }}" method="POST">
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
                            <script>
                                $(document).ready(function () {
                                    $("#apps").on('change', function () {
                                        var app = $(this).val();
                                        $.ajax({
                                            url: "{{ route('filter.admin') }}",
                                            type: 'GET',
                                            data: {'app': app},
                                            success: function (data) {

                                                function setCookie(name, value, daysToLive) {
                                                    var cookie = name + "=" + encodeURIComponent(value);
                                                    if (typeof daysToLive === "number") {
                                                        cookie += "; max-age=" + (daysToLive * 24 * 60 * 60);
                                                        document.cookie = cookie;
                                                    }
                                                }

                                                function getCookie(cname) {
                                                    let name = cname + "=";
                                                    let decodedCookie = decodeURIComponent(document.cookie);
                                                    let ca = decodedCookie.split(';');
                                                    for (let i = 0; i < ca.length; i++) {
                                                        let c = ca[i];
                                                        while (c.charAt(0) === ' ') {
                                                            c = c.substring(1);
                                                        }
                                                        if (c.indexOf(name) === 0) {
                                                            return c.substring(name.length, c.length);
                                                        }
                                                    }
                                                    return "";
                                                }

                                                var admins = data.admins;
                                                var html = '';
                                                if (admins.length > 0) {
                                                    for (let i = 0; i < admins.length; i++) {
                                                        var img = admins[i]['image'];
                                                        setCookie('id', admins[i]['id'], 3000);
                                                        var str = `{{ asset('/storage')}}/${img}`;
                                                        var edit = `app-admin/` + getCookie('id') + `/edit`;
                                                        var destroy = `app-admin/` + getCookie('id') + `/delete`;

                                                        html +=
                                                            '<tr>' +
                                                            '<td>' + admins[i]['name'] + '</td>' +
                                                            '<td>' + admins[i]['email'] + '</td>' +
                                                            '<td>' + `<img src='${str}' width="100px"/>` + '</td>' +
                                                            '<td>' + `<a class="btn btn-outline-primary" href="${edit}"> Edit</a>` + '</td>' +
                                                            '<td>' +
                                                            `<form method="post" action="${destroy}">
                                                                    @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger" href="${destroy}">Delete</button>
                                                            </form>
                                                            ` +
                                                            '</td>' +
                                                            '</tr>'
                                                    }
                                                } else {
                                                    html += '<tr>' +
                                                        '<td>No admins found<td>' +
                                                        '</tr>';
                                                }
                                                $("#tbody").html(html);
                                            }
                                        })
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
