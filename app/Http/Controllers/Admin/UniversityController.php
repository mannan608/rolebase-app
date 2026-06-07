<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UniversityController extends Controller
{
    public function __construct(
        UniversityRepositoryInterface $universityRepository,
    ) {
        $this->universityRepository = $universityRepository;
    }

       public function index(Request $request): View
    {
         $request->user()->can('university.list') || abort(403);

        return view('backend.pages.universities.index', [
            'universities' => $this->universityRepository->paginate(),
            'title' => 'Universities',
        ]);
    }

    public function create(Request $request): View
    {
        $request->user()->can('university.create') || abort(403);
        return view('backend.pages.universities.create', [
            'university' => null,
            'title' => 'Create University',
        ]);
    }

    public function store(StoreUniversityRequest $request): RedirectResponse
    {
        $this->universityRepository->create($request->validated());
        return redirect()
            ->route('university.index')
            ->with('success', 'University created successfully.');
    }

    public function show(Request $request): View
    {
        $request->user()->can('university.view') || abort(403);

        return view('backend.pages.universities.show', [
            'university' => $this->universityRepository->find($request->route('university')),
            'title' => 'University Details',
        ]);
       
    }

    public function edit(Request $request, string $role): View
    {
        $request->user()->can('university.edit') || abort(403);

        return view('backend.pages.universities.edit', [
            'university' => $this->universityRepository->find($request->route('university')),
            'title' => 'Edit University',
        ]);
       
    }

    public function update(UpdateUniversityRequest $request, string $role ): RedirectResponse
    {
        $this->universityRepository->update($request->route('university'), $request->validated());
        return redirect()
            ->route('university.index')
            ->with('success', 'University updated successfully.');
    }

    public function edit(Request $request, string $role): View
    {
        $request->user()->can('university.edit') || abort(403);

        return view('backend.pages.universities.edit', [
            'university' => $this->universityRepository->find($request->route('university')),
            'title' => 'Edit University',
        ]);
       
    }

    public function update(UpdateUniversityRequest $request, string $role ): RedirectResponse
    {
        $this->universityRepository->update($request->route('university'), $request->validated());
        return redirect()
            ->route('university.index')
            ->with('success', 'University updated successfully.');
    }

    public function destroy(Request $request, ): RedirectResponse
    {
        $this->universityRepository->delete($request->route('university'));
        return redirect()
            ->route('university.index')
            ->with('success', 'University deleted successfully.');
    }
}
