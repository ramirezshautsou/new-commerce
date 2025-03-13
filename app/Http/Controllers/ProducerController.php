<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ProducerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param ProducerRepositoryInterface $producerRepository
     * @param ProducerRepositoryInterface $productRepository
     */
    public function __construct(ProducerRepositoryInterface $producerRepository, ProducerRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->producerRepository = $producerRepository;
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $producers = $this->producerRepository->create($request->only([
            'name',
            'alias',
        ]));

        return redirect(route('producers.index'))->with('success', 'Producer successfully created.');
    }

    /**
     * @param int $producerId
     * @return View
     */
    public function edit(int $producerId): View
    {
        $producer = $this->producerRepository->findById($producerId);

        return view('producers.edit', compact('producer'));
    }

    /**
     * @param Request $request
     * @param int $producerId
     * @return RedirectResponse
     */
    public function update(Request $request, int $producerId): RedirectResponse
    {
        $producer = $this->producerRepository->findById($producerId);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:producers,alias,' . $producerId,
        ]);

        $producer->update($validatedData);

        return redirect(route('producers.index'))->with('success', 'Producer successfully updated.');
    }

    /**
     * @param int $producerId
     * @return RedirectResponse
     */
    public function destroy(int $producerId): RedirectResponse
    {
        $producer = $this->producerRepository->findById($producerId);
        $producer->delete();

        return redirect(route('producers.index'))->with('success', 'Producer successfully deleted.');
    }
}
