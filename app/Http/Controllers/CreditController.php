<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\CreditRequest;
use App\Models\Standard;
use App\Services\CreditService;
use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class CreditController extends Controller
{
    protected $creditService;
    protected $projectService;

    public function __construct(
        CreditService $creditService,
        ProjectService $projectService
    ) {
        $this->creditService = $creditService;
        $this->projectService = $projectService;
    }

    //Index
    public function index(): View
    {
        $credits = $this->creditService->getAllCredits();
        return view('admin.credits.index', compact('credits'));
    }

    //Create
    public function create(): View
    {
        $projects = $this->projectService->getAllProjects();
        $standards = Standard::all();
        return view('admin.credits.create', compact('projects', 'standards'));
    }

    //Store
    public function store(CreditRequest $request): RedirectResponse
    {
        $this->creditService->createCredit($request->validated());
        return redirect()->route('credits.index')->with('success', 'Carbon credit created successfully');
    }

    //Show
    public function show($id): View
    {
        $carbonCredits = $this->creditService->getCreditById($id);
        return view('admin.credits.show', compact('carbonCredits'));
    }

    //Edit
    public function edit($id): View
    {
        $credits = $this->creditService->getCreditById($id);
        $projects = $this->projectService->getAllProjects();
        $standards = Standard::all();
        return view('admin.credits.edit', compact('credits', 'projects', 'standards'));
    }

    //Update
    public function update(CreditRequest $request, $id): RedirectResponse
    {
        $this->creditService->updateCredit($id, $request->validated());
        return redirect()->route('credits.index')->with('success', 'Carbon credit updated successfully');
    }

    //Destroy
    public function destroy($id): RedirectResponse
    {
        $this->creditService->deleteCredit($id);
        return redirect()->route('credits.index')->with('success', 'Carbon credit deleted successfully');
    }
}