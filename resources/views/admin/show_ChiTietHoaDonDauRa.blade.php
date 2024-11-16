@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<div class="table-agile-info">
  <form action="{{ URL::to ('/show-HoaDonDauRa') }}">
    <button type="submit" class="btn btn-danger">Quay lại</button>
</form>
  <div class="panel panel-default">
    @foreach ($item4 as $items4)
    <div class="panel-heading">
      {{ $items4->Ten }}
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="text-center text-center-xs">
          <p> <b>{{ $items4->DChi }}</b></p>
        </div>
        <div class="text-center text-center-xs">
          <p>Liên hệ: <b>{{ $items4->SDThoai }}</b></p>
        </div>
        <div class="text-center text-center-xs">
            <p><b>{{ $items4->DCTDTu }}</b></p>
          </div>
          @endforeach
      </div>
    </footer>
  </div>
<div class="panel panel-default">
  @foreach ($item2 as $items2)
  <div class="panel-heading">
    {{ $items2->TenHoaDon }}
  </div>
  <footer class="panel-footer">
    <div class="row">
        <div class="text-center text-center-xs">
            <p>Thời gian <b>{{ date('d/m/Y', strtotime($items2->NLap))  }}</b></p>
          </div>
          <div class="text-center text-center-xs">
            <p>Số hóa đơn <b>{{ $items2->SoHoaDon }}</b></p>
          </div>      
        @endforeach
        @foreach ($item3 as $items3)
      <div class="text-center text-center-xs">
        <p>Tên khách hàng: <b>{{ $items3->TenKhachHang }}</b></p>
      </div>
        @endforeach
    </div>
  </footer>
</div>
  <div class="panel panel-default">
    <div class="row w3-res-tb">
      <form method="GET">
        <div class="col-sm-5 m-b-xs">
        <select name="sort" id="sort" class="input-sm form-control w-sm inline v-middle">
          <option>--lọc dữ liệu--</option>
          <option value="{{ Request::url() }}?sort_by=TenCTHD_A_Z">Theo tên sản phẩm A-Z</option>
          <option value="{{ Request::url() }}?sort_by=TongTH">Tiền hàng từ lớn đến bé</option>
          <option value="{{ Request::url() }}?sort_by=TTST">Thành tiền sau thuế từ lớn đến bé</option>
        </select>
</form>                  
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <form action="" class="form-inline" role="form">
            <div class="input-group">
              <input name="key" class="input-sm form-control" placeholder="Search">
              <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="submit">Go!</button>
            </span>
          </div>
          </form>
          @foreach ($item2 as $HD)
          <form action="{{ URL::to('/add-ChiTietHoaDonDauRa/' . $HD->SoHoaDon) }}">
            <button type="submit" class="btn btn-success">Thêm mới</button>
      </form>
          @endforeach
        </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          {{-- <form action="{{ url('/print-bill'.$items->SHDon) }}">
            <button type="submit" class="btn btn-primary">In hóa đơn</button>
      </form> --}}
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên hàng hóa</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền hàng</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @php
            $total = 0;
            @endphp
            @forelse ($item as $items)
            @php
                $total += $items->ThanhTien;
            @endphp
                      <tr>
                          <td>{{ $items->TenHangHoa }}</td>
                          <td class="price_format">{{ $items->DonGia }}</td>
                          <td>{{ $items->SoLuong }}</td>
                          <td class="price_format">{{ $items->ThanhTien }}</td>
                          <td>
                            @foreach($item2 as $items2)
                            @if($items2->TrangThai == 1)
                            @else
                              <a href="{{URL::to ('/edit-ChiTietHoaDonDauRa/'.$items->id) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                              </a>
                              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="{{URL::to ('/delete-ChiTietHoaDonDauRa/'.$items->id) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                              </a>
                            @endif
                            @endforeach  
                            </td>
                  @empty
                      <tr>
                          <td colspan="4">No data found</td>
                      </tr>
                  @endforelse
          </tr>
        </tbody>
      </table>
    </div>
<br>
            @php
            $total = 0;
            @endphp
            @foreach ($item as $items)
            @php
                $total += $items->ThanhTien;
            @endphp
                  @endforeach
                          <div class="row text-center">
                            <div class="col-sm-5">
                                <large class="text-muted inline m-t-sm m-b-sm">Tổng số tiền là: </large>
                              </div>
                            <div class="col-sm-5">
                              <large class="text-muted inline m-t-sm m-b-sm " ><b class="price_format">{{ $total }}</b></large>
                            </div>
                            <div class="col-sm-5">
                                <large class="text-muted inline m-t-sm m-b-sm"></large>
                              </div>
                          </div>        
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <large class="text-muted inline m-t-sm m-b-sm">
          </large>
        </div>
        {{-- <div class="col-sm-7 text-right text-center-xs">                
          <a class="btn btn-primary" target="_blank" href="{{ url('/print-bill/'.$items->SoHD) }}">In hóa đơn</a>
        </div> --}}
        <div class="col-sm-7 text-right text-center-xs">   
          @foreach ($item2 as $items2)
            @if ($items2->TrangThai == 1)
            @else
              <a class="btn btn-success" onclick="return confirm('Bạn có chắc muốn xử lý hóa đơn này không?')" href="{{ url('/XuLy-HoaDonDauRa/'.$items->SoHoaDon) }}">Xử lý đơn hàng</a>
            @endif
          @endforeach
        </div>
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">
  $('.price_format').simpleMoneyFormat();
</script>
@endsection