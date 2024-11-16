<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BillController extends Controller
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

    //Quản lý nhà cung cấp
    public function add_NhaCungCap(){
        $this-> AuthLogin();
        return view('admin.add_NhaCungCap');
    }

    public function list(){
        $this-> AuthLogin();
        $query = DB::table('tbl_nhacungcap');
        if ($key = request()->key) {
            $query->where('MST', 'like', '%' . $key . '%')
                ->orWhere('Ten', 'like', '%' . $key . '%')
                ->orWhere('SDThoai', 'like', '%' . $key . '%')
                ->orWhere('DCTDTu', 'like', '%' . $key . '%')->paginate(10);
        }
        $item = $query->paginate(10);
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='A_Z'){
                $Nha_Cung_Cap = DB::table('tbl_nhacungcap')->orderBy('Ten','ASC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='RS'){
                return view('admin.show_NhaCungCap', compact('item'));
            }
            $item = $Nha_Cung_Cap;
        }
        return view('admin.show_NhaCungCap', compact('item'));
    }

    public function save_NhaCungCap(Request $request)
    {
        $this-> AuthLogin();
        $existingNhaCungCap = DB::table('tbl_nhacungcap')
            ->where('MST', $request->MaSoThue_NhaCungCap)
            ->first();
        if ($existingNhaCungCap) {
            Session::put('message', 'Mã số thuế đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-NhaCungCap');
        }
        $data = [
            'Ten' => $request->Ten_NhaCungCap,
            'MST' => $request->MaSoThue_NhaCungCap,
            'DChi' => $request->DiaChi_NhaCungCap,
            'SDThoai' => $request->SĐT_NhaCungCap,
            'DCTDTu' => $request->Email_NhaCungCap,
            'Fax' => $request->Fax_NhaCungCap,
        ];

        DB::table('tbl_nhacungcap')->insert($data);
        Session::put('message', 'Thêm nhà cung cấp thành công!');
        return Redirect::to('add-NhaCungCap');
    }

    public function edit_NhaCungCap($NhaCungCap_id){
        $this-> AuthLogin();
        $item = DB::table('tbl_nhacungcap')->where('id',$NhaCungCap_id)->get();
        return view('admin.edit_NhaCungCap', ['item' => $item]);
    }
    
    public function update_NhaCungCap(Request $request, $NhaCungCap_id)
    {
        $this-> AuthLogin();
        $existingNhaCungCap = DB::table('tbl_nhacungcap')
            ->where('id', $NhaCungCap_id)
            ->first();
        if (!$existingNhaCungCap) {
            Session::put('message', 'Không tìm thấy nhà cung cấp.');
            return Redirect::to('add-NhaCungCap');
        }
        $duplicateMST = DB::table('tbl_nhacungcap')
            ->where('MST', $request->MaSoThue_NhaCungCap)
            ->where('id', '<>', $NhaCungCap_id)
            ->first();
        if ($duplicateMST) {
            Session::put('message', 'Mã số thuế đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-NhaCungCap');
        }
        $data = [
            'Ten' => $request->Ten_NhaCungCap,
            'MST' => $request->MaSoThue_NhaCungCap,
            'DChi' => $request->DiaChi_NhaCungCap,
            'SDThoai' => $request->SĐT_NhaCungCap,
            'DCTDTu' => $request->Email_NhaCungCap,
            'Fax' => $request->Fax_NhaCungCap,
        ];
        DB::table('tbl_nhacungcap')->where('id', $NhaCungCap_id)->update($data);
        Session::put('message', 'Cập nhật nhà cung cấp thành công!');
        return Redirect::to('show-NhaCungCap');
    }

    public function delete_NhaCungCap($NhaCungCap_id){
        $this-> AuthLogin();
        DB::table('tbl_nhacungcap')->where('id', $NhaCungCap_id)->delete();
        Session::put('message', 'Xóa nhà cung cấp thành công!');
        return Redirect::to('add-NhaCungCap');
    }
    

    //Quản lý Doanh nhiệp
    public function add_DoanhNghiep(){
        $this-> AuthLogin();
        return view('admin.add_DoanhNghiep');
    }

    public function listDoanhNghiep(){
        $this-> AuthLogin();
        $query = DB::table('tbl_doanhnghiep');
        if ($key = request()->key) {
            $query->where('MST', 'like', '%' . $key . '%')
                ->orWhere('Ten', 'like', '%' . $key . '%')
                ->orWhere('SDThoai', 'like', '%' . $key . '%')
                ->orWhere('DCTDTu', 'like', '%' . $key . '%')->paginate(10);
        }
        $item = $query->paginate(10);
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='A_Z'){
                $DoanhNghiep = DB::table('tbl_doanhnghiep')->orderBy('Ten','ASC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='RS'){
                return view('admin.add_DoanhNghiep', compact('item'));
            }
            $item = $DoanhNghiep;
        }
        return view('admin.add_DoanhNghiep', ['item' => $item]);
    }

    public function save_DoanhNghiep(Request $request)
    {
        $this-> AuthLogin();
        $existingDoanhNghiep = DB::table('tbl_doanhnghiep')
            ->where('MST', $request->MaSoThue_DoanhNghiep)
            ->first();
        if ($existingDoanhNghiep) {
            Session::put('message', 'Mã số thuế đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-DoanhNghiep');
        }
        $data = [
            'Ten' => $request->Ten_DoanhNghiep,
            'MST' => $request->MaSoThue_DoanhNghiep,
            'DChi' => $request->DiaChi_DoanhNghiep,
            'SDThoai' => $request->SĐT_DoanhNghiep,
            'DCTDTu' => $request->Email_DoanhNghiep,
        ];
        DB::table('tbl_doanhnghiep')->insert($data);
        Session::put('message', 'Thêm doanh nghiệp thành công!');
        return Redirect::to('add-DoanhNghiep');
    }

    public function edit_DoanhNghiep($DoanhNghiep_id){
        $this-> AuthLogin();
        $item = DB::table('tbl_doanhnghiep')->where('id',$DoanhNghiep_id)->get();
        return view('admin.edit_DoanhNghiep', ['item' => $item]);
    }

    public function update_DoanhNghiep(Request $request, $DoanhNghiep_id)
    {
        $this-> AuthLogin();
        $existingDoanhNghiep = DB::table('tbl_doanhnghiep')
            ->where('id', $DoanhNghiep_id)
            ->first();
        if (!$existingDoanhNghiep) {
            Session::put('message', 'Không tìm thấy doanh nghiệp cần tìm.');
            return Redirect::to('add-DoanhNghiep');
        }
        $duplicateMST = DB::table('tbl_doanhnghiep')
            ->where('MST', $request->MaSoThue_DoanhNghiep)
            ->where('id', '<>', $DoanhNghiep_id)
            ->first();
        if ($duplicateMST) {
            Session::put('message', 'Mã số thuế đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-DoanhNghiep');
        }
        $data = [
            'Ten' => $request->Ten_DoanhNghiep,
            'MST' => $request->MaSoThue_DoanhNghiep,
            'DChi' => $request->DiaChi_DoanhNghiep,
            'SDThoai' => $request->SĐT_DoanhNghiep,
            'DCTDTu' => $request->Email_DoanhNghiep,
        ];
        DB::table('tbl_doanhnghiep')->where('id', $DoanhNghiep_id)->update($data);
        Session::put('message', 'Cập nhật doanh nghiệp thành công!');
        return Redirect::to('add-DoanhNghiep');
    }
    public function delete_DoanhNghiep($DoanhNghiep_id){
        $this-> AuthLogin();
        DB::table('tbl_doanhnghiep')->where('id', $DoanhNghiep_id)->delete();
        Session::put('message', 'Xóa doanh nghiệp thành công!');
        return Redirect::to('add-DoanhNghiep');
    }
    

    //Quản lý hàng hóa
    public function add_HangHoa(){
        $this-> AuthLogin();
        $Nha_Cung_Cap = DB::table('tbl_nhacungcap')->orderBy('id','desc')->get();
        return view('admin.add_HangHoa')->with('HangHoa',$Nha_Cung_Cap);
    }

    public function listHangHoa($id){
        $this-> AuthLogin();
        $item3 = DB::table('tbl_nhacungcap')->where('id', $id)->get();  
        $query = DB::table('tbl_hanghoa');
        if ($key = request()->key) {
            $query->where('TenHangHoa', 'like', '%' . $key . '%')
                ->orWhere('GiaBan', 'like', '%' . $key . '%')
                ->orWhere('DVT', 'like', '%' . $key . '%')
                ->orWhere('NhaCungCap_id', 'like', '%' . $key . '%')->paginate(10);
        }
        $item = $query->where('NhaCungCap_id',$id)->paginate(10);
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='TenHH_A_Z'){
                $HangHoa = DB::table('tbl_hanghoa')->orderBy('TenHangHoa','ASC')->paginate(10)->appends(request()->query());
                $item = $HangHoa;
            }elseif($sort_by=='RS'){
                return view('admin.show_HangHoa',  compact('item','item3'));
            }elseif($sort_by=='GiaTien'){
                $HangHoa = DB::table('tbl_hanghoa')->orderBy('GiaBan','DESC')->paginate(10)->appends(request()->query());
                $item = $HangHoa;
            }
        }
        return view('admin.show_HangHoa', compact('item','item3'));
    }

    public function save_HangHoa(Request $request)
    {
        $this-> AuthLogin();
        $existingHangHoa = DB::table('tbl_hanghoa')
            ->where('TenHangHoa', $request->Ten_HangHoa)
            ->first();
        if ($existingHangHoa) {
            Session::put('message', 'Hàng hóa ấy của nhà cung cấp này đã tồn tại.');
            return Redirect::to('add-HangHoa');
        }
        $NhaCungCap = DB::table('tbl_nhacungcap')->where('Ten', $request->NhaCungCap_name)->value('id');
        $GiaBan_HangHoa = filter_var($request->GiaBan_HangHoa, FILTER_SANITIZE_NUMBER_INT);
        $data = [
            'TenHangHoa' => $request->Ten_HangHoa,
            'GiaBan' => $GiaBan_HangHoa,
            'DVT' => $request->DVT_HangHoa,
            'NhaCungCap_id' => $NhaCungCap,
        ];

        DB::table('tbl_hanghoa')->insert($data);
        Session::put('message', 'Thêm hàng hóa thành công!');
        return Redirect::to('show-HangHoa');
    }

    public function edit_HangHoa($HangHoa_id){
        $this-> AuthLogin();
        // $Nha_Cung_Cap = DB::table('tbl_nhacungcap')->orderBy('id','desc')->get();
        $item = DB::table('tbl_hanghoa')->where('MaHangHoa',$HangHoa_id)->get();
        return view('admin.edit_HangHoa',  compact('item'));
    }

    public function update_HangHoa(Request $request, $HangHoa_id)
    {
        $this-> AuthLogin();
        
        $existingHangHoa = DB::table('tbl_hanghoa')
            ->where('MaHangHoa', $HangHoa_id)
            ->first();
        if (!$existingHangHoa) {
            Session::put('message', 'Không tìm thấy hàng hóa cần tìm.');
            return Redirect::to('add-HangHoa');
        }
        $duplicateMST = DB::table('tbl_hanghoa')
            ->where('TenHangHoa', $request->Ten_HangHoa)
            ->where('MaHangHoa', '<>', $HangHoa_id)
            ->first();
        if ($duplicateMST) {
            Session::put('message', 'Hàng hóa này đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-HangHoa');
        }
        $NhaCungCap = DB::table('tbl_nhacungcap')->where('id', $request->NhaCungCap_name)->value('id');
        $data = [
            'TenHangHoa' => $request->Ten_HangHoa,
            'GiaBan' => $request->GiaBan_HangHoa,
            'DVT' => $request->DVT_HangHoa,
            'NhaCungCap_id' => $NhaCungCap,
        ];
        DB::table('tbl_hanghoa')->where('MaHangHoa', $HangHoa_id)->update($data);
        Session::put('message', 'Cập nhật hàng hóa thành công!');
        return redirect()->back();
    }

    public function delete_HangHoa($HangHoa_id){
        $this-> AuthLogin();
        DB::table('tbl_hanghoa')->where('MaHangHoa', $HangHoa_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công!');
        return redirect()->back();
    }
    

    //Quản lý hóa đơn 
    //show hóa đơn
    public function lochoadon() {
        $sapxep = $_GET['order'] ?? '';
        $year_get = $_GET['year'] ?? '';
        if (empty($sapxep) || empty($year_get)) {
            return Redirect::to('show-HoaDon');
        } else {
            $itemDN = DB::table('tbl_doanhnghiep')->get();
            $year = DB::table('tbl_hoadon')->selectRaw('YEAR(NLap) as year')->distinct()->pluck('year');
            $item = DB::table('tbl_hoadon');
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
                    $item = $item->orderBy('TenNCC', 'ASC');
                    break;
                default:
                    $item = $item->orderBy('NLap', 'DESC');
                    break;
            }
            $item = $item->paginate(10)->appends(request()->query());
            
            return view('admin.lochoadon', compact('item', 'itemDN', 'year'));
        }
    }
    
    public function add_HoaDon(){
        $this-> AuthLogin();
        $Doanh_Nghiep = DB::table('tbl_doanhnghiep')->orderBy('id','desc')->get();
        return view('admin.add_HoaDon')->with('HoaDon',$Doanh_Nghiep);
    }

    public function listHoaDon(){
        $this-> AuthLogin();
        $itemDN = DB::table('tbl_doanhnghiep')->get();
        $year = DB::table('tbl_hoadon')
        ->selectRaw('YEAR(NLap) as year')
        ->distinct()
        ->pluck('year');
            $query = DB::table('tbl_hoadon');
        if ($key = request()->key) {
            $query->where('SHDon', 'like', '%' . $key . '%')
                ->orWhere('TenNCC', 'like', '%' . $key . '%')
                ->orWhere('NLap', 'like', '%' . $key . '%')->paginate(10);
        }
        $item = $query->paginate(10);
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='RS'){
                return view('admin.show_HoaDon', compact('item','itemDN'));
            }elseif ($sort_by == 'NgayLap') {
                $HoaDon = DB::table('tbl_hoadon')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }elseif($sort_by=='TenNCC_A_Z'){
                $HoaDon = DB::table('tbl_hoadon')->orderBy('TenNCC', 'ASC')->paginate(10)->appends(request()->query());;
                $item = $HoaDon;
            }elseif($sort_by=='Quy_1'){
                $HoaDon = DB::table('tbl_hoadon')->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }elseif($sort_by=='Quy_2'){
                $HoaDon = DB::table('tbl_hoadon')->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }elseif($sort_by=='Quy_3'){
                $HoaDon = DB::table('tbl_hoadon')->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }elseif($sort_by=='Quy_4'){
                $HoaDon = DB::table('tbl_hoadon')->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->whereRaw('YEAR(NLap) = YEAR(NOW())')->orderBy('NLap', 'DESC')->paginate(10)->appends(request()->query());
                $item = $HoaDon;
            }
        }
        return view('admin.show_HoaDon', compact('item','itemDN','year'));
    }

    public function save_HoaDon(Request $request)
    {
        $this-> AuthLogin();
        $existingHoaDon = DB::table('tbl_hoadon')
            ->where('SHDon', $request->SoHoaDon_HoaDon)
            ->first();
        if ($existingHoaDon) {
            Session::put('message', 'Số hóa đơn này đã tồn tại.');
            return Redirect::to('add-HoaDon');
        }
        $Doanh_Nghiep = DB::table('tbl_doanhnghiep')->where('Ten', $request->DoanhNghiep_name)->value('id');
        $data = [
            'THDon' => $request->Ten_HoaDon,
            'SHDon' => $request->SoHoaDon_HoaDon,
            'NLap' => now(),
            'File' => $request->File_HoaDon,
            'MaDN_id' => $Doanh_Nghiep,
            'PTTT' => $request->PTTT_HoaDon,
            'MaThamChieu' => $request->MaThamChieu_HoaDon,
            'TrangThai' => 0
        ];
        DB::table('tbl_hoadon')->insert($data);
        Session::put('message', 'Thêm hóa đơn thành công!');
        return Redirect::to('show-HoaDon');
    }

    public function edit_HoaDon($HoaDon_id){
        $this-> AuthLogin();
        $DoanhNghiep = DB::table('tbl_doanhnghiep')->orderBy('id','desc')->get();
        $item = DB::table('tbl_hoadon')->where('id',$HoaDon_id)->get();
        return view('admin.edit_HoaDon', compact('item','DoanhNghiep'));
    }

    public function update_HoaDon(Request $request, $HoaDon_id)
    {
        $this-> AuthLogin();
        $existingHoaDon = DB::table('tbl_hoadon')
            ->where('id', $HoaDon_id)
            ->first();
        if (!$existingHoaDon) {
            Session::put('message', 'Không tìm thấy hóa đơn cần tìm.');
            return Redirect::to('add-HoaDon');
        }
        $duplicateMST = DB::table('tbl_hoadon')
            ->where('SHDon', $request->SoHoaDon_HoaDon)
            ->where('id', '<>', $HoaDon_id)
            ->first();
        if ($duplicateMST) {
            Session::put('message', 'Hóa đơn này đã tồn tại trong cơ sở dữ liệu.');
            return Redirect::to('add-HoaDon');
        }
        $DoanhNghiep = DB::table('tbl_doanhnghiep')->where('Ten', $request->DoanhNghiep_name)->value('id');
        $data = [
            'THDon' => $request->Ten_HoaDon,
            'SHDon' => $request->SoHoaDon_HoaDon,
            'NLap' => now(),
            'File' => $request->File_HoaDon,
            'MaDN_id' => $DoanhNghiep,
            'PTTT' => $request->PTTT_HoaDon,
            'MaThamChieu' => $request->MaThamChieu_HoaDon,
        ];
        DB::table('tbl_hoadon')->where('id', $HoaDon_id)->update($data);
        Session::put('message', 'Cập nhật hóa đơn thành công!');
        return Redirect::to('show-HoaDon');
    }

    public function delete_HoaDon($HoaDon_id){
        $this-> AuthLogin();
        DB::table('tbl_hoadon')->where('id', $HoaDon_id)->delete();
        Session::put('message', 'Xóa hóa đơn thành công!');
        return Redirect::to('show-HoaDon');
    }

    //show chi tiết hóa đơn
    public function add_ChiTietHoaDon($SHD){
        $this-> AuthLogin();
        $Hoa_Don = DB::table('tbl_hoadon')->where('SHDon', $SHD)->get();
        $Hang_Hoa = DB::table('tbl_hanghoa')->orderBy('MaHangHoa','desc')->get();
        return view('admin.add_ChiTietHoaDon')->with('HangHoa',$Hang_Hoa)->with('HoaDon',$Hoa_Don);
    }

    public function show_all_ChiTietHoaDon(){
        $this-> AuthLogin();
        $query = DB::table('tbl_chitiethoadon');
        if ($key = request()->key) {
            $query->where('TenHH', 'like', '%' . $key . '%')->paginate(10);
        }
        $item = $query->paginate(10);
        return view('admin.show_all_ChiTietHoaDon', ['item' => $item]);
    }

    public function listChiTietHoaDon($SoHD){
        $this-> AuthLogin();
        $item = DB::table('tbl_chitiethoadon')->where('SoHD',$SoHD);
        if (!$item->exists()) {
            Session::put('message', 'Số hóa đơn này chưa có sản phẩm!!!');
            return Redirect::to('show-HoaDon');
        } else {
            $item = DB::table('tbl_chitiethoadon')->where('SoHD',$SoHD)->get();
        }
        $item2 = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->get();
        $madn = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->value('MaDN_id');
        $item3 = DB::table('tbl_doanhnghiep')->where('id', $madn)->get();  
        $chitietdonhang = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->value('MaHH_id');
        $hh = DB::table('tbl_hanghoa')->where('MaHangHoa', $chitietdonhang)->value('NhaCungCap_id');
        $item4 = DB::table('tbl_nhacungcap')->where('id', $hh)->get();
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='TenCTHD_A_Z'){
                $ChiTietHoaDon = DB::table('tbl_chitiethoadon')->where('SoHD',$SoHD)->orderBy('TenHH','ASC')->get();
                $item = $ChiTietHoaDon;
            }elseif($sort_by=='TongTH'){
                $ChiTietHoaDon = DB::table('tbl_chitiethoadon')->where('SoHD',$SoHD)->orderBy('ThanhTien','DESC')->get();
                $item = $ChiTietHoaDon;
            }elseif($sort_by=='TTST'){
                $ChiTietHoaDon = DB::table('tbl_chitiethoadon')->where('SoHD',$SoHD)->orderBy('ThanhTienSauThue','DESC')->get();
                $item = $ChiTietHoaDon;
            }
        }
        return view('admin.show_ChiTietHoaDon', compact('item','item2','item3','item4'));
    }

    public function save_ChiTietHoaDon(Request $request)
    {
        $this-> AuthLogin();
        $existingChiTietHoaDon = DB::table('tbl_chitiethoadon')
            ->where('TenHH', $request->TenHH_ChiTietHoaDon)
            ->where('SoHD', $request->SoHoaDon_ChiTietHoaDon)
            ->first();
        if ($existingChiTietHoaDon) {
            Session::put('message', 'Số hóa đơn này đã tồn tại.');
            return Redirect::to('show-HoaDon');
        }
        $MaHoaDon = DB::table('tbl_hoadon')->where('SHDon', $request->SoHoaDon_ChiTietHoaDon)->value('id');
        $MaHH = DB::table('tbl_hanghoa')->where('TenHangHoa', $request->TenHH_ChiTietHoaDon)->value('MaHangHoa');
        $giaBan = DB::table('tbl_hanghoa')->where('TenHangHoa', $request->TenHH_ChiTietHoaDon)->value('GiaBan');
        $thanhTien = $giaBan * $request->SL_ChiTietHoaDon;
        $giaTruocThueGTGT = $thanhTien - $thanhTien*($request->CK_HoaDon/100);
        $tienThueGTGT = $giaTruocThueGTGT * ($request->TS_HoaDon/100);
        $thanhTienSauThue = $giaTruocThueGTGT + $tienThueGTGT;
        $data = [
            'MaHD_id'=>$MaHoaDon,
            'MaHH_id' => $MaHH,
            'SoHD' => $request->SoHoaDon_ChiTietHoaDon,
            'TenHH' => $request->TenHH_ChiTietHoaDon,
            'DonGia' => $giaBan,
            'ThanhTien'=>$thanhTien,
            'TienThueGTGT' => $tienThueGTGT,
            'GiaTruocThueGTGT' =>$giaTruocThueGTGT,
            'ThanhTienSauThue' =>$thanhTienSauThue,
            'SoLuong' => $request->SL_ChiTietHoaDon,
            'ChietKhau' => $request->CK_HoaDon,
            'ThueSuat' => $request->TS_HoaDon
        ];
        DB::table('tbl_chitiethoadon')->insert($data);
        Session::put('message', 'Thêm hàng hóa thành công!');
        return Redirect::to('show-HoaDon');
    }
    public function edit_ChiTietHoaDon($ChiTietHoaDon_id){
        $this-> AuthLogin();
        $item = DB::table('tbl_chitiethoadon')->where('id',$ChiTietHoaDon_id)->get();
        $Hang_Hoa = DB::table('tbl_hanghoa')->orderBy('MaHangHoa','desc')->get();
        return view('admin.edit_ChiTietHoaDon', ['item' => $item])->with('hanghoa',$Hang_Hoa);
    }
    public function update_ChiTietHoaDon(Request $request, $ChiTietHoaDon_id)
    {
        $this-> AuthLogin();
        $existingHoaDon = DB::table('tbl_chitiethoadon')
            ->where('id', $ChiTietHoaDon_id)
            ->first();
        if (!$existingHoaDon) {
            Session::put('message', 'Không tìm thấy hóa đơn cần tìm.');
            return redirect()->back();
        }
        $giaBan = DB::table('tbl_hanghoa')->where('TenHangHoa', $request->TenHH_ChiTietHoaDon)->value('GiaBan');
        $thanhTien = $giaBan * $request->SL_ChiTietHoaDon;
        $giaTruocThueGTGT = $thanhTien - $thanhTien*($request->CK_HoaDon/100);
        $tienThueGTGT = $giaTruocThueGTGT * ($request->TS_HoaDon/100);
        $thanhTienSauThue = $giaTruocThueGTGT + $tienThueGTGT;

        $data = [
            'SoHD' => $request->SoHoaDon_ChiTietHoaDon,
            'TenHH' => $request->TenHH_ChiTietHoaDon,
            'DonGia' => $giaBan,
            'ThanhTien'=>$thanhTien,
            'TienThueGTGT' => $tienThueGTGT,
            'GiaTruocThueGTGT' =>$giaTruocThueGTGT,
            'ThanhTienSauThue' =>$thanhTienSauThue,
            'SoLuong' => $request->SL_ChiTietHoaDon,
            'ChietKhau' => $request->CK_HoaDon,
            'ThueSuat' => $request->TS_HoaDon
        ];
        DB::table('tbl_chitiethoadon')->where('id', $ChiTietHoaDon_id)->update($data);
        Session::put('message', 'Cập nhật hóa đơn thành công!');
        return redirect()->back();
    }
    public function delete_ChiTietHoaDon($ChiTietHoaDon_id){
        $this-> AuthLogin();
        DB::table('tbl_chitiethoadon')->where('id', $ChiTietHoaDon_id)->delete();
        Session::put('message', 'Xóa hóa đơn thành công!');
        return redirect()->back();
    }


    //Tải hóa đơn xml
    public function show_importFileDauVao(){
        $this-> AuthLogin();
        return view('admin.import_FileDauVao');
    }
    public function import_hoadonDauVao(Request $req){
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

        // Nhà cung cấp
        if (count($xmlObject->DLHDon -> NDHDon->NBan) > 0) {
            $dataArray1 = [];
            foreach ($xmlObject->DLHDon->NDHDon->NBan as $index => $data) {
                $dataArray1[] = [
                    "Ten" => (string) $data->Ten,
                    "MST" => (string) $data->MST,
                    "DChi" => (string) $data->DChi,
                    "SDThoai" => (string) $data->SDThoai,
                    "DCTDTu" => (string) $data->DCTDTu,
                    "Fax"   => (string) $data->Fax,
                ];
            }
        }
        $mst = (string) $xmlObject->DLHDon->NDHDon->NBan[0]->MST;
        $existingNhaCungCap = DB::table('tbl_nhacungcap') ->where('MST', $mst) ->first();
        if (!$existingNhaCungCap) {
            DB::table('tbl_nhacungcap')->insert($dataArray1);
        }

        // Khách hàng
        if (count($xmlObject->DLHDon -> NDHDon->NMua) > 0) {
            $dataArray2 = [];
            foreach ($xmlObject->DLHDon->NDHDon->NMua as $index => $data) {
                $dataArray2[] = [
                    "Ten" => (string) $data->Ten,
                    "MST" => (string) $data->MST,
                    "DChi" => (string) $data->DChi,
                    "SDThoai" => (string) $data->SDThoai,
                    "DCTDTu" => (string) $data->DCTDTu,
                ];
            }
        }
        $mst = (string) $xmlObject->DLHDon->NDHDon->NMua[0]->MST;
        $existingDoanhNghiep = DB::table('tbl_doanhnghiep') ->where('MST', $mst) ->first();

        if (!$existingDoanhNghiep) {
            DB::table('tbl_doanhnghiep')->insert($dataArray2);
        } else {
            Session::put('message', 'Doanh nghiệp này đã có trên hệ thống! Các dữ liệu khác sẽ được lưu.');
        }

        //Hàng hóa
        if (count($xmlObject->DLHDon -> NDHDon->DSHHDVu->HHDVu) > 0) {
            $dataArray3 = [];
            foreach ($xmlObject->DLHDon->NDHDon->DSHHDVu->HHDVu as $index => $data) {
                $MaCC = DB::table('tbl_nhacungcap')->where('Ten', (string) $xmlObject->DLHDon->NDHDon->NBan->Ten)->value('id');
                $dataArray3[] = [
                    "TenHangHoa" => (string) $data->THHDVu,
                    "GiaBan" => (string) $data->DGia,
                    "DVT" => (string) $data->DVTinh,
                    "NhaCungCap_id" => $MaCC,
                ];
            }
        }
        $TenHangHoa = (string) $xmlObject->DLHDon->NDHDon->DSHHDVu->HHDVu[0]->THHDVu;
        $existingHangHoa = DB::table('tbl_hanghoa') ->where('TenHangHoa', $TenHangHoa) ->first();
        if (!$existingHangHoa) {
            DB::table('tbl_hanghoa')->insert($dataArray3);
        }else{
            Session::put('message', 'Hàng hóa này đã có trên hệ thống! Các dữ liệu khác sẽ được lưu.');
        }
        

        //Hóa đơn
        if (count($xmlObject->DLHDon -> TTChung) > 0) {
            $dataArray4 = [];
            foreach ($xmlObject->DLHDon -> TTChung as $index => $data) {
                $MaDN_id = DB::table('tbl_doanhnghiep')->where('Ten', (string) $xmlObject->DLHDon->NDHDon->NMua->Ten)->value('id');
                $dataArray4[] = [
                    "THDon" => (string) $data->THDon,
                    "SHDon" => (string) $data->SHDon,
                    "NLap" => new DateTime((string) $data->NLap),
                    "File" => $file->getClientOriginalName(),
                    "MaDN_id" => $MaDN_id,
                    'PTTT' => (string) $data->HTTToan,
                    'MaThamChieu' => (string) $xmlObject->MCCQT,
                    'TrangThai' => 0,
                    "TenNCC" => (string) $xmlObject->DLHDon -> NDHDon->NBan->Ten
                ];  
            }
        }
        
        $SHDon = (string) $xmlObject->DLHDon -> TTChung[0]->SHDon;
        $existingHoaDon = DB::table('tbl_hoadon')->where('SHDon', $SHDon)->first();
        if (!$existingHoaDon) {
            DB::table('tbl_hoadon')->insert($dataArray4);
        }else{
            Session::put('message', 'Dữ liệu này đã được upload lên rồi! Mời bạn thử lại!');
        }
        
        
        //chi tiet
        if (count($xmlObject->DLHDon->NDHDon->DSHHDVu->HHDVu) > 0) {
            $dataArray5 = [];
            foreach ($xmlObject->DLHDon->NDHDon->DSHHDVu->HHDVu as $data) {
                $thueSuat = (string) $data->TSuat;
                $thueSuat = str_replace('%', '', $thueSuat);
                $tienThueGTGT = (string) $data->ThTien * ($thueSuat/100);
                $thanhTienSauThue = (string) $data->ThTien + $tienThueGTGT;
                $MaHoaDon = DB::table('tbl_hoadon')->where('SHDon', (string) $xmlObject->DLHDon->TTChung->SHDon)->value('id');
                $MaHangH = DB::table('tbl_hanghoa')->where('TenHangHoa', (string)$data->THHDVu)->value('MaHangHoa');
                $dataArray5[] = [
                    "MaHD_id" => $MaHoaDon,
                    "SoHD" => (string) $xmlObject->DLHDon->TTChung->SHDon,
                    "MaHH_id" => $MaHangH,
                    "TenHH" => (string) $data->THHDVu,
                    "DonGia" => (string) $data->DGia,
                    "SoLuong" => (string) $data->SLuong,
                    "ThueSuat" => $thueSuat,
                    "ChietKhau" => 0,
                    "ThanhTien" => (string) $data->ThTien,
                    "GiaTruocThueGTGT" => (string) $data->ThTien,
                    "TienThueGTGT" => $tienThueGTGT,
                    "ThanhTienSauThue" => $thanhTienSauThue,
                ];
            } 
        }
        $SoHD = (string) $xmlObject->DLHDon->TTChung[0]->SHDon;
        $existingChiTietHoaDon = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->first();
        if (!$existingChiTietHoaDon) {
            DB::table('tbl_chitiethoadon')->insert($dataArray5);
        }else{
            Session::put('message', 'Dữ liệu này đã được upload lên rồi! Mời bạn thử lại!');
        }
        Session::put('message', 'Toàn bộ dữ liệu đã được tải lên thành công');
        
        //pdf
        $hoaDon = (string) $xmlObject->DLHDon->TTChung[0]->SHDon;
        if ($hoaDon) {
            if ($req->hasFile('PDF_file')) {
                $file = $req->file('PDF_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets'), $fileName);
                $existingFile = DB::table('tbl_hoadon')->where('SHDon', $SHDon)->value('TenFileThem');
                if ($existingFile) {
                    Session::put('message', 'Tệp pdf đã tồn tại. Vui lòng chọn tệp khác.');
                    return redirect()->back();
                }
                DB::table('tbl_hoadon')->where('SHDon', $SHDon)->update([
                    'TenFileThem' => $fileName,
                ]);
                Session::put('message', 'Tải lên thành công!');
                return redirect()->back();
            } else {
                Session::put('message', 'Có lỗi gì đó xảy ra');
            return redirect()->back();
            }
        }
    }

    //upload file pdf
    public function ThongTinThem($SHDon){
        $hd = DB::table('tbl_hoadon')->where('SHDon', $SHDon)->get();
        return view('admin.import_File', compact('hd'));
    }

    public function import_them(Request $req, $SHDon){
        $this-> AuthLogin();
        $hoaDon = DB::table('tbl_hoadon')->where('SHDon', $SHDon)->first();
        if ($hoaDon) {
            if ($req->hasFile('file')) {
                $file = $req->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets'), $fileName);
                DB::table('tbl_hoadon')->where('SHDon', $SHDon)->update([
                    'TenFileThem' => $fileName,
                ]);
                Session::put('message', 'Tải lên thành công!');
                return redirect()->back();
            } else {
                Session::put('message', 'Có lỗi gì đó xảy ra');
                return redirect()->back();
            }
        }
    }

    public function xemfilehoadon($id){
        $this-> AuthLogin();
        $data = DB::table('tbl_hoadon')->find($id);
        return view('admin.xemfilehoadon', compact('data'));
    } 
}