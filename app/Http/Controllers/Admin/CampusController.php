<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampusRequest;
use App\Repositories\Interfaces\CampusRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCampusRequest;
use App\Models\Campus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $campusRepository;

    public function __construct(
        CampusRepositoryInterface $campusRepository,
    ) {
        $this->campusRepository = $campusRepository;
    }

    public function index(Request $request): View
    {
        $request->user()->can('campus.list') || abort(403);

        return view('backend.pages.campuses.index', [
            'campuses' => $this->campusRepository->paginate(),
            'title' => 'Campuses',
        ]);
    }

    public function create(Request $request): View
    {
        $request->user()->can('campus.create') || abort(403);
        return view('backend.pages.campuses.create', [
            'campus' => null,
            'title' => 'Create Campus',
        ]);
    }

    public function store(StoreCampusRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $campusData = [];

        DB::beginTransaction();

        try {
            $campusData = Arr::only($data, [
                'name',
                'short_name',
                'email',
                'phone',
                'website',
                'description',
                'country',
                'state',
                'city',
                'address',
                'status',
            ]);

            $campusData['slug'] = $this->generateUniqueSlug($request->name);
           

            DB::commit();

            return redirect()
                ->route('role.campuses.index', ['role' => $request->route('role')])
                ->with('success', 'Campus created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Request $request): View
    {
        $request->user()->can('campus.view') || abort(403);
        $campus = $this->campusRepository->findById($request->route('campus'));

        return view('backend.pages.campuses.show', [
            'campus' => $campus,
            'title' => 'Campus Details',
        ]);
    }

    public function edit(Request $request, string $role, $id): View
    {
        $request->user()->can('campus.edit') || abort(403);
        $campus = $this->campusRepository->findById($id);

        return view('backend.pages.campuses.edit', [
            'campus' => $campus,
            'title' => 'Edit Campus',
        ]);
    }

    public function update(UpdateCampusRequest $request, string $role, $id): RedirectResponse
    {
        $data = $request->validated();
        $campus = $this->campusRepository->findById($id);
        $campusData = [];

        DB::beginTransaction();

        try {
            $campusData = Arr::only($data, [
                'name',
                'short_name',
                'email',
                'phone',
                'website',
                'description',
                'country',
                'state',
                'city',
                'address',
                'status',
            ]);

            if ($campus->name !== $request->name) {
                $campusData['slug'] = $this->generateUniqueSlug($request->name, $campus->id);
            }
        

            $campus->update($campusData);

            DB::commit();

            return redirect()
                ->route('role.campuses.index', ['role' => $request->route('role')])
                ->with('success', 'Campus updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request, string $role, $id): RedirectResponse
    {
        $request->user()->can('campus.delete') || abort(403);
        $campus = $this->campusRepository->findById($id);

        DB::beginTransaction();
        try {

            $campus->delete();

            DB::commit();
            return redirect()
                ->route('role.campuses.index', ['role' => $role])
                ->with('success', 'Campus deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $query = Campus::where('slug', 'LIKE', "{$slug}%");
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }
        $count = $query->count();
        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
