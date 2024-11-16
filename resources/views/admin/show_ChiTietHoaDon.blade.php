@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<div class="table-agile-info">
  <form action="{{ URL::to ('/show-HoaDon') }}">
    <button type="submit" class="btn btn-danger">Quay lại</button>
</form>
<br>
@foreach($item2 as $items2)
<div class="text-right">
</div>
@endforeach
<div class="panel panel-default">
  @foreach ($item2 as $items2)
  <div class="panel-heading">
    {{ $items2->THDon }}
  </div>
  <footer class="panel-footer">
    <div class="row">
      <div class="text-center text-center-xs">
        <p>Thời gian <b>{{ date('d/m/Y', strtotime($items2->NLap))  }}</b></p>
      </div>
      <div class="text-center text-center-xs">
        <p>(BẢN THỂ HIỆN CỦA HÓA ĐƠN ĐIỆN TỬ)</p>
      </div>
      <div class="text-center text-center-xs">
        <p>Số hóa đơn: <b>{{ $items2->SHDon }}</b></p>
      </div>
      <div class="text-center text-center-xs">
        <p>Mã cơ quan thuế: <b>{{ $items2->MaThamChieu }}</b></p>
      </div>
        @endforeach
    </div>
  </footer>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    Thông tin nhà cung cấp
  </div>
  <footer class="panel-footer">
    <div class="row">
      @foreach ($item4 as $items4)
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Đơn vị bán hàng (Seller):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items4->Ten }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Mã số thuế (Tax code):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items4->MST }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Địa chỉ (Address):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items4->DChi }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Email:</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items4->DCTDTu }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Số điện thoại (Phone):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items4->SDThoai }}</b></large>
      </div>
        @endforeach
    </div>
  </footer>
</div>
<div class="panel panel-default">
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
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Số tài khoản (Account No):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>***</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Hình thức thanh toán (Method of Payment):</large>
      </div>
        <div class="col-sm-5">
          @foreach($item2 as $items2)
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items2->PTTT }}</b></large>
        @endforeach
      </div>
        @endforeach
      </div>
    </div>
  </footer>
</div>
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách chi tiết hóa đơn
    </div>
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
            <th>Chiết khấu</th>
            <th>Giá trước thuế GTGT</th>
            <th>Thuế suất</th>
            <th>Tiền thuế GTGT</th>
            <th>Thành tiền sau thuế</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @php
            $total = 0;
            $Amount = 0;
            $vat = 0;
            $AmountWithVat = 0;
            @endphp
            @forelse ($item as $items)
            @php
                $total += $items->ThanhTien;
                $Amount += $items->GiaTruocThueGTGT;
                $vat += $items->TienThueGTGT;
                $AmountWithVat += $items->ThanhTienSauThue;
            @endphp
                      <tr>
                          <td>{{ $items->TenHH }}</td>
                          <td class="price_format">{{ $items->DonGia }}</td>
                          <td>{{ $items->SoLuong }}</td>
                          <td class="price_format">{{ $items->ThanhTien }}</td>
                          <td>{{ $items->ChietKhau }}</td>
                          <td class="price_format">{{ $items->GiaTruocThueGTGT }}</td>
                          <td>{{ $items->ThueSuat }}</td>
                          <td class="price_format">{{ $items->TienThueGTGT }}</td>
                          <td class="price_format">{{ $items->ThanhTienSauThue }}</td>
                          <td>
                            @foreach ($item2 as $items2)
                                @if ($items2->TrangThai == 1)
                                @else
                              <a href="{{URL::to ('/edit-ChiTietHoaDon/'.$items->id) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                              </a>
                              <a onclick="return confirm('Bạn có chắc muốn xóa nhà cung cấp này không?')" href="{{URL::to ('/delete-ChiTietHoaDon/'.$items->id) }}" class="active styling-edit" ui-toggle-class="">
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
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tổng số tiền hàng</th>
            <th>Giá trước thuế GTGT</th>
            <th>Tiền thuế GTGT</th>
            <th>Thành tiền sau thuế</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @php
            $total = 0;
            $Amount = 0;
            $vat = 0;
            $AmountWithVat = 0;
            @endphp
            @foreach ($item as $items)
            @php
                $total += $items->ThanhTien;
                $Amount += $items->GiaTruocThueGTGT;
                $vat += $items->TienThueGTGT;
                $AmountWithVat += $items->ThanhTienSauThue;
            @endphp
                  @endforeach
                  <tr>
                    <td class="price_format">{{ $total }}</td>
                    <td class="price_format">{{ $Amount }}</td>
                    <td class="price_format">{{ $vat }}</td>
                    <td class="price_format">{{ $AmountWithVat }}</td>
          </tr>
        </tbody>
      </table>
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
            <a class="btn btn-success" onclick="return confirm('Bạn có chắc muốn xử lý hóa đơn này không?')" href="{{ url('/XuLy-HoaDon/'.$items->SoHD) }}">Xử lý đơn hàng</a>
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