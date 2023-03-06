<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    @yield('header')
    @yield('content')
    @include('layouts.footer')
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('assets/jquery-3.6.3.min.js')}}"></script>
    @yield('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "/fetch-routes",
                success: function(res) {
                    $.each(res.routes, function(key, item) {
                        var time = item.start_time.substring(0,5) + ' - ' + item.end_time.substring(0,5);
                        $('.tbody_route').append(
                            '<tr>\
                                <td class="route_name" data-id="'+item.id+'">'+item.route_name+'</td>\
                                <td>'+time+'</td>\
                                <td>'+item.route_length+'km</td>\
                                <td>'+item.min_price.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'})+'</td>\
                                <td>'+item.station_price.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'})+'</td>\
                            </tr>'
                        );
                    });
                }
            });
            $(document).on('click', '.route_name', function(e) {
                e.preventDefault();
                $('.loader').show();
                var route_id = $(this).data('id');
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
                        $('.content').html('');
                        $.each(res.stations, function(key, item) {
                            $.ajax({
                                type: "GET",
                                url: "get-tooltips",
                                data: {stationName: item.station_name},
                                dataType: "json",
                                success: function(res) {
                                    var chuoi = 'Tuyến';
                                    $.each(res.tooltips, function(tkey, titem) {
                                        chuoi+=' <span>'+titem.route_id+'</span>'
                                    });
                                    if(res.tooltips.length==1){
                                        $('#tooltip'+key).addClass('short');
                                    }
                                    $('#tooltip'+key).append(chuoi);
                                }
                            });
                            if(route_id==5){
                                if(key==0){
                                    $('.content').append(
                                        '<input type="radio" name="place" id="'+item.order+'" checked>\
                                        <div class="process">\
                                            <label for="'+item.order+'" class="placeName">'+item.station_name+'</label>\
                                            <label for="'+item.order+'" class="line short"><span class="tooltips" id="tooltip' + key + '"></span></label>\
                                        </div>'
                                    )
                                }else {
                                    $('.content').append(
                                        '<input type="radio" name="place" id="'+item.order+'">\
                                        <div class="process">\
                                            <label for="'+item.order+'" class="placeName">'+item.station_name+'</label>\
                                            <label for="'+item.order+'" class="line short"><span class="tooltips" id="tooltip' + key + '"></span></label>\
                                        </div>'
                                    )
                                }
                            }else {
                                if(key==0){
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
                            }
                        })
                        $('.loader').hide();
                    }
                })
            });
        });
    </script>
</body>
</html>