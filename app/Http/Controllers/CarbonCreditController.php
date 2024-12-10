<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carbon\CreditStoreRequest;
use App\Http\Requests\Carbon\CreditUpdateRequest;
use App\Models\CarbonCredit;
use App\Models\CarbonProject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CarbonCreditController extends Controller
{
    //Hiển thị danh sách các tín chỉ carbon
    public function index(): View {
        // Lấy danh sách tín chỉ carbon với thông tin dự án đi kèm (eager loading)
        $carbonCredits = CarbonCredit::with('projects')->paginate(10);
            // Trả về view với dữ liệu tín chỉ carbon
            //compact('carbonCredits'): Dữ liệu tín chỉ carbon được truyền đến view carbon-credits.index dưới dạng một biến $carbonCredits.
            return view('carbon-credits.index',compact('carbonCredits'));
            /*compact() dùng để truyền dữ liệu từ controller vào view. Nó tạo một mảng liên kết giữa tên biến và giá trị 
            của biến đó. Ví dụ, compact('carbonCredits') 
            tạo ra một mảng ['carbonCredits' => $carbonCredits] và gửi dữ liệu vào view carbon_credits.index.*/
    }

    //Hiển thị form tạo tín chỉ carbon mới
    public function create(): View {
        //Lấy tất cả các dự án carbon để người dùng chọn khi tạo tín chỉ mới
        $carbonProjects = CarbonProject::all();
            //Trả về view tạo tín chỉ với dữ liệu dự án
            return view('carbon-credits.create',compact('carbonProjects'));
            /*Dữ liệu các dự án được truyền vào view carbon-credits.create dưới dạng biến $carbonProjects, 
            dùng để người dùng có thể chọn dự án khi tạo tín chỉ carbon mới.*/
    }

    //Lưu tín chỉ carbon vào cơ sở dữ liệu
    public function store(CreditStoreRequest $request): RedirectResponse {
        //Lưu tín chỉ carbon vào cơ sở dữ liệu
        CarbonCredit::create($request->validated());
            //Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->route('carbon-credits.index')->with('success','carbon');
    }

    //Hiển thị thông tin chi tiết tín chỉ carbon
    public function show(CarbonCredit $carbonCredits): View {
        //Trả về view chi tiết tín chỉ với dữ liệu tín chỉ carbon
        return view('carbon-credits.show', compact('carbonCredits'));
    }

    //Hiển thị form chỉnh sửa tín chỉ carbon
    public function edit(CarbonCredit $carbonCredits): View {
        //Lấy tất cả các dự án để người dùng có thể chọn khi chỉnh sửa tín chỉ carbon
        $carbonProjects = CarbonProject::all();
            //Trả về view chỉnh sửa tín chỉ với dữ liệu tín chỉ carbon và danh sách dự án
            return view('carbon-credits.edit',compact('carbonCredits','carbonProjects'));
    }

    //Cập nhật tín chỉ carbon trong cơ sở dữ liệu
    public function update(CreditUpdateRequest $request, CarbonCredit $carbonCredits) {
      
        //Cập nhật tín chỉ carbon trong cơ sở dữ liệu
        $carbonCredits->update($request->validated());
            //Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->route('carbon-credits.index')->with('success','carbon up go');
    }

    //Xóa tín chỉ carbon khỏi cơ sở dữ liệu
    public function destroy(CarbonCredit $carbonCredits) {
        //Xóa tín chỉ carbon
        $carbonCredits->delete();
            //Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->route('carbon-credits.index')->with('success','carbon deleted');
    }
}
