<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 15;
    public $page = 1;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPage()
    {
        $this->resetPage();
    }


    public function mount()
    {
        $this->page = request()->query('page', 1);
    }

    public function updatedPage()
    {
        // This will be called when the page property changes
        // The render method will be called automatically
    }

    public function gotoPage($page)
    {
        $this->page = $page;
    }

    public function deletePermission($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);

        // Only allow deleting permissions that are not assigned to roles
        if ($permission->roles()->count() > 0) {
            $this->dispatch('error', 'Cannot delete permission that is assigned to roles.');
            return;
        }

        $permission->delete();
        $this->dispatch('success', 'Permission deleted successfully.');
    }

    public function render()
    {
        // Get all permissions matching the search term
        $allPermissions = Permission::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->get();

        // Group all permissions first
        $allGroupedPermissions = $allPermissions->groupBy(function ($permission) {
            // Standard CRUD permissions are typically in format: action model (e.g., 'view users', 'create projects')
            $parts = explode(' ', $permission->name, 2); // Limit to 2 parts to avoid breaking on multi-word descriptions

            if (count($parts) == 2) {
                $action = $parts[0]; // First part is the action (view, create, edit, delete)
                $model = $parts[1];  // Second part is the model

                // Only group standard CRUD actions with known models
                $crudActions = ['view', 'create', 'edit', 'delete', 'update'];
                $knownModels = ['roles', 'permissions', 'users', 'teams', 'projects', 'tasks', 'clients', 'invoices', 'reports'];

                if (in_array(strtolower($action), $crudActions) && in_array(strtolower($model), $knownModels)) {
                    return $model;
                }
            }

            // For permissions that don't follow standard CRUD pattern, group by action or put in 'other'
            return 'other';
        });

        // Now implement manual pagination for groups, fitting as many complete groups as possible within $this->perPage limit
        $currentPage = $this->page; // Use the public property
        $maxItemsPerPage = $this->perPage; // This is now the maximum number of individual permissions per page

        $groupKeys = $allGroupedPermissions->keys()->values();
        $totalGroups = $groupKeys->count();

        // Find which groups belong on the current page
        $currentGroups = collect();
        $itemCount = 0;
        $groupIndex = 0;
        $startIndex = 0;

        // Skip groups for previous pages
        for ($page = 1; $page < $currentPage; $page++) {
            $skippedCount = 0;
            while ($groupIndex < $totalGroups) {
                $currentGroup = $allGroupedPermissions->get($groupKeys[$groupIndex]);
                $groupSize = $currentGroup->count();

                // If adding this group would exceed the limit and we've added some items already, start new page
                if ($skippedCount > 0 && ($skippedCount + $groupSize) > $maxItemsPerPage) {
                    break; // Start next page
                }

                $skippedCount += $groupSize;
                $groupIndex++;

                if ($skippedCount >= $maxItemsPerPage) {
                    break; // Start next page
                }
            }
        }

        // Now collect groups for the current page
        $itemCount = 0;
        while ($groupIndex < $totalGroups && $itemCount < $maxItemsPerPage) {
            $currentGroup = $allGroupedPermissions->get($groupKeys[$groupIndex]);
            $groupSize = $currentGroup->count();

            // If adding this group would exceed the limit and we've already added some items, go to next page
            if ($itemCount > 0 && ($itemCount + $groupSize) > $maxItemsPerPage) {
                break; // This group will go on the next page
            }

            if ($itemCount + $groupSize <= $maxItemsPerPage) {
                $currentGroups->put($groupKeys[$groupIndex], $currentGroup);
                $itemCount += $groupSize;
                $groupIndex++;
            } else {
                break; // Cannot fit this group in current page
            }
        }

        // Calculate total pages based on grouped data
        $allGroupKeys = $allGroupedPermissions->keys()->values();
        $totalPages = 1;
        $tempIndex = 0;
        $calculatePage = 1;
        $tempItemCount = 0;

        while ($tempIndex < $allGroupKeys->count()) {
            $tempGroup = $allGroupedPermissions->get($allGroupKeys[$tempIndex]);
            $tempGroupSize = $tempGroup->count();

            if ($tempItemCount > 0 && ($tempItemCount + $tempGroupSize) > $maxItemsPerPage) {
                // Need to start a new page
                $calculatePage++;
                $tempItemCount = $tempGroupSize; // Start new page with current group
                $tempIndex++;
            } else if ($tempItemCount + $tempGroupSize <= $maxItemsPerPage) {
                // Can add this group to current page
                $tempItemCount += $tempGroupSize;
                $tempIndex++;
            } else {
                // Current group is too big for the page, start new page
                $calculatePage++;
                $tempItemCount = $tempGroupSize; // Start new page with current group
                $tempIndex++;
            }
        }
        $totalPages = $calculatePage;

        // Get the flat list of permissions for the current page to maintain pagination info
        $currentPermissions = collect();
        foreach ($currentGroups as $model => $modelPermissions) {
            foreach ($modelPermissions as $permission) {
                $currentPermissions->push($permission);
            }
        }

        // Create a paginator for the current page
        $paginatedPermissions = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPermissions,
            collect($allGroupedPermissions->flatten(1))->count(), // Total count of all permissions (flattened from groups)
            $maxItemsPerPage, // Items per page
            $currentPage, // Current page
            ['path' => request()->url(), 'pageName' => 'page']
        );

        // But update the paginator to reflect the actual pagination logic
        $paginatedPermissions->setCollection($currentPermissions);
        $paginatedPermissions->total($allPermissions->count()); // This may not be accurate for grouped pagination
        $paginatedPermissions->perPage($maxItemsPerPage);
        $paginatedPermissions->currentPage($currentPage);
        $paginatedPermissions->lastPage($totalPages);

        return view('livewire.permissions.index', [
            'permissions' => $paginatedPermissions,
            'groupedPermissions' => $currentGroups
        ]);
    }
}