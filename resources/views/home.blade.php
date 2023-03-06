@extends('layouts.layout')

@section('title')
<title>Trang chủ</title>
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
            <li class="nav-item"><a href="{{url('/')}}" class="nav-link active">Trang chủ</a></li>
            <li class="nav-item"><a href="{{url('/ticket')}}" class="nav-link">Đặt vé</a></li>
            <li class="nav-item"><a href="{{url('/searchticket')}}" class="nav-link">Tra cứu đặt vé</a></li>
        </ul>
    </div>
</header>
@endsection
@section('content')
<div class="wrapper">
    <div class="container-fluid py-5">
        <div class="main border border-2 rounded">
            <div class="p-3">
                <span class="title"></span>
                <div style="display: none" class="loader">
                    <div class="spinner"></div>
                </div>
                <div class="content">
                    
                </div>
            </div>
            <div class="info bg-light gap-2 py-3 text-white border-top">
                <div class="py-1 px-2 rounded-pill bg-secondary">
                    <i class="fa-solid fa-clock"></i>
                    <span class="routeTime"></span>
                </div>
                <div class="py-1 px-2 rounded-pill bg-secondary">
                    <i class="fa-solid fa-arrows-left-right-to-line"></i>
                    <span class="routeLength"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // load ga
        fetchstations();
        function fetchstations(){
            $('.loader').show();
            const route_id = 1;
            $.ajax({
                type: "GET",
                url: "/get-route/" + route_id,
                success: function(res) {
                    var time = res.route.start_time.substring(0,5) + ' - ' + res.route.end_time.substring(0,5);
                    $('.title').text(res.route.route_name);
                    $('.routeTime').text(time);
                    $('.routeLength').text(res.route.route_length + 'km');
                }
            });
            $.ajax({
                type: "GET",
                url: "/get-stations/" + route_id,
                success: function(res) {
                    $.each(res.stations, function(key, item) {
                        $.ajax({
                            type: "GET",
                            url: "/get-tooltips",
                            data: {stationName: item.station_name},
                            success: function(res) {
                                var chuoi = 'Tuyến';
                                $.each(res.tooltips, function(tkey, titem) {
                                    chuoi += ' ' + '<span>'+titem.route_id+'</span>'
                                });
                                if(res.tooltips.length==1) {
                                    $('#tooltip' + key).addClass('short');
                                }
                                $('#tooltip' + key).append(chuoi);
                            },
                            error: function(res){
                                console.log(res);
                            }
                        });
                        if(key==0) {
                            $('.content').append(
                                '<input type="radio" name="place" id="'+item.order+'" checked>\
                                 <div class="process">\
                                    <label for="'+item.order+'" class="placeName">'+item.station_name+'</label>\
                                    <label for="'+item.order+'" class="line"><span class="tooltips" id="tooltip' + key + '"></span></label>\
                                </div>'
                            )
                        }else {
                            $('.content').append(
                                '<input type="radio" name="place" id="'+item.order+'">\
                                 <div class="process">\
                                    <label for="'+item.order+'" class="placeName">'+item.station_name+'</label>\
                                    <label for="'+item.order+'" class="line"><span class="tooltips" id="tooltip' + key + '"></span></label>\
                                </div>'
                            )
                        }

                    });
                    $('.loader').hide();
                },
                error: function(res) {
                    console.log(res)
                }
            });
        }
    });
</script>
@endsection