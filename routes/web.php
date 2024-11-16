<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\MediumPriorityController;
use App\Http\Controllers\OutputInvoiceController;
use App\Http\Controllers\readxmlHoaDonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('dashboard');
Route::get('/logout', [AdminController::class, 'log_out'])->name('log_out');
Route::post('/admin-dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


//Hóa đơn đầu vào
//Nhà cung cấp
Route::get('/add-NhaCungCap', [BillController::class, 'add_NhaCungCap'])->name('add_NhaCungCap');
// Route::get('/show-NhaCungCap', [BillController::class, 'show_NhaCungCap'])->name('show_NhaCungCap');
Route::get('/edit-NhaCungCap/{id}', [BillController::class, 'edit_NhaCungCap'])->name('edit_NhaCungCap');
Route::get('/delete-NhaCungCap/{id}', [BillController::class, 'delete_NhaCungCap'])->name('delete_NhaCungCap');
Route::get('/show-NhaCungCap', [BillController::class, 'list'])->name('list');
Route::post('/save-NhaCungCap', [BillController::class, 'save_NhaCungCap'])->name('save_NhaCungCap');
Route::post('/update-NhaCungCap/{id}', [BillController::class, 'update_NhaCungCap'])->name('update_NhaCungCap');

//Khách hàng
Route::get('/add-DoanhNghiep', [BillController::class, 'add_DoanhNghiep'])->name('add_DoanhNghiep');
Route::get('/add-DoanhNghiep', [BillController::class, 'listDoanhNghiep'])->name('listDoanhNghiep');
Route::get('/edit-DoanhNghiep/{id}', [BillController::class, 'edit_DoanhNghiep'])->name('edit_DoanhNghiep');
Route::get('/delete-DoanhNghiep/{id}', [BillController::class, 'delete_DoanhNghiep'])->name('delete_DoanhNghiep');
Route::post('/save-DoanhNghiep', [BillController::class, 'save_DoanhNghiep'])->name('save_DoanhNghiep');
Route::post('/update-DoanhNghiep/{id}', [BillController::class, 'update_DoanhNghiep'])->name('update_DoanhNghiep');

//Hàng hóa
Route::get('/add-HangHoa', [BillController::class, 'add_HangHoa'])->name('add_HangHoa');
Route::get('/show-HangHoa/{id}', [BillController::class, 'listHangHoa'])->name('listHangHoa');
Route::get('/edit-HangHoa/{id}', [BillController::class, 'edit_HangHoa'])->name('edit_HangHoa');
Route::post('/save-HangHoa', [BillController::class, 'save_HangHoa'])->name('save_HangHoa');
Route::get('/delete-HangHoa/{id}', [BillController::class, 'delete_HangHoa'])->name('delete_HangHoa');
Route::post('/save-HangHoa', [BillController::class, 'save_HangHoa'])->name('save_HangHoa');
Route::post('/update-HangHoa/{id}', [BillController::class, 'update_HangHoa'])->name('update_HangHoa');

//Hóa đơn
Route::get('/add-HoaDon', [BillController::class, 'add_HoaDon'])->name('add_HoaDon');
Route::get('/show-HoaDon', [BillController::class, 'listHoaDon'])->name('listHoaDon');
Route::get('/edit-HoaDon/{id}', [BillController::class, 'edit_HoaDon'])->name('edit_HoaDon');
Route::get('/delete-HoaDon/{id}', [BillController::class, 'delete_HoaDon'])->name('delete_HoaDon');
Route::post('/save-HoaDon', [BillController::class, 'save_HoaDon'])->name('save_HoaDon');
Route::post('/update-HoaDon/{id}', [BillController::class, 'update_HoaDon'])->name('update_HoaDonHangHoa');

//Chi tiết hóa đơn
Route::get('/add-ChiTietHoaDon/{SHDon}', [BillController::class, 'add_ChiTietHoaDon'])->name('add_ChiTietHoaDon');
Route::get('/show-ChiTietHoaDon/{SHDon}', [BillController::class, 'listChiTietHoaDon'])->name('listChiTietHoaDon');
Route::get('/edit-ChiTietHoaDon/{id}', [BillController::class, 'edit_ChiTietHoaDon'])->name('edit_ChiTietHoaDon');
Route::get('/delete-ChiTietHoaDon/{id}', [BillController::class, 'delete_ChiTietHoaDon'])->name('delete_ChiTietHoaDon');
Route::post('/save-ChiTietHoaDon', [BillController::class, 'save_ChiTietHoaDon'])->name('save_ChiTietHoaDon');
Route::post('/update-ChiTietHoaDon/{id}', [BillController::class, 'update_ChiTietHoaDon'])->name('update_ChiTietHoaDon');
Route::get('/show-all-ChiTietHoaDon', [BillController::class, 'show_all_ChiTietHoaDon'])->name('show_all_ChiTietHoaDon');

//Upload file
Route::get('/show-importFileDauVao', [BillController::class, 'show_importFileDauVao'])->name('show_importFileDauVao');
Route::post('/import_hoadonDauVao', [BillController::class, 'import_hoadonDauVao'])->name('import_hoadonDauVao');
Route::get('/ThongTinThem/{SHDon}', [BillController::class, 'ThongTinThem'])->name('ThongTinThem');
Route::post('/import_them/{SHDon}', [BillController::class, 'import_them'])->name('import_them');
Route::get('/xemfilehoadon/{id}', [BillController::class, 'xemfilehoadon'])->name('xemfilehoadon');


Route::get('/show-importFileDauRa', [OutputInvoiceController::class, 'show_importFileDauRa'])->name('show_importFileDauRa');
Route::post('/import_hoadonDauRa', [OutputInvoiceController::class, 'import_hoadonDauRa'])->name('import_hoadonDauRa');
Route::get('/ThongTinThemDauRa/{SHDon}', [OutputInvoiceController::class, 'ThongTinThemDauRa'])->name('ThongTinThemDauRa');
Route::post('/import_themDauRa/{SHDon}', [OutputInvoiceController::class, 'import_themDauRa'])->name('import_themDauRa');
Route::get('/xemfilehoadondaura/{id}', [OutputInvoiceController::class, 'xemfilehoadondaura'])->name('xemfilehoadondaura');


//Thống kê
Route::get('/show-thongke', [MediumPriorityController::class, 'show_thongke'])->name('show_thongke');
Route::post('/filter-by-date', [MediumPriorityController::class, 'filter_by_date'])->name('filter_by_date');

Route::get('/thongkedoanhthu', [MediumPriorityController::class, 'thongkedoanhthu'])->name('thongkedoanhthu');
Route::get('/thongke-NhaCungCap/{id}', [MediumPriorityController::class, 'thongke_NhaCungCap'])->name('thongke_NhaCungCap');
Route::get('/thongke-KhachHang/{id}', [MediumPriorityController::class, 'thongke_KhachHang'])->name('thongke_KhachHang');



//In hóa đơn
Route::get('/print-bill/{SoHD}', [MediumPriorityController::class, 'print_bill'])->name('print_bill');

//lọc
Route::get('/lochoadon', [BillController::class, 'lochoadon'])->name('lochoadon');
Route::get('/lochoadondaura', [OutputInvoiceController::class, 'lochoadondaura'])->name('lochoadondaura');

Route::get('/locthongkedauvao/{id}', [MediumPriorityController::class, 'locthongkedauvao'])->name('locthongkedauvao');
Route::get('/locthongkedaura/{id}', [MediumPriorityController::class, 'locthongkedaura'])->name('locthongkedaura');
Route::get('/locthongkenhacungcap/{id}', [MediumPriorityController::class, 'locthongkenhacungcap'])->name('locthongkenhacungcap');
Route::get('/locthongkekhachhang/{id}', [MediumPriorityController::class, 'locthongkekhachhang'])->name('locthongkekhachhang');




//------------------------------------------------------------------------------------------------------------------------

//Hóa đơn đầu ra
Route::get('/XuLy-HoaDon/{SoHD}', [OutputInvoiceController::class, 'XuLy_HoaDon'])->name('XuLy_HoaDon');
Route::get('/XuLy-HoaDonDauRa/{SoHD}', [OutputInvoiceController::class, 'XuLy_HoaDonDauRa'])->name('XuLy_HoaDonDauRa');


//Hàng hóa Doanh nghiệp
Route::get('/show-HangHoaDoanhNghiep/{id}', [OutputInvoiceController::class, 'listHangHoaDoanhNghiep'])->name('listHangHoaDoanhNghiep');
Route::get('/edit-HangHoaDoanhNghiep/{id}', [OutputInvoiceController::class, 'edit_HangHoaDoanhNghiep'])->name('edit_HangHoaDoanhNghiep');
Route::get('/delete-HangHoaDoanhNghiep/{id}', [OutputInvoiceController::class, 'delete_HangHoaDoanhNghiep'])->name('delete_HangHoaDoanhNghiep');
Route::post('/update-HangHoaDoanhNghiep/{id}', [OutputInvoiceController::class, 'update_HangHoaDoanhNghiep'])->name('update_HangHoaDoanhNghiep');
Route::get('/edit-GiaHangHoaDoanhNghiep/{id}', [OutputInvoiceController::class, 'edit_GiaHangHoaDoanhNghiep'])->name('edit_GiaHangHoaDoanhNghiep');
Route::post('/update-GiaHangHoaDoanhNghiep/{id}', [OutputInvoiceController::class, 'update_GiaHangHoaDoanhNghiep'])->name('update_GiaHangHoaDoanhNghiep');



//Khách hàng
Route::get('/add-KhachHang', [OutputInvoiceController::class, 'add_KhachHang'])->name('add_KhachHang');
Route::get('/show-KhachHang', [OutputInvoiceController::class, 'show_KhachHang'])->name('show_KhachHang');
Route::get('/edit-KhachHang/{MaKhachHang}', [OutputInvoiceController::class, 'edit_KhachHang'])->name('edit_DoanhNghiep');
Route::get('/delete-KhachHang/{MaKhachHang}', [OutputInvoiceController::class, 'delete_KhachHang'])->name('delete_KhachHang');
Route::post('/save-KhachHang', [OutputInvoiceController::class, 'save_KhachHang'])->name('save_KhachHang');
Route::post('/update-KhachHang/{MaKhachHang}', [OutputInvoiceController::class, 'update_KhachHang'])->name('update_KhachHang');

//Hóa đơn
Route::get('/add-HoaDonDauRa', [OutputInvoiceController::class, 'add_HoaDonDauRa'])->name('add_HoaDonDauRa');
Route::get('/show-HoaDonDauRa', [OutputInvoiceController::class, 'listHoaDonDauRa'])->name('listHoaDonDauRa');
Route::get('/edit-HoaDonDauRa/{id}', [OutputInvoiceController::class, 'edit_HoaDonDauRa'])->name('edit_HoaDonDauRa');
Route::get('/delete-HoaDonDauRa/{id}', [OutputInvoiceController::class, 'delete_HoaDonDauRa'])->name('delete_HoaDonDauRa');
Route::post('/save-HoaDonDauRa', [OutputInvoiceController::class, 'save_HoaDonDauRa'])->name('save_HoaDonDauRa');
Route::post('/update-HoaDonDauRa/{id}', [OutputInvoiceController::class, 'update_HoaDonDauRa'])->name('update_HoaDonDauRa');

//Chi tiết hóa đơn
Route::get('/add-ChiTietHoaDonDauRa/{SoHoaDon}', [OutputInvoiceController::class, 'add_ChiTietHoaDonDauRa'])->name('add_ChiTietHoaDonDauRa');
Route::get('/show-ChiTietHoaDonDauRa/{SHDon}', [OutputInvoiceController::class, 'listChiTietHoaDonDauRa'])->name('listChiTietHoaDonDauRa');
Route::get('/edit-ChiTietHoaDonDauRa/{id}', [OutputInvoiceController::class, 'edit_ChiTietHoaDonDauRa'])->name('edit_ChiTietHoaDonDauRa');
Route::get('/delete-ChiTietHoaDonDauRa/{id}', [OutputInvoiceController::class, 'delete_ChiTietHoaDonDauRa'])->name('delete_ChiTietHoaDonDauRa');
Route::post('/save-ChiTietHoaDonDauRa', [OutputInvoiceController::class, 'save_ChiTietHoaDonDauRa'])->name('save_ChiTietHoaDonDauRa');
Route::post('/update-ChiTietHoaDonDauRa/{id}', [OutputInvoiceController::class, 'update_ChiTietHoaDonDauRa'])->name('update_ChiTietHoaDonDauRa');

