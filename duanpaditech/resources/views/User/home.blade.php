<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- CSS only -->
    <link rel="stylesheet" href="{{ asset('asset_fe/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
</head>
<script>
    localStorage.setItem('user_name', '{{ Cookie::get('user_name') }}');
    localStorage.setItem('user_phonenumber', '{{ Cookie::get('user_phonenumber') }}');
    localStorage.setItem('user_id', '{{ Cookie::get('user_id') }}');
</script>
<body>
<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Your Coupon List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>Coupon Info</th>
                            <th>N.O.S</th>
                            <th class="text-center">Description</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($couponLists as $couponData)
                            <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href="#"><img
                                                src="{{ asset('storage/'.$couponData->image) }}" alt="" width="72px"
                                                height="72px"/>
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="#">{{ $couponData->name }}</a></h4>
                                            <h5 class="media-heading"> by <a href="#">{{ $couponData->app->name }}</a>
                                            </h5>
                                            <span>Status: </span><span
                                                class="text-success"><strong>Available</strong></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                    <input readonly type="email" class="form-control" id="exampleInputEmail1"
                                           value="{{ $couponData->config_coupon }}">
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">{{ $couponData->description }}</td>
                                <td class="col-sm-1 col-md-16">
                                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal"
                                            data-toggle="modal" data-target-id="{{ $couponData->id }}"
                                            data-target="#myModal2">Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Coupon detail</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div class="header border border-default">
    <div class="bottom-header ">
        <div class="container">
            <div class="row ">
                <div class="col-md-8">
                    <div class="header-content">
                        <img class="pr-3" src="{{ asset('asset_home/images/logo1.png') }}" width="100px">
                        <span class="slash">|</span>
                        <span class="pl-3 date">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
                    </div>
                </div>
                <div class="col-md-4 mt-4" style="text-align: right">
                    <div class="row">
                        <div class="login pt-1 pl-3">
                            <a href="#" style="color: grey; text-decoration: none">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <span>
                                    <a href="#" data-toggle="modal"
                                       data-target="#myModal">You have {{ Session::get('numberOfCoupons') }} coupons
                                    </a>
                                </span>
                            </a>
                        </div>
                        <div class="login pt-1 pl-3">
                            <a href="#" style="color: grey; text-decoration: none">
                                <i class="far fa-user"></i>
                                <span><a href="{{ route('logout') }}">Đăng xuất</a></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content mt-4">
    <div class="news">
        <div class="container">
            <div class="row">
                <div class="thumbnail">
                    <img src="asset/images/thumbnail1.png" alt="">
                </div>
                @for($key = 0; $key < count($data); $key ++)
                    <div class="row ml-5 pl-5">
                        <div class="pr-5 pb-5">
                            <img alt=""
                                 width="200px"
                                 @if(isset($count[$key]))
                                     src="{{asset('storage/'.$data[$key]->image_after_ticked)}}"
                                 @else
                                     src="{{ asset('storage/'.$data[$key]->image_before_ticked) }}"
                                @endif
                            />
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function () {
        $("#myModal2").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('target-id');
            $.get("/coupon/detail/" + id, function (data) {
                var detail = data.detail;
                var img = detail['image'];
                var str = `{{ asset('/storage')}}/${img}`;
                var id = detail['id'];
                var useCoupon = `coupon/use/` + id;
                console.log(detail);
                var html = '';

                html += `
                    <div class="card text-center">
                    <div class="inner-card "><img src="${str}" width="100px"/>
                    <div class="d-flex justify-content-between align-items-center mt-3 px-2">
                    </div>
                    <h4 class="text-center">${detail['name']}</h4><span class="heart"><i class="fa fa-heart"></i></span>
                    <div class="mt-2 px-2"> <small>${detail['description']}</small></div>
                    <div class="px-2">
                    <h4 class="text-success">Available</h4>
                    </div>
                    <form>
                    <div class="px-2 mt-3 mb-3">
                        <button type="submit" id="use" class="btn btn-primary px-3" >
                            Use
                        </button>
                        <input type="text" id="editId" style="display: none" value="${detail['id']}">
                    </div>
                    </form>
                    </div>
                    `
                $("#modalBody").html(html);
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on("click", "#use", function () {
            var id = $("#editId").val();
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = "/coupon/use/" + id;

            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: id
                },
                success: function(dataResult){
                    dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode)
                    {
                        console.log(dataResult.statusCode);
                    }
                    else{
                        alert("Internal Server Error");
                    }
                }
            });
        });
    });
</script>
