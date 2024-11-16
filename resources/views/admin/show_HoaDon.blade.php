@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        hóa đơn đầu vào
      </div>
      <?php
          $message = Session::get('message');
          if($message){
            echo $message;
            Session::put('message',null);
          }
      ?>
      <div class="row w3-res-tb">
        <div class="row">
        <form action="{{ route('lochoadon') }}" method="GET">
          <div class="col-md-12">
          <div class="col-sm-5 m-b-xs" style="margin-bottom: -29px;">
            <div class="xuongdong" style="display: flex">
              <div class="keben">
                <select name="order" class="input-sm form-control w-sm inline v-middle" id="edit_margin">
                  <option value="">--lọc dữ liệu--</option>
                  <option value="date" {{ request()->get('order') == 'date' ? 'selected' : '' }}>Theo ngày tháng năm</option>
                  <option value="name_a_z" {{ request()->get('order') == 'name_a_z' ? 'selected' : '' }}>Theo tên nhà cung cấp</option>
                  <option value="q1" {{ request()->get('order') == 'q1' ? 'selected' : '' }}>Theo quý 1</option>
                  <option value="q2" {{ request()->get('order') == 'q2' ? 'selected' : '' }}>Theo quý 2</option>
                  <option value="q3" {{ request()->get('order') == 'q3' ? 'selected' : '' }}>Theo quý 3</option>
                  <option value="q4" {{ request()->get('order') == 'q4' ? 'selected' : '' }}>Theo quý 4</option>
              </select>
              <select name="year" class="input-sm form-control w-sm inline v-middle" id="edit_margin">
                <option value="">--Năm--</option>
                @php
                    $years = range(date('Y'), 2020); // Tạo mảng các năm từ năm hiện tại đến 2000
                    $selectedYear = request()->get('year'); // Lấy giá trị năm từ request
                @endphp
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
                <input type="submit" class="btn btn-sm btn-default1" style="margin: 0;" value="Lọc hóa đơn">
              </div>
            </div>
        </form> <br>   <br> </div>    
        </div>
      </div>
    </div>
      <div class="row">
      <form action="" class="form-inline" role="form">
        <div class="col-md-12">
        <div class="col-sm-5 m-b-xs" style="margin-bottom: -30px;">
            <div class="keben1">
              <input name="key" class="input-sm form-control" placeholder="Search" id="edit_flex">
              <button class="btn btn-sm btn-default1 " type="submit" style="margin: 0; width: 40px">Go!</button>
            </div>          
      </form> <br>   <br> 
    </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
          <br><br>
        <form class="form-inline" role="form" action="{{URL::to ('/show-importFileDauVao') }}">
          <button type="submit" class="btn btn-primary">Tải hóa đơn</button>
    </form>
      </div>
      </div>
    </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Hóa đơn</th>
              <th>Ngày lập</th>
              <th>Nhà cung cấp</th>
              <th>Tiền hàng</th>
              <th>Tiền thuế GTGT</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>File</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>  
            <tr>
              @forelse ($item as $items)
    <tr>
        <td><a style="color: red" href="{{ URL::to('/show-ChiTietHoaDon/' . $items->SHDon) }}">{{ $items->SHDon }}</a></td>
        <td>{{ date('d/m/Y', strtotime($items->NLap))  }}</td>
        <td>{{ $items->TenNCC }}</td>
          <td class="price_format">{{ $items->TongTienHang }}</td>
          <td class="price_format">{{ $items->TienThue }}</td>
          <td class="price_format">{{ $items->ThanhTienSauThue }}</td>
        <td>
            @if ($items->TrangThai == 0)
            <span style="color: red;">Chưa xử lý</span>
            @else
            <span style="color: #32CD32;">Đã xử lý</span>
            @endif
        </td>
        <td><a href="{{url('/xemfilehoadon',$items->id)}}">Xem thêm</a></td>
        {{-- <td>
          @if ($items->TrangThai == 0)
          <a href="{{ URL::to('/add-ChiTietHoaDon/' . $items->SHDon) }}" class="active styling-edit" ui-toggle-class="">
            <i class="fa fa-plus text-success text-active"></i>
        </a>
            <a href="{{ URL::to('/edit-HoaDon/' . $items->id) }}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </a>
            <a onclick="return confirm('Bạn có chắc muốn xóa nhà cung cấp này không?')" href="{{ URL::to('/delete-HoaDon/' . $items->id) }}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </a>
          @else
          @if($items->TenFileThem !=null)
          <a href="{{url('/xemfilehoadon',$items->id)}}" class="active styling-edit" ui-toggle-class="">
            <i class="fa fa-file-text text-success text-active"></i>
          </a>
          @else
          <a href="{{ URL::to('/ThongTinThem/' . $items->SHDon) }}" class="active styling-edit" ui-toggle-class="">
            <i class="fa fa-upload text-success text-active"></i>
          </a>
          @endif
          @endif
        </td> --}}
    </tr>
@empty
    <tr>
        <td colspan="4">No data found</td>
    </tr>
@endforelse
            </tr>
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-5 text-center">
          </div>
          {{ $item->appends(request()->all())->links() }}
        </div>
      </footer>
    </div>
  </div>
  <script type="text/javascript">
    $('.price_format').simpleMoneyFormat();
</script>

@endsection