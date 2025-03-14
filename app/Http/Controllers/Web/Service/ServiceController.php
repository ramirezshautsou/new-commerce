<?php

namespace App\Http\Controllers\Web\Service;

use App\Http\Controllers\Controller;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Service\Interfaces\ServiceTypeRepositoryInterface;
use Illuminate\View\View;

class ServiceController extends Controller
{
    protected ServiceRepositoryInterface $serviceRepository;
    protected ServiceTypeRepositoryInterface $serviceTypeRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository, ServiceTypeRepositoryInterface $serviceTypeRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->serviceTypeRepository = $serviceTypeRepository;
    }

    public function index(): View
    {
        $services = $this->serviceRepository->getAll();

        return view('services.index', compact('services'));
    }

}
