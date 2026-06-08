<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Models\University;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use App\SEO\Models\SeoMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UniversityController extends Controller
{
    protected $universityRepository;

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
        $data = $request->validated();

        $universityData = [];

        DB::beginTransaction();

        try {
            $universityData = Arr::only($data, [
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

            $universityData['slug'] = $this->generateUniqueSlug($request->name);

            // Handle Logo
            if ($request->hasFile('logo')) {
                $universityData['logo'] = $this->uploadFile($request->file('logo'), 'uploads/universities/logos');
            }

            // Handle Banner
            if ($request->hasFile('banner')) {
                $universityData['banner'] = $this->uploadFile($request->file('banner'), 'uploads/universities/banners');
            }

            DB::commit();

            return redirect()
                ->route('role.universities.index', ['role' => $request->route('role')])
                ->with('success', 'University created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Request $request): View
    {
        $request->user()->can('university.view') || abort(403);
        $university = $this->universityRepository->findById($request->route('university'));

        return view('backend.pages.universities.show', [
            'university' => $university,
            'title' => 'University Details',
        ]);
    }

    public function edit(Request $request, string $role, $id): View
    {
        $request->user()->can('university.edit') || abort(403);
        $university = $this->universityRepository->findById($id);

        return view('backend.pages.universities.edit', [
            'university' => $university,
            'title' => 'Edit University',
        ]);
    }

    public function update(UpdateUniversityRequest $request, string $role, $id): RedirectResponse
    {
        $data = $request->validated();
        $university = $this->universityRepository->findById($id);
        $universityData = [];

        DB::beginTransaction();

        try {
            $universityData = Arr::only($data, [
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

            if ($university->name !== $request->name) {
                $universityData['slug'] = $this->generateUniqueSlug($request->name, $university->id);
            }

            // Handle Logo
            if ($request->hasFile('logo')) {
                $universityData['logo'] = $this->uploadFile($request->file('logo'), 'uploads/universities/logos');
            }

            // Handle Banner
            if ($request->hasFile('banner')) {
                $universityData['banner'] = $this->uploadFile($request->file('banner'), 'uploads/universities/banners');
            }

            $university->update($universityData);

            DB::commit();

            return redirect()
                ->route('role.universities.index', ['role' => $request->route('role')])
                ->with('success', 'University updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request, string $role, $id): RedirectResponse
    {
        $request->user()->can('university.delete') || abort(403);
        $university = $this->universityRepository->findById($id);

        DB::beginTransaction();
        try {

            $university->delete();

            DB::commit();
            return redirect()
                ->route('role.universities.index', ['role' => $role])
                ->with('success', 'University deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $query = University::where('slug', 'LIKE', "{$slug}%");
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }
        $count = $query->count();
        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }

    protected function uploadFile($file, $path)
    {
        $destinationPath = public_path($path);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
        }
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);
        return $path . '/' . $fileName;
    }
}
