<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProjectRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository) 
    {
        $this->projectRepository = $projectRepository;
    }

    public function index(): View 
    {
        $carbonProjects = $this->projectRepository->getAll();

        return view('home',compact('carbonProjects'));
    }

    //Marketplace view
    public function market(Request $request): View 
    {
        $search = $request->query('search'); // Get search input
        $sortBy = $request->query('sort_by');

        if ($search) {
            // Search only for projects matching the query
            $carbonProjects = $this->projectRepository->search($search);
        } else {
            // Default: show all certified projects
            $carbonProjects = $this->projectRepository->getAll()
                ->where('status', 'Certified');
        }

        // Áp dụng sắp xếp nếu có
        if ($sortBy) {
            switch ($sortBy) {
                case 'price_desc':
                    $carbonProjects = $carbonProjects->sortByDesc(function ($project) {
                        return $project->credits->first()->price_per_ton; // Sắp xếp theo giá giảm dần
                    });
                    break;
                case 'price_asc':
                    $carbonProjects = $carbonProjects->sortBy(function ($project) {
                        return $project->credits->first()->price_per_ton; // Sắp xếp theo giá tăng dần
                    });
                    break;
                case 'highest_rated':
                    // Implement sorting by rating (if applicable)
                    break;
                case 'newest':
                    $carbonProjects = $carbonProjects->sortByDesc('created_at'); // Sắp xếp theo thời gian tạo
                    break;
                default:
                    break;
            }
        }

        // Count orders
        $productCount = $carbonProjects->count();
    
        return view('marketplace', compact('carbonProjects', 'search','productCount','sortBy'));
    }
}
