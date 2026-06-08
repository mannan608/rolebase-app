@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;

    $collection = $items instanceof \Illuminate\Pagination\AbstractPaginator
        ? $items->getCollection()
        : collect($items);

    $tableRowData = $collection->map(function ($university) {
        return [
            'id' => $university->id,
            'name' => $university->name,
            'slug' => $university->slug,
            'short_name' => $university->short_name,
            'status' => $university->status,
            'city' => $university->city,
            'country' => $university->country,
        ];
    })->values();

    $role = request()->route('role');
@endphp

<div x-data="{
    tableRowData: {{ \Illuminate\Support\Js::from($tableRowData) }},
    campusBaseUrl: {{ \Illuminate\Support\Js::from(url('/' . $role . '/campuses')) }},
    showDeleteModal: false,
    rowToDelete: null,

    openDeleteModal(row) {
        this.rowToDelete = row;
        this.showDeleteModal = true;
    },

    closeDeleteModal() {
        this.showDeleteModal = false;
        this.rowToDelete = null;
    },

    confirmDelete() {
        if (!this.rowToDelete) return;
        this.$refs.deleteForm.submit();
    },
 
}" @keydown.escape.window="closeDeleteModal()">
        <form x-ref="deleteForm" :action="rowToDelete ? (campusBaseUrl + '/' + rowToDelete.id) : '#'" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-[99999]">
            <div class="absolute inset-0 bg-gray-900/50" @click="closeDeleteModal()"></div>
            <div class="absolute inset-0 flex items-center justify-center p-4">
                <div class="w-full max-w-md rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl">
                    <div class="p-5">
                        <div class="text-base font-semibold text-gray-800 dark:text-white/90">Delete Campus?</div>
                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            This will permanently delete campus:
                            <span class="font-mono" x-text="rowToDelete ? rowToDelete.name : ''"></span>
                        </div>
                        <div class="mt-5 flex justify-end gap-3">
                            <button type="button" @click="closeDeleteModal()"
                                class="inline-flex items-center justify-center rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800">
                                Cancel
                            </button>
                            <button type="button" @click="confirmDelete()"
                                class="inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
        <div class="overflow-hidden rounded-xl border border-gray-100 dark:border-white/[0.05] bg-white">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 dark:bg-white/[0.02] border-b border-gray-100 dark:border-white/[0.05]">
                        <tr>
                            <th class="px-5 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                            <th class="px-5 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-5 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Short Name</th>
                            <th class="px-5 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-5 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/[0.05]">
                        <template x-if="tableRowData.length === 0">
                            <tr>
                                <td colspan="7" class="px-5 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No university records found.
                                </td>
                            </tr>
                        </template>
                        <template x-for="row in tableRowData" :key="row.id">
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01] transition-colors">
                                <td class="px-5 py-4">
                                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded text-xs font-mono" x-text="row.id"></span>
                                </td>
                               
                                <td class="px-5 py-4 text-sm text-gray-700 dark:text-gray-300" x-text="row.name"></td>
                                <td class="px-5 py-4 text-sm text-gray-500 dark:text-gray-400" x-text="row.short_name"></td>
                                <td class="px-5 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span x-text="row.city"></span>, <span x-text="row.country"></span>
                                </td>
                                <td class="px-5 py-4 text-sm">
                                    <span :class="row.status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'" class="px-2 py-0.5 rounded text-xs font-medium capitalize" x-text="row.status"></span>
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a :href="campusBaseUrl + '/' + row.id + '/edit'" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-lg transition-all">
                                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button type="button" @click="openDeleteModal(row)" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all">
                                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            
            @if ($items instanceof \Illuminate\Pagination\AbstractPaginator)
                <div class="px-5 py-4 border-t border-gray-100 dark:border-white/[0.05]">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    
</div>
