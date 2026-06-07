<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUniversityRequest;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UniversityController extends Controller
{
     public function __construct(
        private readonly UniversityRepositoryInterface $university,
    ) {}
       public function index(Request $request): View
    {
         $request->user()->can('university.list') || abort(403);

        return view('backend.pages.universities.index', [
            'universities' => $this->university->paginate(),
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
        $this->university->create($request->validated());
        return redirect()
            ->route('university.index')
            ->with('success', 'University created successfully.');
    }

    public function show(Request $request): View
    {
        $request->user()->can('university.view') || abort(403);

        return view('backend.pages.universities.show', [
            'university' => $roles_permission,
            'title' => 'University Details',
        ]);
       
    }

    public function edit(Request $request, string $role): View
    {
        $request->user()->can('university.edit') || abort(403);

        return view('backend.pages.universities.edit', [
            'university' => null,
            'title' => 'Edit University',
        ]);
       
    }

    public function update(StoreUniversityRequest $request, string $role ): RedirectResponse
    {
        $this->university->update($request->validated());
        return redirect()
            ->route('university.index')
            ->with('success', 'University updated successfully.');
    }

    public function destroy(Request $request, ): RedirectResponse
    {
        $this->university->delete($request->validated());
        return redirect()
            ->route('university.index')
            ->with('success', 'University deleted successfully.');
    }
}
