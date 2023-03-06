@extends('layouts.layout')

@section('title')
<title>Tra cứu đặt vé</title>
@endsection


@section('header')
<header class="navbar navbar-expand-md navbar-light bg-light px-3">
    <a href="{{url('/')}}" class="navbar-brand">
        <img src="{{ asset('assets/imgs/logo.png') }}" alt="logo" height="50">
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="{{url('/')}}" class="nav-link">Trang chủ</a></li>
            <li class="nav-item"><a href="{{url('/ticket')}}" class="nav-link">Đặt vé</a></li>
            <li class="nav-item"><a href="{{url('/searchticket')}}" class="nav-link active">Tra cứu đặt vé</a></li>
        </ul>
    </div>
</header>
@endsection


@section('content')
<div class="container my-5">
    <div class="form-inline mb-3 search-box">
        <form id="searchForm">
            <input type="text" id="phone" name="phone" class="form-control form-control-sm mr-2"
                placeholder="Số điện thoại" required pattern="^(0\d{9}|(\+|)84\d{9})$" /><br>
            <button style="outline: none" class="btn btn-sm" type="submit">
                <i class="fa-solid fa-search" style="font-size: 25px"></i>
            </button>
        </form>
    </div>

    <div class="table-responsive text-center">
        <h4 class="displayNone" id="messageChecking">Không tìm thấy thông tin đặt vé !</h4>
        <table class="displayNone" id="checkingTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Thời gian đặt</th>
                    <th>Tuyến</th>
                    <th>Ga lên</th>
                    <th>Ga xuống</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody class="tbody_bookings">
              
            </tbody>
        </table>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(e) {
            e.preventDefault();
            var phone = $('#phone').val();
            $.ajax({
                type: "GET",
                url: "/get-tikets/" + phone,
                success: function(res) {
                    if(res.tickets.length==0) {
                        $('#checkingTable').addClass('displayNone');
                        $('#messageChecking').removeClass('displayNone');
                    }else {
                        $('#messageChecking').addClass('displayNone');
                        $('#checkingTable').removeClass('displayNone');
                        $('.tbody_bookings').html('');
                        $.each(res.tickets, function(key, item) {
                            $('.tbody_bookings').append(
                                '<tr>\
                                    <td>'+item.id+'</td>\
                                    <td>'+item.time+'</td>\
                                    <td>'+item.route_name+'</td>\
                                    <td>'+item.start_station+'</td>\
                                    <td>'+item.end_station+'</td>\
                                    <td>'+item.quantity+'</td>\
                                    <td>'+item.total.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'})+'</td>\
                                </tr>'
                            );
    
                        });
                    }
                }
            });
        })
    });
</script>
@endsection