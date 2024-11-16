<?php
namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class OutputInvoiceController extends Controller
{
    //Bảo mật admin
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    //hàng hóa của doanh nghiệp
    public function XuLy_HoaDon($SoHD){
        $this-> AuthLogin();
        $soHD = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->first();
        $tienhang = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->sum(DB::raw('DonGia * SoLuong'));
        $tienhang2 = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->sum(DB::raw('((DonGia * SoLuong)-ChietKhau)+(((DonGia * SoLuong)-ChietKhau)*(ThueSuat/100))'));
        $tienhang3 = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->sum(DB::raw('(((DonGia * SoLuong)-ChietKhau)*(ThueSuat/100))'));
            if ($soHD) {
            $TrangThai = '1';
            $data = [
                'TrangThai' => $TrangThai,
                'TongTienHang' =>$tienhang,
                'ThanhTienSauThue' =>$tienhang2,
                'TienThue' => $tienhang3
            ];
            $soHD1 = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->value("MaDN_id");
            $von = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->sum(DB::raw('((DonGia * SoLuong)-ChietKhau)+(((DonGia * SoLuong)-ChietKhau)*(ThueSuat/100))'));
            $data3 = [
                'Ma_DoanhNghiep' => $soHD1,
                'TongVon' => $von,
                'TongLoi' =>0
            ];

            $nlap = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->value("NLap");
            $soluongdauvao = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->sum(DB::raw('SoLuong'));
            $data4 = [
                'Ma_DoanhNghiep' => $soHD1,
                'NLap' => $nlap,
                'SoLuong' =>$soluongdauvao,
                'SoTien' => $tienhang2,
            ];
            $nlap = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->value("NLap");
            $hdmancc = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->value("TenNCC");
            $mancc = DB::table('tbl_nhacungcap')->where('Ten', $hdmancc)->value("id");
            $data5 = [
                'Ma_NhaCungCap'=> $mancc,
                'NLap' => $nlap,
                'SoTien'=> $tienhang2
            ];
            $hanghoa = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->get();
            $data2 = [];
            foreach ($hanghoa as $item) {
                $ten = $item->TenHH;
                $giaban = $item->DonGia;
                $dvt = $item->MaHH_id;
                $dvt2 = DB::table('tbl_hanghoa')->where('MaHangHoa', $dvt)->value('DVT');
                $doanhnghiep = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->value('MaDN_id');
                $soluongdanhap = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->value('SoLuong');
                $soluong = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->value('SoLuong');  
                $existingItem = DB::table('tbl_hanghoadoanhnghiep')
                    ->where('TenHangHoa', $ten)
                    ->where('Ma_DoanhNghiep', $doanhnghiep)
                    ->first();
                if ($existingItem) {
                    DB::table('tbl_hanghoadoanhnghiep')
                        ->where('TenHangHoa', $ten)
                        ->where('Ma_DoanhNghiep', $doanhnghiep)
                        ->increment('SoLuongHienTai', $soluong);
                    DB::table('tbl_hanghoadoanhnghiep')
                        ->where('TenHangHoa', $ten)
                        ->where('Ma_DoanhNghiep', $doanhnghiep)
                        ->increment('SoLuongDaNhap', $soluongdanhap);
                } else {
                    $data2[] = [
                        'TenHangHoa' => $ten,
                        'GiaBan' => $giaban,
                        'SoTienThayDoi' => $giaban,
                        'DVT' => $dvt2,
                        'Ma_DoanhNghiep' => $doanhnghiep,
                        'SoLuongHienTai' => $soluong,
                        'SoLuongDaNhap' => $soluongdanhap,
                        'SoLuongDaBan' => '0'
                    ];
                }
            }
            DB::table('tbl_hoadon')->where('SHDon', $SoHD)->update($data);
            DB::table('tbl_hanghoadoanhnghiep')->insert($data2);
            DB::table("tbl_thongkedauvao")->insert($data4);
            DB::table("tbl_thongkenhacungcap")->insert($data5);
            DB::table('tbl_thongke')->insert($data3);
            return Redirect::to('show-HoaDon');
        }
    }

    public function listHangHoaDoanhNghiep($id){
        $this-> AuthLogin();
        $TTV = DB::table('tbl_hanghoadoanhnghiep')->sum(DB::raw("GiaBan * SoLuongDaNhap"));
        $item3 = DB::table('tbl_doanhnghiep')->where('id', $id)->get();  
        $query = DB::table('tbl_hanghoadoanhnghiep');
        if ($key = request()->key) {
            $query->where('TenHangHoa', 'like', '%' . $key . '%')
                ->orWhere('GiaBan', 'like', '%' . $key . '%')
                ->orWhere('DVT', 'like', '%' . $key . '%')
                ->orWhere('Ma_DoanhNghiep', 'like', '%' . $key . '%')->paginate(10);
        }
        $item = $query->where('Ma_DoanhNghiep',$id)->paginate(10);
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='TenHH_A_Z'){
                $HangHoa = DB::table('tbl_hanghoadoanhnghiep')->orderBy('TenHangHoa','ASC')->paginate(10)->appends(request()->query());
                $item = $HangHoa;
            }   
            elseif($sort_by=='GiaTien'){
                $HangHoa = DB::table('tbl_hanghoadoanhnghiep')->orderBy('GiaBan','DESC')->paginate(10)->appends(request()->query());
                $item = $HangHoa;
            }
        }
        return view('admin.show_HangHoaDoanhNghiep',  compact('item','item3','TTV'));
    }
    
    public function edit_GiaHangHoaDoanhNghiep($HangHoa_id){
        $this-> AuthLogin();
        $Doanh_Nghiep = DB::table('tbl_doanhnghiep')->orderBy('id','desc')->get();
        $item = DB::table('tbl_hanghoadoanhnghiep')->where('MaHangHoa',$HangHoa_id)->get();
        return view('admin.edit_GiaHangHoaDoanhNghiep',  compact('item','Doanh_Nghiep'));
    }

    public function update_GiaHangHoaDoanhNghiep(Request $request, $HangHoa_id)
    {
        $GiaBan_HangHoa = filter_var($request->GiaBan_HangHoa, FILTER_SANITIZE_NUMBER_INT);
        $data = [
            'SoTienThayDoi' => $GiaBan_HangHoa,
            'TrangThai' => '1',
        ];
        DB::table('tbl_hanghoadoanhnghiep')->where('MaHangHoa', $HangHoa_id)->update($data);
        Session::put('message', 'Cập nhật hàng hóa thành công!');
        return redirect()->back();
    }

    public function edit_HangHoaDoanhNghiep($HangHoa_id){
        $this-> AuthLogin();
        $Doanh_Nghiep = DB::table('tbl_doanhnghiep')->orderBy('id','desc')->get();
        $item = DB::table('tbl_hanghoadoanhnghiep')->where('MaHangHoa',$HangHoa_id)->get();
        return view('admin.edit_HangHoaDoanhNghiep',  compact('item','Doanh_Nghiep'));
    }

    public function update_HangHoaDoanhNghiep(Request $request, $HangHoa_id)
    {
        $this-> AuthLogin();
        $duplicateMST = DB::table('tbl_hanghoadoanhnghiep')
            ->where('TenHangHoa', $request->Ten_HangHoa)
            ->where('MaHangHoa', '<>', $HangHoa_id)
            ->first();
        if ($duplicateMST) {
            Session::put('message', 'Hàng hóa này đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-HangHoa');
        }
        $giaban = DB::table('tbl_hanghoadoanhnghiep')->where('TenHangHoa',$request->Ten_HangHoa)->value('GiaBan');
        $data = [
            'TenHangHoa' => $request->Ten_HangHoa,
            'GiaBan' => $giaban,
            'DVT' => $request->DVT_HangHoa,
        ];
        DB::table('tbl_hanghoadoanhnghiep')->where('MaHangHoa', $HangHoa_id)->update($data);
        Session::put('message', 'Cập nhật hàng hóa thành công!');
        return redirect()->back();
    }

    public function delete_HangHoaDoanhNghiep($HangHoa_id){
        $this-> AuthLogin();
        DB::table('tbl_hanghoadoanhnghiep')->where('MaHangHoa', $HangHoa_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công!');
        return redirect()->back();
    }


    //Khách hàng
    public function add_KhachHang(){
        $this-> AuthLogin();
        return view('admin.add_KhachHang');
    }

    public function save_KhachHang(Request $request)
    {
        $this-> AuthLogin();
        $existingKhachHang = DB::table('tbl_khachhang')
            ->where('MST', $request->MaSoThue_KhachHang)
            ->first();
        if ($existingKhachHang) {
            Session::put('message', 'Mã số thuế đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-KhachHang');
        }
        $data = [
            'TenKhachHang' => $request->Ten_KhachHang,
            'MST' => $request->MaSoThue_KhachHang,
            'DiaChi' => $request->DiaChi_KhachHang,
            'SDT' => $request->SĐT_KhachHang,
            'Email' => $request->Email_KhachHang,
            'STK_NganHang' => $request->STK_KhachHang,
        ];
        DB::table('tbl_khachhang')->insert($data);
        Session::put('message', 'Thêm khách hàng thành công!');
        return Redirect::to('show-KhachHang');
    }

    public function show_KhachHang(){
        $this-> AuthLogin();
        $query = DB::table('tbl_khachhang');
        if ($key = request()->key) {
            $query->where('MST', 'like', '%' . $key . '%')
                ->orWhere('TenKhachHang', 'like', '%' . $key . '%')
                ->orWhere('SDT', 'like', '%' . $key . '%')
                ->orWhere('DiaChi', 'like', '%' . $key . '%')
                ->orWhere('Email', 'like', '%' . $key . '%')->paginate(10);
        }
        $item = $query->paginate(10);
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='A_Z'){
                $KhachHang = DB::table('tbl_khachhang')->orderBy('TenKhachHang','ASC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='RS'){
                return view('admin.show_KhachHang', compact('item'));
            }
            $item = $KhachHang;
        }
        return view('admin.show_KhachHang', ['item' => $item]);
    }

    public function edit_KhachHang($KhachHang_id){
        $this-> AuthLogin();
        $item = DB::table('tbl_khachhang')->where('MaKhachHang',$KhachHang_id)->get();
        return view('admin.edit_KhachHang', ['item' => $item]);
    }

    public function update_KhachHang(Request $request, $KhachHang_id)
    {
        $this-> AuthLogin();
        $duplicateMST = DB::table('tbl_khachhang')
            ->where('MST', $request->MaSoThue_KhachHang)
            ->where('MaKhachHang', '<>', $KhachHang_id)
            ->first();
        if ($duplicateMST) {
            Session::put('message', 'Mã số thuế đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('show-KhachHang');
        }
        $data = [
            'TenKhachHang' => $request->Ten_KhachHang,
            'MST' => $request->MaSoThue_KhachHang,
            'DiaChi' => $request->DiaChi_KhachHang,
            'SDT' => $request->SĐT_KhachHang,
            'Email' => $request->Email_KhachHang,
            'STK_NganHang' => $request->STK_KhachHang,
        ];
        DB::table('tbl_khachhang')->where('MaKhachHang', $KhachHang_id)->update($data);
        Session::put('message', 'Cập nhật thông tin khách hàng thành công!');
        return Redirect::to('show-KhachHang');
    }

    public function delete_KhachHang($KhachHang_id){
        $this-> AuthLogin();
        DB::table('tbl_khachhang')->where('MaKhachHang', $KhachHang_id)->delete();
        Session::put('message', 'Xóa Khách hàng thành công!');
        return Redirect::to('show-KhachHang');
    }


    //Hóa đơn đầu ra
    public function lochoadondaura() {
        $sapxep = $_GET['order'] ?? '';
        $year_get = $_GET['year'] ?? '';
        if (empty($sapxep) || empty($year_get)) {
            return Redirect::to('show-HoaDonDauRa');
        } else {
            $hddr = DB::table('tbl_hoadondaura')->value('SoHoaDon');
            $cthd = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon',$hddr)->get();
            $itemKH = DB::table('tbl_khachhang')->get();            
            $year = DB::table('tbl_hoadondaura')->selectRaw('YEAR(NLap) as year')->distinct()->pluck('year');
            $item = DB::table('tbl_hoadondaura');
            if ($year_get) {
                $item = $item->whereYear('NLap', $year_get);
            }
            switch ($sapxep) {
                case 'q1':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->orderBy('NLap', 'DESC');
                    break;
                case 'q2':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->orderBy('NLap', 'DESC');
                    break;
                case 'q3':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->orderBy('NLap', 'DESC');
                    break;
                case 'q4':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->orderBy('NLap', 'DESC');
                    break;
                case 'name_a_z':
                    $item = $item->join('tbl_khachhang', 'tbl_hoadondaura.Ma_KhachHang', '=', 'tbl_khachhang.MaKhachHang')->orderBy('tbl_khachhang.TenKhachHang', 'ASC');
                    break;
                default:
                    $item = $item->orderBy('NLap', 'DESC');
                    break;
            }
            $item = $item->paginate(10)->appends(request()->query());
            return view('admin.lochoadondaura', compact('item', 'cthd', 'itemKH', 'year'));
        }
    }

    public function add_HoaDonDauRa(){
        $this-> AuthLogin();
        $Khach_Hang = DB::table('tbl_khachhang')->orderBy('MaKhachHang','desc')->get();
        return view('admin.add_HoaDonDauRa')->with('HoaDonDauRa',$Khach_Hang);
    }

    public function listHoaDonDauRa(){
        $this-> AuthLogin();
        $hddr = DB::table('tbl_hoadondaura')->value('SoHoaDon');
        $cthd = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon',$hddr)->get();
        $itemKH = DB::table('tbl_khachhang')->get();
        $year = DB::table('tbl_hoadondaura')->selectRaw('YEAR(NLap) as year')->distinct()->pluck('year');
        $query = DB::table('tbl_hoadondaura');
        if ($key = request()->key) {
            $query->where('SoHoaDon', 'like', '%' . $key . '%')
                ->orWhere('TenHoaDon', 'like', '%' . $key . '%')
                ->orWhere('NLap', 'like', '%' . $key . '%')
                ->join('tbl_khachhang', 'tbl_hoadondaura.Ma_KhachHang', '=', 'tbl_khachhang.MaKhachHang')
                ->orwhere('tbl_khachhang.TenKhachHang','like','%'.$key.'%')
                ->paginate(10);
        }
        $item = $query->paginate(10);
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'TenHD_A_Z') {
                $HoaDonDauRa = DB::table('tbl_hoadondaura')
                    ->join('tbl_khachhang', 'tbl_hoadondaura.Ma_KhachHang', '=', 'tbl_khachhang.MaKhachHang')
                    ->orderBy('tbl_khachhang.TenKhachHang', 'ASC')
                    ->paginate(10)
                    ->appends(request()->query());
                $item = $HoaDonDauRa;            
            }elseif($sort_by=='RS'){
                return view('admin.show_HoaDonDauRa', compact('item', 'cthd', 'itemKH'));
            }elseif($sort_by=='NgayLap'){
                $HoaDonDauRa = DB::table('tbl_hoadondaura')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDonDauRa;
            }elseif($sort_by=='Quy_1'){
                $HoaDon = DB::table('tbl_hoadondaura')->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }elseif($sort_by=='Quy_2'){
                $HoaDon = DB::table('tbl_hoadondaura')->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }elseif($sort_by=='Quy_3'){
                $HoaDon = DB::table('tbl_hoadondaura')->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }elseif($sort_by=='Quy_4'){
                $HoaDon = DB::table('tbl_hoadondaura')->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }
        }
        return view('admin.show_HoaDonDauRa', compact('item', 'cthd', 'itemKH','year'));
    }

    public function save_HoaDonDauRa(Request $request)
    {
        $this-> AuthLogin();
        $existingHoaDonDauRa = DB::table('tbl_hoadondaura')
            ->where('SoHoaDon', $request->SoHoaDon_HoaDonDauRa)
            ->first();
        if ($existingHoaDonDauRa) {
            Session::put('message', 'Số hóa đơn này đã tồn tại.');
            return Redirect::to('add-HoaDonDauRa');
        }
        $Khach_Hang = DB::table('tbl_khachhang')->where('TenKhachHang', $request->KhachHang_name)->value('MaKhachHang');
        $data = [
            'TenHoaDon' => "Hóa đơn mua hàng",
            'SoHoaDon' => $request->SoHoaDon_HoaDonDauRa,
            'NLap' => now(),
            'Ma_KhachHang' => $Khach_Hang,
            'PTTT' => $request->PTTT_HoaDonDauRa,
            'TrangThai' => 0
        ];
        DB::table('tbl_hoadondaura')->insert($data);
        Session::put('message', 'Thêm hóa đơn thành công!');
        return Redirect::to('show-HoaDonDauRa');
    }

    public function edit_HoaDonDauRa($HoaDon_id){
        $this-> AuthLogin();
        $KhachHang = DB::table('tbl_khachhang')->orderBy('MaKhachHang','desc')->get();
        $item = DB::table('tbl_hoadondaura')->where('id',$HoaDon_id)->get();
        return view('admin.edit_HoaDonDauRa', compact('item','KhachHang'));
    }

    public function update_HoaDonDauRa(Request $request, $HoaDon_id)
    {
        $this-> AuthLogin();
        $existingHoaDonDauRa = DB::table('tbl_hoadondaura')
            ->where('id', $HoaDon_id)
            ->first();
        if (!$existingHoaDonDauRa) {
            Session::put('message', 'Không tìm thấy hóa đơn cần tìm.');
            return Redirect::to('add-HoaDonDauRa');
        }
        $duplicateMST = DB::table('tbl_hoadondaura')
            ->where('SoHoaDon', $request->SoHoaDon_HoaDonDauRa)
            ->where('id', '<>', $HoaDon_id)
            ->first();
        if ($duplicateMST) {
            Session::put('message', 'Hóa đơn này đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-HoaDonDauRa');
        }
        $KhachHang = DB::table('tbl_khachhang')->where('TenKhachHang', $request->KhachHang_name)->value('MaKhachHang');
        $data = [
            'SoHoaDon' => $request->SoHoaDon_HoaDonDauRa,
            'NLap' => now(),
            'Ma_KhachHang' => $KhachHang,
            'PTTT' => $request->PTTT_HoaDonDauRa,
        ];
        DB::table('tbl_hoadondaura')->where('id', $HoaDon_id)->update($data);
        Session::put('message', 'Cập nhật hóa đơn thành công!');
        return Redirect::to('show-HoaDonDauRa');
    }

    public function delete_HoaDonDauRa($HoaDon_id){
        $this-> AuthLogin();
        DB::table('tbl_hoadondaura')->where('id', $HoaDon_id)->delete();
        Session::put('message', 'Xóa hóa đơn thành công!');
        return Redirect::to('show-HoaDonDauRa');
    }


    //show chi tiết hóa đơn
    public function add_ChiTietHoaDonDauRa($SHD){
        $this-> AuthLogin();
        $doanhnghiep = DB::table('tbl_doanhnghiep')->get();
        $doanhnghiep = DB::table('tbl_doanhnghiep')->get();
        $Hoa_Don = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SHD)->get();
        $Hang_Hoa = DB::table('tbl_hanghoadoanhnghiep')->orderBy('MaHangHoa','desc')->get();
        return view('admin.add_ChiTietHoaDonDauRa')->with('HangHoa',$Hang_Hoa)->with('HoaDon',$Hoa_Don)->with('doanhnghiep',$doanhnghiep);
    }

    public function listChiTietHoaDonDauRa($SoHD){
        $this-> AuthLogin();
        $item = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon',$SoHD);
        if (!$item->exists()) {
            Session::put('message', 'Số hóa đơn này chưa có sản phẩm!!!');
            return Redirect::to('show-HoaDonDauRa');
        } else {
            $item = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon',$SoHD)->get();
        }        
        $item2 = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SoHD)->get();
        $madn = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SoHD)->value('Ma_KhachHang');
        $item3 = DB::table('tbl_khachhang')->where('MaKhachHang', $madn)->get();  
        $chitietdonhang = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->value('Ma_HangHoa');
        $hh = DB::table('tbl_hanghoadoanhnghiep')->where('MaHangHoa', $chitietdonhang)->value('Ma_DoanhNghiep');
        $item4 = DB::table('tbl_doanhnghiep')->where('id', $hh)->get();
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='TenCTHD_A_Z'){
                $ChiTietHoaDon = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon',$SoHD)->orderBy('TenHangHoa','ASC')->get();
                $item = $ChiTietHoaDon;
            }elseif($sort_by=='TongTH'){
                $ChiTietHoaDon = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon',$SoHD)->orderBy('ThanhTien','DESC')->get();
                $item = $ChiTietHoaDon;
            }
        }
        return view('admin.show_ChiTietHoaDonDauRa', compact('item','item2','item3','item4'));
    }

    public function save_ChiTietHoaDonDauRa(Request $request)
    {
        $this-> AuthLogin();
        $existingChiTietHoaDonDauRa = DB::table('tbl_chitiethoadondaura')
            ->where('TenHangHoa', $request->TenHH_ChiTietHoaDonDauRa)
            ->where('SoHoaDon', $request->SoHoaDon_ChiTietHoaDonDauRa)
            ->first();
        if ($existingChiTietHoaDonDauRa) {
            Session::put('message', 'Số hóa đơn này đã tồn tại.');
            return Redirect::to('show-HoaDonDauRa');
        }
        $MaHoaDonDauRa = DB::table('tbl_hoadondaura')->where('SoHoaDon', $request->SoHoaDon_ChiTietHoaDonDauRa)->value('id');
        $MaHH = DB::table('tbl_hanghoadoanhnghiep')->where('TenHangHoa', $request->TenHH_ChiTietHoaDonDauRa)->value('MaHangHoa');
        $giaBan = DB::table('tbl_hanghoadoanhnghiep')->where('TenHangHoa', $request->TenHH_ChiTietHoaDonDauRa)->value('SoTienThayDoi');
        $thanhTien = $giaBan * $request->SL_ChiTietHoaDonDauRa;
        $data = [
            'Ma_HoaDon'=>$MaHoaDonDauRa,
            'Ma_HangHoa' => $MaHH,
            'SoHoaDon' => $request->SoHoaDon_ChiTietHoaDonDauRa,
            'TenHangHoa' => $request->TenHH_ChiTietHoaDonDauRa,
            'DonGia' => $giaBan,
            'ThanhTien'=>$thanhTien,
            'SoLuong' => $request->SL_ChiTietHoaDonDauRa,
        ];
        DB::table('tbl_chitiethoadondaura')->insert($data);
        Session::put('message', 'Thêm hàng hóa thành công!');
        return Redirect::to('show-HoaDonDauRa');
    }

    public function edit_ChiTietHoaDonDauRa($ChiTietHoaDon_id){
        $this-> AuthLogin();
        $item = DB::table('tbl_chitiethoadondaura')->where('id',$ChiTietHoaDon_id)->get();
        $Hang_Hoa = DB::table('tbl_hanghoadoanhnghiep')->orderBy('MaHangHoa','desc')->get();
        return view('admin.edit_ChiTietHoaDonDauRa', ['item' => $item])->with('hanghoa',$Hang_Hoa);
    }

    public function update_ChiTietHoaDonDauRa(Request $request, $ChiTietHoaDon_id)
    {
        $this-> AuthLogin();
        $existingHoaDon = DB::table('tbl_chitiethoadondaura')
            ->where('id', $ChiTietHoaDon_id)
            ->first();
        if (!$existingHoaDon) {
            Session::put('message', 'Không tìm thấy hóa đơn cần tìm.');
            return redirect()->back();
        }
        $giaBan = DB::table('tbl_hanghoadoanhnghiep')->where('TenHangHoa', $request->TenHH_ChiTietHoaDonDauRa)->value('GiaBan');
        $thanhTien = $giaBan * $request->SL_ChiTietHoaDonDauRa;
        $data = [
            'SoHoaDon' => $request->SoHoaDon_ChiTietHoaDonDauRa,
            'TenHangHoa' => $request->TenHH_ChiTietHoaDonDauRa,
            'DonGia' => $giaBan,
            'ThanhTien'=>$thanhTien,
            'SoLuong' => $request->SL_ChiTietHoaDonDauRa,            
        ];
        DB::table('tbl_chitiethoadondaura')->where('id', $ChiTietHoaDon_id)->update($data);
        Session::put('message', 'Cập nhật hóa đơn thành công!');
        return redirect()->back();
    }

    public function delete_ChiTietHoaDonDauRa($ChiTietHoaDon_id){
        $this-> AuthLogin();
        DB::table('tbl_chitiethoadondaura')->where('id', $ChiTietHoaDon_id)->delete();
        Session::put('message', 'Xóa hóa đơn thành công!');
        return redirect()->back();
    }

    public function XuLy_HoaDonDauRa($SoHD) {
        $soHD = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SoHD)->first();
        $tienhang = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->sum(DB::raw('DonGia * SoLuong'));
        $tienhang2 = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->sum(DB::raw('((DonGia * SoLuong))+(((DonGia * SoLuong))*(ThueSuat/100))'));
        $tienhang3 = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->sum(DB::raw('(((DonGia * SoLuong))*(ThueSuat/100))'));

        if ($soHD) {
            $TrangThai = '1';
            $data = [
                'TrangThai' => $TrangThai,
                "ThanhTien" => $tienhang,
                'TienSauThue'=> $tienhang2,
                'TienThue' => $tienhang3
            ];
            $soHD1 = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->value("TenHangHoa");
            $thh = DB::table('tbl_hanghoadoanhnghiep')->where('TenHangHoa', $soHD1)->value("Ma_DoanhNghiep");
            $loi = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->sum(DB::raw('((DonGia * SoLuong))+(((DonGia * SoLuong))*(ThueSuat/100))'));
            $thh2 = DB::table('tbl_hanghoadoanhnghiep')->where('TenHangHoa', $soHD1)->value("TenHangHoa");
            $data3 = [
                'Ma_DoanhNghiep' => $thh,
                'TongVon' => $thh2 ? $loi : 0,
                'TongLoi' => $loi
            ];
            $nlaphddr = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SoHD)->value("NLap");
            $soluongdaura = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->sum(DB::raw('SoLuong'));
            $data4 = [
                'Ma_DoanhNghiep' => $thh,
                'NLap' => $nlaphddr,
                'SoLuong' => $soluongdaura,
                'SoTien' => $tienhang2
            ];
            $nlap = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SoHD)->value("NLap");
            $hdmakh = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SoHD)->value("Ma_KhachHang");
            $data5 = [
                'Ma_KhachHang'=> $hdmakh,
                'NLap' => $nlap,
                'SoTien'=> $tienhang2
            ];
            $hanghoa = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->get();
            $data2 = [];
            foreach ($hanghoa as $item) {
                $ten = $item->TenHangHoa;
                $soluongban = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->value('SoLuong');
                $soluong = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->value('SoLuong');
                $existingItem = DB::table('tbl_hanghoadoanhnghiep')
                    ->where('TenHangHoa', $ten)
                    ->first();
                if ($existingItem) {
                    DB::table('tbl_hanghoadoanhnghiep')
                        ->where('TenHangHoa', $ten)
                        ->decrement('SoLuongHienTai', $soluong);
                    DB::table('tbl_hanghoadoanhnghiep')
                        ->where('TenHangHoa', $ten)
                        ->increment('SoLuongDaBan', $soluongban);
                } else {
                    $data2[] = [
                        'SoLuongDaBan' => $soluongban,
                        'SoLuongHienTai' => $soluong,
                    ];
                }
            }
            DB::table('tbl_hoadondaura')->where('SoHoaDon', $SoHD)->update($data);
            DB::table('tbl_hanghoadoanhnghiep')->insert($data2);
            DB::table("tbl_thongkedaura")->insert($data4);
            DB::table("tbl_thongkekhachhang")->insert($data5);
            DB::table('tbl_thongke')->insert($data3);
            return Redirect::to('show-HoaDonDauRa');
        }
    }
    
    public function show_importFileDauRa(){
        $this-> AuthLogin();
        return view('admin.import_FileDauRa');
    }

    public function import_hoadonDauRa(Request $req){
        $this-> AuthLogin();
        $req->validate([
            'PDF_file' => 'required|file|mimes:pdf'
        ], [
            'PDF_file.required' => 'Không được bỏ trống các trường',
            'PDF_file.file' => 'Tệp tải lên phải là một tệp tin.',
            'PDF_file.mimes' => 'Tệp tải lên phải có định dạng PDF.'
        ]);
        $file = $req->file('XML_file');
        $xmlDataString = file_get_contents($file->getRealPath());
        $xmlObject = simplexml_load_string($xmlDataString);

        // Doanh nghiệp
        if (count($xmlObject->Content) > 0) {
            $dataArray = [];
            foreach ($xmlObject->Content as $index => $data) {
                $dataArray[] = [
                    "Ten" => (string) $data->ComName,
                    "MST" => (string) $data->ComTaxCode,
                    "DChi" => (string) $data->ComAddress,
                    "SDThoai" => (string) $data->ComPhone,
                ];
            }
        }
        $mst = (string) $xmlObject->Content[0]->ComTaxCode;
        $existingDoanhNghiep = DB::table('tbl_doanhnghiep') ->where('MST', $mst) ->first();
        if (!$existingDoanhNghiep) {
            DB::table('tbl_doanhnghiep')->insert($dataArray);
        } else {
            Session::put('message', 'Doanh nghiệp này đã có trên hệ thống! Các dữ liệu khác sẽ được lưu.');
        }

        // Khách hàng
        if (count($xmlObject->Content) > 0) {
            $dataArray2 = [];
            foreach ($xmlObject->Content as $index => $data) {
                $dataArray2[] = [
                    "TenKhachHang" => (string) $data->CusName,
                    "MST" => (string) $data->CusTaxCode,
                    "DiaChi" => (string) $data->CusAddress,
                ];
            }
        }
        $mst = (string) $xmlObject->Content[0]->CusTaxCode;
        $existingKhachHang = DB::table('tbl_khachhang') ->where('MST', $mst) ->first();
        if (!$existingKhachHang) {
            DB::table('tbl_khachhang')->insert($dataArray2);
        } else {
            Session::put('message', 'Khách hàng này đã có trên hệ thống! Các dữ liệu khác sẽ được lưu.');
        }

        // //Hàng hóa
        if (count($xmlObject->Content->Products->Product) > 0) {
            $dataArray3 = [];
            foreach ($xmlObject->Content->Products->Product as $index => $data) {
                $MaDN = DB::table('tbl_doanhnghiep')->where('Ten', (string) $xmlObject->Content->ComName)->value('id');
                $soluong = DB::table('tbl_hanghoadoanhnghiep')
                        ->where('TenHangHoa', $data->ProdName)
                        ->where('Ma_DoanhNghiep', $MaDN)
                        ->value('SoLuongHienTai');
                $soht = $data->ProdQuantity + $soluong;                
                $dataArray3[] = [
                    "TenHangHoa" => (string) $data->ProdName,
                    "GiaBan" => (string) $data->ProdPrice,
                    "DVT" => (string) $data->ProdUnit,
                    "SoLuongHienTai" => $soht,
                    "Ma_DoanhNghiep" => $MaDN,
                    "SoTienThayDoi" => (string) $data->ProdPrice,
                    "SoLuongDaNhap" => $soht,
                    'SoLuongDaBan' => '0'
                ];
            }
        }
        $TenHangHoa = (string) $xmlObject->Content->Products->Product[0]->ProdName;
        $existingHangHoa = DB::table('tbl_hanghoadoanhnghiep') ->where('TenHangHoa', $TenHangHoa) ->first();
        if (!$existingHangHoa) {
            DB::table('tbl_hanghoadoanhnghiep')->insert($dataArray3);
        }else{
            Session::put('message', 'Hàng hóa này đã có trên hệ thống! Các dữ liệu khác sẽ được lưu.');
        }
        
        // //Hóa đơn
        if (count($xmlObject->Content) > 0) {
            $dataArray4 = [];
            foreach ($xmlObject->Content as $index => $data) {
                $MaKH_id = DB::table('tbl_khachhang')->where('TenKhachHang', (string) $xmlObject->Content->CusName)->value('MaKhachHang');
                $nl = (string) $data->ArisingDate;
                $NLap = DateTime::createFromFormat('d/m/Y', $nl);
                $NLapFormatted = $NLap->format('Y-m-d');
                $dataArray4[] = [
                    "TenHoaDon" => (string) $data->InvoiceName,
                    "SoHoaDon" => (string) $data->InvoiceNo,
                    "NLap" => $NLapFormatted,
                    "Ma_KhachHang" => $MaKH_id,
                    'PTTT' => (string) $data->Kind_of_Payment,
                    'TrangThai' => 0
                ];  
            }
        }
        $SHDon = (string) $xmlObject->Content[0]->InvoiceNo;
        $existingHoaDon = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SHDon)->first();
        if (!$existingHoaDon) {
            DB::table('tbl_hoadondaura')->insert($dataArray4);
        }else{
            Session::put('message', 'Dữ liệu này đã được upload lên rồi! Mời bạn thử lại!');
        }
        
        //chi tiet
        if (count($xmlObject->Content->Products->Product) > 0) {
            $dataArray5 = [];
            foreach ($xmlObject->Content->Products->Product as $data) {
                $MaHoaDon = DB::table('tbl_hoadondaura')->where('SoHoaDon', (string) $xmlObject->Content->InvoiceNo)->value('id');
                $MaHangH = DB::table('tbl_hanghoadoanhnghiep')->where('TenHangHoa', (string)$data->ProdName)->value('MaHangHoa');
                $thueSuat = (string) $xmlObject->Content->VAT_Rate;
                $tienThueGTGT = (string) $data->Amount * ($thueSuat/100);
                $dataArray5[] = [
                    "Ma_HoaDon" => $MaHoaDon,
                    "SoHoaDon" => (string) $xmlObject->Content->InvoiceNo,
                    "Ma_HangHoa" => $MaHangH,
                    "TenHangHoa" => (string) $data->ProdName,
                    "DonGia" => (string) $data->ProdPrice,
                    "SoLuong" => (string) $data->ProdQuantity,
                    "ThanhTien" => (string) $data->Amount,
                    "ThueSuat" => (string) $xmlObject->Content->VAT_Rate,
                    "TienThueGTGT" => $tienThueGTGT
                ];
            } 
        }
        $SoHD = (string)  $xmlObject->Content[0]->InvoiceNo;
        $existingChiTietHoaDon = DB::table('tbl_chitiethoadondaura')->where('SoHoaDon', $SoHD)->first();
        if (!$existingChiTietHoaDon) {
            DB::table('tbl_chitiethoadondaura')->insert($dataArray5);
        }else{
            Session::put('message', 'Dữ liệu này đã được upload lên rồi! Mời bạn thử lại!');
        }
        Session::put('message', 'Toàn bộ dữ liệu đã được tải lên thành công');

        //pdf
        $hoaDon = (string) $xmlObject->Content[0]->InvoiceNo;
        if ($hoaDon) {
            if ($req->hasFile('PDF_file')) {
                $file = $req->file('PDF_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('outputs'), $fileName);
                $existingFile = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SHDon)->value('TenFileThem');
                if ($existingFile) {
                    Session::put('message', 'File đã tồn tại. Vui lòng chọn file khác.');
                    return redirect()->back();
                }
                DB::table('tbl_hoadondaura')->where('SoHoaDon', $SHDon)->update([
                    'TenFileThem' => $fileName,
                ]);
                Session::put('message', 'Tải lên thành công!');
            } else {
                Session::put('message', 'Có lỗi gì đó xảy ra');
            }
        }
        return redirect()->back();
    }

    //upload file pdf
    public function ThongTinThemDauRa($SHDon){
        $hd = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SHDon)->get();
        return view('admin.import_FileRa', compact('hd'));
    }

    public function import_themDauRa(Request $req, $SHDon){
        $this-> AuthLogin();
        $hoaDon = DB::table('tbl_hoadondaura')->where('SoHoaDon', $SHDon)->first();
        if ($hoaDon) {
            if ($req->hasFile('file')) {
                $file = $req->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('outputs'), $fileName);
                DB::table('tbl_hoadondaura')->where('SoHoaDon', $SHDon)->update([
                    'TenFileThem' => $fileName,
                ]);
                Session::put('message', 'Tải lên thành công!');
                return redirect()->back();
            } else {
                Session::put('message', 'Đã xảy ra lỗi gì đó hãy kiểm tra lại!');
                return redirect()->back();
            }
        }
    }

    public function xemfilehoadondaura($id){
        $this-> AuthLogin();
        $data = DB::table('tbl_hoadondaura')->find($id);
        return view('admin.xemfilehoadondaura', compact('data'));
    } 
}