@extends('layouts.layout')


@section('title')
<title>Đặt vé</title>
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
            <li class="nav-item"><a href="{{url('/ticket')}}" class="nav-link active">Đặt vé</a></li>
            <li class="nav-item"><a href="{{url('/searchticket')}}" class="nav-link">Tra cứu đặt vé</a></li>
        </ul>
    </div>
</header>
@endsection

@section('content')
<div class="container">
    <form id="bookingForm">
        <div class="row justify-content-center my-3 mx-3">
            <div id="successMessage"></div>
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="route">Tuyến</label>
                    <select name="route" id="route" class="form-control my-1">

                    </select>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="start-station">Ga lên:</label>
                    <select class="form-control my-1" id="start-station" name="start-station" required>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="end-station">Ga xuống:</label>
                    <select class="form-control my-1" id="end-station" name="end-station" required>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="quantity">Số lượng đặt:</label>
                    <input min="1" max="100" value="1" name="quantity" type="number"
                        class="form-control my-1" id="quantity" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="phone">Điện thoại:</label>
                    <input type="tel" class="form-control my-1" name="phone" id="phone" pattern="^(0\d{9}|(\+|)84\d{9})$" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="total">Thành tiền:</label><br />
                    <span class="my-1" id="total"></span>
                </div>
            </div>
            <div class="col-md-6">
                <button type="submit" class="booking btn btn-primary my-3">Đặt vé</button>
            </div>

        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        fetchticket();
        function fetchticket() {
            // load route
            $.ajax({
                type: "GET",
                url: "/fetch-routes",
                success: function(res) {
                    $('#route').html('');
                    $.each(res.routes, function(key, item) {
                        if(item.id==1) {
                            $('#route').append(
                                '<option data-min_price="'+item.min_price+'" data-station_price="'+item.station_price+'" data-total_station="'+item.total_station+'"  value="'+item.id+'" selected>'+item.route_name+'</option>'
                            );
                            $('#total').attr('data-total', item.min_price);
                            $('#total').text(item.min_price.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}));
                        }else {
                            $('#route').append(
                                '<option data-min_price="'+item.min_price+'" data-station_price="'+item.station_price+'" data-total_station="'+item.total_station+'"  value="'+item.id+'">'+item.route_name+'</option>'
                            );
                        }
                    })
                }

            });

            // load station
            $.ajax({
                type: "GET",
                url: "/get-stations/" + 1,
                success: function(res) {
                    $('#start-station').append('<option value="" disabled selected>Chọn ga lên</option>');
                    $('#end-station').append('<option value="" disabled selected>Chọn ga xuống</option>');
                    $.each(res.stations, function(key, item) {
                        $('#start-station').append( 
                            '<option value="'+item.order+'">'+item.station_name+'</option>'
                        );
                        $('#end-station').append( 
                            '<option value="'+item.order+'">'+item.station_name+'</option>'
                        );
                    })

                }
            });
        }

        $('#route').change(function(e) {
            e.preventDefault();
            var route_id = $(this).val();
            var minPrice = $('#route option:selected').data('min_price');
            var quantity = $('#quantity').val();
            var total = minPrice*quantity;
            $('#total').attr('data-total', total);
            $('#total').text(total.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}));

            // load station
            $.ajax({
                type: "GET",
                url: "/get-stations/" + route_id,
                success: function(res) {
                    $('#start-station').text('');
                     $('#end-station').text('');
                     $('#start-station').append('<option value="" disabled selected>Chọn ga lên</option>');
                    $('#end-station').append('<option value="" disabled selected>Chọn ga xuống</option>');
                    $.each(res.stations, function(key, item) {
                        $('#start-station').append( 
                            '<option value="'+item.order+'">'+item.station_name+'</option>'
                        );
                        $('#end-station').append( 
                            '<option value="'+item.order+'">'+item.station_name+'</option>'
                        );
                    })
                }
            });
        });

        $("#start-station").on("change", function(){
            var selectedVal = $(this).val();
            $("#end-station option[value='" + selectedVal + "']").remove();
        });
        $("#end-station").on("change", function(){
            var selectedVal = $(this).val();
            $("#start-station option[value='" + selectedVal + "']").remove();
        });

        // load total
        $('#start-station, #end-station, #quantity').change(function(e) {
            e.preventDefault();
            var total = 0;
            var minPrice = $('#route option:selected').data('min_price');
            var stationPrice = $('#route option:selected').data('station_price');
            var totalStations = $('#route option:selected').data('total_station');
            var quantity = $('#quantity').val();
            var startStationNumber = $('#start-station option:selected').val();
            var endStationNumber = $('#end-station option:selected').val();
            var halfTotalStations = Math.round(totalStations/2);
            if((Math.abs(startStationNumber - endStationNumber) + 1) <= halfTotalStations) {
                total = minPrice * quantity;
            }else {
                total = (minPrice +((Math.abs(startStationNumber - endStationNumber) + 1) - halfTotalStations) * stationPrice) * quantity;
            }
            $('#total').attr('data-total', total);
            $('#total').text(total.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}));
        });

        $('#bookingForm').submit(function(e) {
            e.preventDefault();
            var data = {
                'route_name': $('#route option:selected').text(),
                'start_station': $('#start-station option:selected').text(),
                'end_station': $('#end-station option:selected').text(),
                'quantity': $('#quantity').val(),
                'phone': $('#phone').val(),
                'total': $('#total').data('total'),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/tikets",
                data: data,
                dataType: "json",
                success: function(res) {
                    $('#successMessage').addClass('alert alert-success');
                    $('#successMessage').css('color', 'green');
                    $('#successMessage').text(res.message);
                },
                error: function(res) {
                    console.log(res);
                }
            });
        })

    });
</script>
@endsection