@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<form action="{{ URL::to ('/show-KhachHang') }}">
  <button type="submit" class="btn btn-danger">Quay lại</button>
</form>
<div class="panel panel-default">
    <div class="table-agile-info">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
    <footer class="panel-footer">
      <div class="row">
        @foreach ($item as $items3)
        <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm">Tên đơn vị (Company&lsquo; name):</large>
        </div>
          <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->TenKhachHang }}</b></large>
        </div>
        <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm"> Mã số thuế (Tax code):</large>
        </div>
          <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->MST }}</b></large>
        </div>
        <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm">Địa chỉ (Address):</large>
        </div>
          <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->DiaChi }}</b></large>
        </div>
        <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm">Số điện thoại (Phone):</large>
        </div>
          <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->SDT }}</b></large>
        </div>
          @endforeach
        </div>
      </div>
    </footer>
  </div>
  <div class="panel panel-default">
    <div class="table-agile-info">
        
    <div class="panel-heading">
      Báo cáo thống kê
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="row">
          <form action="{{ route('locthongkekhachhang', ['id' => $item->first()->MaKhachHang]) }}" method="GET">
            <div class="col-md-12">
            <div class="col-sm-5 m-b-xs" style="margin-bottom: -29px;">
              <div class="xuongdong" style="display: flex">
                <div class="keben">
                    <select name="order" class="input-sm form-control w-sm inline v-middle">
                        <option value="">--lọc dữ liệu--</option>
                        <option value="q1" {{ request()->get('order') == 'q1' ? 'selected' : '' }}>Theo quý 1</option>
                        <option value="q2" {{ request()->get('order') == 'q2' ? 'selected' : '' }}>Theo quý 2</option>
                        <option value="q3" {{ request()->get('order') == 'q3' ? 'selected' : '' }}>Theo quý 3</option>
                        <option value="q4" {{ request()->get('order') == 'q4' ? 'selected' : '' }}>Theo quý 4</option>
                    </select>
                  <select name="year" class="input-sm form-control w-sm inline v-middle">
                    <option value="">--Năm--</option>
                    @php
                        $years = range(date('Y'), 2020); 
                        $selectedYear = request()->get('year');
                    @endphp
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                  <input type="submit" class="btn btn-sm btn-default1" style="margin: 0;" value="Lọc">
                </div>
              </div>
          </form> <br>   <br> 
        </div>
      </div>
      <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-eye"> </i>
                </div>
                 <div class="col-md-8 market-update-left">
                 <h4>Tổng số sản phẩm</h4>
                <h3>{{ $thhkh }}</h3>
                <p>Số lượng sản phẩm đã cung cấp cho doanh nghiệp</p>
              </div>
              <div class="clearfix "> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="col-md-8 market-update-left" style="width:100%">
                    <h4>Tổng tiền sản phẩm</h4>
                    <h3 class="price_format">{{ $tst }}</h3>
                    <p>Tiền thu lại sau khi cung cấp sản phẩm</p>
                </div>
              <div class="clearfix"> </div>
            </div>
        </div>
       <div class="clearfix"> </div>
    </div>	
        </div>
      </div>
    </footer>
  </div>
  <script type="text/javascript">
    $('.price_format').simpleMoneyFormat();
</script>
@endsection