<?php

namespace App\Http\Controllers\Web\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use App\Services\ServiceService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * @param ServiceRepositoryInterface $serviceRepository
     * @param ServiceService $serviceService
     */
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepository,
        protected ServiceService $serviceService,
    ) {}

    /**
     * @return View
     */
    public function index(): View
    {
        return view('services.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('services.create');
    }

    /**
     * @param ServiceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ServiceRequest $request): RedirectResponse
    {
        $this->serviceRepository
            ->create($request->validated());

        return redirect(route('services.index'))
            ->with('success', __('messages.create_success', [
                'name' => __('entities.service'),
            ]));
    }

    /**
     * @param int $serviceId
     *
     * @return View
     */
    public function show(int $serviceId): View
    {
        return view('services.show', [
            'service' => $this->serviceRepository
                ->findById($serviceId),
        ]);
    }

    /**
     * @param int $serviceId
     *
     * @return View
     */
    public function edit(int $serviceId): View
    {
        return view('services.edit', [
            'service' => $this->serviceRepository
                ->findById($serviceId),
        ]);
    }

    /**
     * @param ServiceRequest $request
     * @param int $serviceId
     *
     * @return RedirectResponse
     */
    public function update(ServiceRequest $request, int $serviceId): RedirectResponse
    {
        $this->serviceService
            ->updateService($request, $serviceId);

        return redirect(route('services.index'))
            ->with('success', __('messages.updated_success', [
                'name' => __('entities.service'),
            ]));
    }

    /**
     * @param int $serviceId
     *
     * @return RedirectResponse
     */
    public function destroy(int $serviceId): RedirectResponse
    {
        try {
            $this->serviceService
                ->deleteService($serviceId);

            return redirect(route('services.index'))
                ->with('success', __('messages.deleted_success', [
                    'name' => __('entities.service'),
                ]));
        } catch (Exception) {
            return back()->withErrors(__('messages.delete_failed'));
        }
    }
}
