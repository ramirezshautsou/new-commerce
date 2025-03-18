<?php

namespace App\Http\Controllers\Web\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    protected string $name;

    /**
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepository,
    )
    {
        $this->name = __('entities.service');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('services.index', [
            'services' => $this->serviceRepository->getAll(),
        ]);
    }

    public function create(): View
    {
        return view('services.create', [
            'services' => $this->serviceRepository
                ->getAll(),
        ]);
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $this->serviceRepository->create($request->validated());

        return redirect(route('services.index'))
            ->with('success', __('messages.create', [
                'name' => $this->name,
            ]));
    }

    public function show(int $serviceId): View
    {
        return view('services.show', [
            'service' => $this->serviceRepository
                ->findById($serviceId),
        ]);
    }

    public function edit(int $serviceId): View
    {
        return view('services.edit', [
            'service' => $this->serviceRepository->findById($serviceId),
        ]);
    }

    public function update(ServiceRequest $request, int $serviceId): RedirectResponse
    {
        $serviceId = $this->serviceRepository->findById($serviceId);
        $serviceId->update($request->validated());

        return redirect(route('services.index'))
            ->with('success', __('messages.updated_success', [
                'name' => $this->name,
            ]));
    }

    public function destroy(int $serviceId): RedirectResponse
    {
        $serviceId = $this->serviceRepository->findById($serviceId);
        $serviceId->delete();

        return redirect(route('services.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => $this->name,
            ]));
    }
}
