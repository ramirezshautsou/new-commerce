<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProducerRequest;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use App\Services\ProducerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProducerController extends Controller
{
    /**
     * @param ProducerRepositoryInterface $producerRepository
     * @param ProducerService $producerService
     */
    public function __construct(
        protected ProducerRepositoryInterface $producerRepository,
        protected ProducerService $producerService,
    ) {}

    /**
     * @return View
     */
    public function index(): View
    {
        return view('producers.index');
    }

    /**
     * @param int $producerId
     *
     * @return View
     */
    public function show(int $producerId): View
    {
        return view('producers.show', [
            'producer' => $this->producerRepository
                ->getProductByProducer($producerId),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('producers.create');
    }

    /**
     * @param ProducerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ProducerRequest $request): RedirectResponse
    {
        $this->producerRepository
            ->create($request->validated());

        return redirect(route('producers.index'))
            ->with('success', __('messages.create_success', [
                'name' => __('entities.producer'),
            ]));
    }

    /**
     * @param int $producerId
     *
     * @return View
     */
    public function edit(int $producerId): View
    {
        return view('producers.edit', [
            'producer' => $this->producerRepository
                ->findById($producerId),
        ]);
    }

    /**
     * @param ProducerRequest $request
     * @param int $producerId
     *
     * @return RedirectResponse
     */
    public function update(ProducerRequest $request, int $producerId): RedirectResponse
    {
        $this->producerService
            ->updateProducer($request, $producerId);

        return redirect(route('producers.index'))
            ->with('success', __('messages.update_success', [
                'name' => __('entities.producer'),
            ]));
    }

    /**
     * @param int $producerId
     *
     * @return RedirectResponse
     */
    public function destroy(int $producerId): RedirectResponse
    {
        $this->producerService
            ->deleteProducer($producerId);

        return redirect(route('producers.index'))
            ->with('success', __('messages.delete_success', [
                'name' => __('entities.producer'),
            ]));
    }
}
