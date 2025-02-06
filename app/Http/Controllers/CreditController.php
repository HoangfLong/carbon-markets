<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\CreditUpdateRequest;
use App\Http\Requests\Credit\CreditStoreRequest;
use App\Models\Standard;
use App\Repositories\Eloquent\CreditRepository;
use App\Repositories\Eloquent\ProjectRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


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

        return view('admin.credits.index', compact('carbonCredits'));
        /*compact() dùng để truyền dữ liệu từ controller vào view. Nó tạo một mảng liên kết giữa tên biến và giá trị 
            của biến đó. Ví dụ, compact('carbonCredits') 
            tạo ra một mảng ['carbonCredits' => $carbonCredits] và gửi dữ liệu vào view carbon_credits.index.*/
    }

    //Create
    public function create(): View
    {
        //Lấy tất cả các dự án carbon để người dùng chọn khi tạo tín chỉ mới
        $carbonProjects = $this->projectRepository->getAll();
        $standards = Standard::all();
        //Trả về view tạo tín chỉ với dữ liệu dự án
        return view('admin.credits.create', compact('carbonProjects','standards'));
        /*Dữ liệu các dự án được truyền vào view carbon-credits.create dưới dạng biến $carbonProjects, 
            dùng để người dùng có thể chọn dự án khi tạo tín chỉ carbon mới.*/
    }

    //Store
    public function store(CreditStoreRequest $request): RedirectResponse
    {
        // dd($request->all());
        $this->creditRepository->create($request->validated());
        //Redirect if successed
        return redirect()->route('credits.index')->with('success', 'carbon');
    }

    //Show
    public function show($id): View
    {
        $carbonCredits = $this->creditRepository->getById($id);
        //Return a view
        return view('admin.credits.show', compact('carbonCredits'));
    }

    //Edit
    public function edit($id): View
    {
        $carbonCredits = $this->creditRepository->getById($id);
        $carbonProjects = $this->projectRepository->getAll();
        $standards = Standard::all();
        //Return a view
        return view('admin.credits.edit', compact('carbonCredits', 'carbonProjects','standards'));
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
    public function destroy($id): RedirectResponse
    {
        //Delete credit
        $this->creditRepository->delete($id);
        //Redirect if successed
        return redirect()->route('credits.index')->with('success', 'carbon deleted');
    }
}
