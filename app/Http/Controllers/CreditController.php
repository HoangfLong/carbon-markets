<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carbon\CreditStoreRequest;
use App\Http\Requests\Carbon\CreditUpdateRequest;
use App\Models\Credit;
use App\Models\Project;
use App\Repositories\CreditRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    protected $creditRepository;
    protected $projectRepository;

    public function __construct(
        CreditRepository $creditRepository,
        ProjectRepository $projectRepository,
        )
    {
        $this->creditRepository = $creditRepository;
        $this->projectRepository = $projectRepository;
    }

    //Index
    public function index(): View
    {
        $carbonCredits = $this->creditRepository->getAll();
        return view('carbon-credits.index', compact('carbonCredits'));
        /*compact() dùng để truyền dữ liệu từ controller vào view. Nó tạo một mảng liên kết giữa tên biến và giá trị 
            của biến đó. Ví dụ, compact('carbonCredits') 
            tạo ra một mảng ['carbonCredits' => $carbonCredits] và gửi dữ liệu vào view carbon_credits.index.*/
    }

    //Create
    public function create(): View
    {
        //Lấy tất cả các dự án carbon để người dùng chọn khi tạo tín chỉ mới
        $carbonProjects = $this->projectRepository->getAll();
        //Trả về view tạo tín chỉ với dữ liệu dự án
        return view('carbon-credits.create', compact('carbonProjects'));
        /*Dữ liệu các dự án được truyền vào view carbon-credits.create dưới dạng biến $carbonProjects, 
            dùng để người dùng có thể chọn dự án khi tạo tín chỉ carbon mới.*/
    }
    //Store
    public function store(CreditStoreRequest $request): RedirectResponse
    {

        $this->creditRepository->create($request->validated());
        //Redirect if successed
            return redirect()->route('credits.index')->with('success', 'carbon');
    }

    //Show
    public function show($id): View
    {
        $carbonCredits = $this->creditRepository->getById($id);
        //Return a view
            return view('carbon-credits.show', compact('carbonCredits'));
    }

    //Edit
    public function edit($id): View
    {
        $carbonCredits = $this->creditRepository->getById($id);
        $carbonProjects =  $carbonProjects = $this->projectRepository->getAll();
        //Return a view
            return view('carbon-credits.edit', compact('carbonCredits', 'carbonProjects'));
    }

    //Update
    public function update(CreditUpdateRequest $request, $id): RedirectResponse
    {
        $this->creditRepository->update($id, $request->validated());
        //Cập nhật tín chỉ carbon trong cơ sở dữ liệu
        //Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('credits.index')->with('success', 'carbon up go');
    }

    //Destroy
    public function destroy($id)
    {
        //Delete credit
        $this->creditRepository->delete($id);
        //Redirect if successed
        return redirect()->route('credits.index')->with('success', 'carbon deleted');
    }
}
