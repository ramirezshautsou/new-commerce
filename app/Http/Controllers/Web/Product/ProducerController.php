<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProducerRequest;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProducerController extends Controller
{
    /**
     * @var string $name
     */
    protected string $name;

    /**
     * @param ProducerRepositoryInterface $producerRepository
     * @param ProducerRepositoryInterface $productRepository
     */
    public function __construct(
        protected ProducerRepositoryInterface $producerRepository,
        protected ProducerRepositoryInterface $productRepository,
    )
    {
        $this->name = __('entities.producer');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('producers.index', [
            'producers' => $this->producerRepository
                ->getAll(),
        ]);
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
        return view('producers.create', [
            'producers' => $this->producerRepository
                ->getAll(),
        ]);
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
            ->with('success', __('messages.created_success', [
                'name' => $this->name,
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
        $producer = $this->producerRepository
            ->findById($producerId);
        $producer->update($request->validated());

        return redirect(route('producers.index'))
            ->with('success', __('messages.updated_success', [
                'name' => $this->name,
            ]));
    }

    /**
     * @param int $producerId
     *
     * @return RedirectResponse
     */
    public function destroy(int $producerId): RedirectResponse
    {
        $producer = $this->producerRepository
            ->findById($producerId);
        $producer->delete();

        return redirect(route('producers.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => $this->name,
            ]));
    }
}
