<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Models\University;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UniversityController extends Controller
{
    public function __construct(
        private readonly UniversityRepositoryInterface $universities
    ) {}

    public function index(Request $request): View
    {
        $request->user()->can('university.list') || abort(403);

        return view('backend.pages.universities.index', [
            'universities' => $this->universities->paginate(),
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
        $this->universities->create(
            $request->validated(),
            $request
        );

        return redirect()
            ->route('role.universities.index', [
                'role' => $request->route('role')
            ])
            ->with('success', 'University created successfully.');
    }

    public function show(
        Request $request,
        string $role,
        University $university
    ): View {
        $request->user()->can('university.view') || abort(403);

        return view('backend.pages.universities.show', [
            'university' => $university,
            'title' => 'University Details',
        ]);
    }

public function edit(
    Request $request,
    string $role,
    University $university
): View {
        $request->user()->can('university.edit') || abort(403);

        return view('backend.pages.universities.edit', [
            'university' => $university,
            'title' => 'Edit University',
        ]);
    }

    public function update(
        UpdateUniversityRequest $request,
        string $role,
        University $university
    ): RedirectResponse {
        $this->universities->update(
            $university,
            $request->validated(),
            $request
        );

        return redirect()
            ->route('role.universities.index', [
                'role' => $request->route('role')
            ])
            ->with('success', 'University updated successfully.');
    }

    public function destroy(
        Request $request,
        string $role,
        University $university
    ): RedirectResponse {
        $request->user()->can('university.delete') || abort(403);

        $this->universities->delete($university);

        return redirect()
            ->route('role.universities.index', [
                'role' => $role
            ])
            ->with('success', 'University deleted successfully.');
    }
}