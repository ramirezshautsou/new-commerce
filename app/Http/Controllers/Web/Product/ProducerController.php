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
     * @var ProducerRepositoryInterface
     */
    protected ProducerRepositoryInterface $productRepository;
    /**
     * @var ProducerRepositoryInterface
     */

    protected ProducerRepositoryInterface $producerRepository;

    /**
     * @var string $name
     */
    protected string $name;

    /**
     * @param ProducerRepositoryInterface $producerRepository
     * @param ProducerRepositoryInterface $productRepository
     */
    public function __construct(
        ProducerRepositoryInterface $producerRepository,
        ProducerRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
        $this->producerRepository = $producerRepository;
        $this->name = __('entities.producer');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $producers = $this->producerRepository->getAll();

        return view('producers.index', compact('producers'));
    }

    /**
     * @param int $producerId
     *
     * @return View
     */
    public function show(int $producerId): View
    {
        $producer = $this->producerRepository->getProductByProducer($producerId);

        return view('producers.show', compact('producer'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $producers = $this->producerRepository->getAll();

        return view('producers.create', compact('producers'));
    }

    /**
     * @param ProducerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ProducerRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->producerRepository->create($validatedData);

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
        $producer = $this->producerRepository->findById($producerId);

        return view('producers.edit', compact('producer'));
    }

    /**
     * @param ProducerRequest $request
     * @param int $producerId
     *
     * @return RedirectResponse
     */
    public function update(ProducerRequest $request, int $producerId): RedirectResponse
    {
        $producer = $this->producerRepository->findById($producerId);

        $validatedData = $request->validated();

        $producer->update($validatedData);

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
        $producer = $this->producerRepository->findById($producerId);
        $producer->delete();

        return redirect(route('producers.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => $this->name,
            ]));
    }
}
