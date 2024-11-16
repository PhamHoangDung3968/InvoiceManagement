@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="panel panel-default">
  <div class="panel-heading">
    Thông tin doanh nghiệp
  </div>
  <footer class="panel-footer">
    <div class="row">
      @foreach ($item as $items)
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Tên đơn vị (Company&lsquo; name):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items->Ten }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"> Mã số thuế (Tax code):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items->MST }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Địa chỉ (Address):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items->DChi }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Số điện thoại (Phone):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items->SDThoai }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Số tài khoản (Account No):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items->DCTDTu }}</b></large>
      </div>
        @endforeach
      </div>
      <br>
      <div class="row">
        <div class="panel-body">
            <div class="position-center ">
                <div class="text-center">
                    <a href="{{URL::to ('/edit-DoanhNghiep/'.$items->id) }}" data-toggle="modal" class="btn btn-success">
                        Chỉnh sửa thông tin
                    </a>
                    <a href="{{ URL::to('/show-HangHoaDoanhNghiep/' . $items->id) }}" data-toggle="modal" class="btn btn-warning">
                        Xem hàng hóa
                    </a>
                    {{-- <a href="{{ URL::to('/thongkedoanhthu/' . $items->id) }}" data-toggle="modal" class="btn btn-danger">
                        Thống kê
                    </a> --}}
            </div>
      </div>
@endsection