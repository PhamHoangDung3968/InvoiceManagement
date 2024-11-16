@extends('admin_layout')
@section('admin_content')
<div class="market-updates">
    <div class="row">
        <h1 class="text-center">Thống kê hóa đơn đầu vào</h1><br>
    </div>
    @php
        $totalKH = 0;
    @endphp
    @foreach ($DoanhNghiep as $KH)
        @php
            $totalKH += 1;
        @endphp
    @endforeach
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-2">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-eye"> </i>
            </div>
             <div class="col-md-8 market-update-left">
             <h4>Doanh nghiệp</h4>
            <h3>{{ $totalKH }}</h3>
            <p>Người mua các sản phẩm từ nhà cung cấp</p>
          </div>
          <div class="clearfix "> </div>
        </div>
    </div>
    @php
        $totalNCC = 0;
    @endphp
    @foreach ($NhaCungCap as $NCC)
        @php
            $totalNCC += 1;
        @endphp
    @endforeach
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-1">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-users" ></i>
            </div>
            <div class="col-md-8 market-update-left">
            <h4>Nhà cung cấp</h4>
                <h3>{{ $totalNCC }}</h3>
                <p>Người cung cấp các sản phẩm/mặt hàng</p>
            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    @php
        $totalHH = 0;
    @endphp
    @foreach ($HangHoa as $HH)
        @php
            $totalHH += 1;
        @endphp
    @endforeach
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-3">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-usd"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Hàng hóa</h4>
                <h3>{{ $totalHH }}</h3>
                <p>Tổng số lượng hàng hóa có trên hệ thống</p>
            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    @php
        $totalHD = 0;
    @endphp
    @foreach ($HoaDon as $HD)
        @php
            $totalHD += 1;
        @endphp
    @endforeach
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-4">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Hóa đơn</h4>
                <h3>{{ $totalHD }}</h3>
                <p>Tổng số lượng hóa đơn hiện tại</p>
            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
   <div class="clearfix"> </div>
</div>	
<hr>
<div class="market-updates">
    <div class="row">
        <h1 class="text-center">Thống kê hóa đơn đầu ra</h1><br>
    </div>
    @php
        $totalKH = 0;
    @endphp
    @foreach ($KhachHang as $KH)
        @php
            $totalKH += 1;
        @endphp
    @endforeach
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-2">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-eye"> </i>
            </div>
             <div class="col-md-8 market-update-left">
             <h4>Khách hàng</h4>
            <h3>{{ $totalKH }}</h3>
            <p>Người mua các sản phẩm</p>
          </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    @php
        $totalHD = 0;
    @endphp
    @foreach ($HoaDon as $HD)
        @php
            $totalHD += 1;
        @endphp
    @endforeach
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-1">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-shopping-cart" ></i>
            </div>
            <div class="col-md-8 market-update-left">
            <h4>Hóa đơn</h4>
                <h3>{{ $totalHD }}</h3>
                <p>Tổng số lượng hóa đơn hiện tại</p>
            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    @php
        $totalHHDN = 0;
    @endphp
    @foreach ($HangHoaDoanhNghiep as $HH)
        @php
            $totalHHDN += 1;
        @endphp
    @endforeach
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-3">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-usd"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Hàng hóa</h4>
                <h3>{{ $totalHHDN }}</h3>
                <p>Số lượng hàng hóa của doanh nghiệp</p>
            </div>
          <div class="clearfix"> </div>
        </div>
    </div>
   <div class="clearfix"> </div>
</div>	
<style type="text/css">
    p.title_thongke{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
</style>
@endsection