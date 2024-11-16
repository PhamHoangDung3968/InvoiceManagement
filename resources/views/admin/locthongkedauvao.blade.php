@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<form action="{{ URL::to ('/add-DoanhNghiep') }}">
  <button type="submit" class="btn btn-danger">Quay lại</button>
</form>
<div class="panel panel-default">
    <div class="table-agile-info">
    <div class="panel-heading">
      Thông tin doanh nghiệp
    </div>
    <footer class="panel-footer">
      <div class="row">
        @foreach ($item3 as $items3)
        <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm">Tên đơn vị (Company&lsquo; name):</large>
        </div>
          <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->Ten }}</b></large>
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
          <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->DChi }}</b></large>
        </div>
        <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm">Số điện thoại (Phone):</large>
        </div>
          <div class="col-sm-5">
          <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->SDThoai }}</b></large>
        </div>
          @endforeach
        </div>
      </div>
    </footer>
  </div>
  <div class="panel panel-default">
    <div class="table-agile-info">     
      <div class="panel-heading">
        Thống kê đầu vào
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="row">
            <form action="{{ route('locthongkedauvao', ['id' => $item3->first()->id]) }}" method="GET">
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
                   <h4>Tổng số lượng nhập</h4>
                  <h3>{{ $tsl }}</h3>
                  <p>Số lượng sản phẩm nhập từ các nhà cung cấp</p>
                </div>
                <div class="clearfix "> </div>
              </div>
          </div>
          <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-1">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-users" ></i>
                </div>
                <div class="col-md-8 market-update-left">
                <h4>Số lượng nhà cung cấp</h4>
                    <h3>{{ $slncc }}</h3>
                    <p>Cung cấp sản phẩm của công ty bán cho doanh nghiệp</p>
                </div>
              <div class="clearfix"> </div>
            </div>
        </div>
          <div class="col-md-3 market-update-gd">
              <div class="market-update-block clr-block-3">
                  <div class="col-md-4 market-update-right">
                      <i class="fa fa-usd"></i>
                  </div>
                  <div class="col-md-8 market-update-left" style="width:100%">
                      <h4>Tổng tiền đầu vào</h4>
                      <h3 class="price_format">{{ $item }}</h3>
                      <p>Tiền vốn bỏ ra để mua các sản phẩm</p>
                  </div>
                <div class="clearfix"> </div>
              </div>
          </div>
          <div class="col-md-3 market-update-gd">
              <div class="market-update-block clr-block-4">
                  <div class="col-md-4 market-update-right">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-8 market-update-left">
                      <h4>Số lượng hóa đơn vào</h4>
                      <h3>{{ $tshddv }}</h3>
                      <p>Tổng số lượng hóa đơn hiện tại mà doanh nghiệp đang sở hữu</p>
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
  </div>
  <div class="panel panel-default">
    <div class="table-agile-info">
    <div class="panel-heading">
      Thống kê đầu ra
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="row">
          <form action="{{ route('locthongkedauvao', ['id' => $item3->first()->id]) }}" method="GET">
            <div class="col-md-12">
            <div class="col-sm-5 m-b-xs" style="margin-bottom: -29px;">
              <div class="xuongdong" style="display: flex">
                <div class="keben">
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
                 <h4>Tổng số lượng đã bán ra</h4>
                <h3>{{ $soluongdaura }}</h3>
                <p>Số lượng sản phẩm bán ra từ doanh nghiệp</p>
              </div>
              <div class="clearfix "> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
          <div class="market-update-block clr-block-1">
              <div class="col-md-4 market-update-right">
                  <i class="fa fa-users" ></i>
              </div>
              <div class="col-md-8 market-update-left">
              <h4>Số lượng khách hàng</h4>
                  <h3>{{ $soluongkhachhang }}</h3>
                  <p>Người mua sản phẩm của doanh nghiệp</p>
              </div>
            <div class="clearfix"> </div>
          </div>
      </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="col-md-8 market-update-left" style="width:100%">
                    <h4>Tổng tiền đầu ra</h4>
                    <h3 class="price_format">{{ $sotiendaura }}</h3>
                    <p>Tiền thu lại sau khi bán sản phẩm</p>
                </div>
              <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Số lượng hóa đơn vào</h4>
                    <h3>{{ $sohoadondaura }}</h3>
                    <p>Số lượng hóa đơn doanh nghiệp sở hữu</p>
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
<div class="agil-info-calendar">
    <!-- calendar -->
    <div class="col-md-6 agile-calendar">
        <div class="calendar-widget">
            <div class="panel-heading ui-sortable-handle">
                <span class="panel-icon">
                  <i class="fa fa-money"></i>
                </span>
                <span class="panel-title"> pie chart statistics</span>
            </div>
            <!-- grids -->
                <div class="agile-calendar-grid">
                    <div class="page">
                        <div class="w3l-calendar-left">
                            <div class="calendar-heading">
                                <div id="donut"></div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- //calendar -->
    <div class="col-md-6 agile-calendar">
        <div class="calendar-widget">
            <div class="panel-heading ui-sortable-handle">
                <span class="panel-icon">
                  <i class="fa fa-star"></i>
                </span>
                <span class="panel-title">statistics</span>
            </div>
            <!-- grids -->
                <div class="agile-calendar-grid">
                    <div class="page">
                        
                        <div class="w3l-calendar-left">
                            <div class="calendar-heading">
                                <div class="market-updates">
                    
                    
                                    <div class="market-update-gd">
                                        <div class="market-update-block" style="background-color: yellow">
                                            <div class="col-md-4 market-update-right">
                                                <i style="color: black" class="fa fa-usd"> </i>
                                            </div>
                                             <div class="col-md-8 market-update-left">
                                             <h4 style="color: black">Số đã bán hiện tại</h4>
                                            <h3 style="color: black" class="price_format">{{ $demLai }}</h3>
                                            <p style="color: black">Số tiền mà doanh nghiệp thu về sau khi bán sản phẩm</p>
                                          </div>
                                          <div class="clearfix "> </div>
                                        </div>
                                    </div>
                                <div class="market-updates">
                                    <div class="market-update-gd">
                                        <div class="market-update-block clr-block-2">
                                            <div class="col-md-4 market-update-right">
                                                <i class="fa fa-usd"> </i>
                                            </div>
                                             <div class="col-md-8 market-update-left">
                                             <h4>Số tiền chi</h4>
                                            <h3 class="price_format">{{ $demNo }}</h3>
                                            <p>Số tiền mà doanh nghiệp đã chi ra để nhập sản phẩm</p>
                                          </div>
                                          <div class="clearfix "> </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
        </div>
    </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('.price_format').simpleMoneyFormat();
</script>
<script type="text/javascript">
    var colorDanger = "#FF1744";
    Morris.Donut({
    element: 'donut',
    resize: true,
    colors: [
        '#FF0000',
        '#00FF7F'
    ],
    //labelColor:"#cccccc", // text color
    //backgroundColor: '#333333', // border color
    data: [
        {label:"Số tiền vốn", value:<?php echo $demVon    ?>},
        {label:"Số tiền lãi", value:<?php echo $demLai    ?>},
    ]
  });
</script>
@endsection