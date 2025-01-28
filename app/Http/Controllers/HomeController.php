<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository) 
    {
        $this->projectRepository = $projectRepository;
    }

    public function home(): View 
    {
        return view('home');
    }
     //Marketplace view
    public function market(): View 
    {
        $carbonProjects = $this->projectRepository->getAll()->where('status', 'Certified');
            return view('marketplace',compact('carbonProjects'));
    }
}
