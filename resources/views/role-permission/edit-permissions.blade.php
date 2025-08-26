@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-2">
        <div id="ajax-success" style="color:green; display:none;"></div>

        @if (session('success'))
            <div style="color:green">{{ session('success') }}</div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-12 px-0">
                <div class="card border border-danger">
                    <div class="card-header p-2">
                        <h5 class="mb-0">
                            Edit permissions for role: <strong>{{ $role->name }}</strong>
                        </h5>
                    </div>
                    <div class="card-body px-1 py-0">
                        <form id="permissionsForm">
                            @csrf
                            <table class="table table-bordered align-middle" id="yourTableId">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="globalMaster">
                                                <label class="form-check-label fw-bold" for="globalMaster">All
                                                    Categories</label>
                                            </div>
                                        </th>
                                        <th>Permission name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="fw-bold align-middle" style="width: 30%; white-space: normal;">
                                                <div class="form-check">
                                                    <input class="form-check-input category-master" type="checkbox"
                                                        id="parentCheck{{ $category->id }}"
                                                        data-category="cat_{{ $category->id }}">
                                                    <label class="form-check-label" for="parentCheck{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td style="white-space: normal;">
                                                @foreach ($category->permissions as $permission)
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input child-permission cat_{{ $category->id }}"
                                                            type="checkbox" name="permissions[]"
                                                            id="perm{{ $permission->id }}" value="{{ $permission->id }}"
                                                            data-role="{{ $role->id }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                        <label class="form-check-label me-3"
                                                            for="perm{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // parent toggle (no change, just trigger AJAX for each child)
        document.querySelectorAll('.category-master').forEach(masterCheckbox => {
            masterCheckbox.addEventListener('change', function() {
                const categoryClass = this.getAttribute('data-category');
                const childCheckboxes = document.querySelectorAll('.' + categoryClass);
                childCheckboxes.forEach(cb => {
                    cb.checked = this.checked;
                    triggerAjax(cb); // save change instantly
                });
            });
        });

        // Update parent checkbox when children change
        function updateParentCheckbox(categoryClass) {
            const all = document.querySelectorAll('.' + categoryClass);
            const allChecked = Array.from(all).every(cb => cb.checked);
            const master = document.querySelector('[data-category="' + categoryClass + '"]');
            if (master) master.checked = allChecked;
        }

        // AJAX call function
        function triggerAjax(checkbox) {
            let roleId = checkbox.dataset.role;
            let permId = checkbox.value;
            let isChecked = checkbox.checked;

            fetch(`/roles/${roleId}/update-permission`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        permission_id: permId,
                        checked: isChecked
                    })
                })
                .then(res => res.json())
                .then(data => {
                    let msgBox = document.getElementById('ajax-success');
                    msgBox.innerText = data.message;
                    msgBox.style.display = 'block';

                    // auto-hide after 3s
                    setTimeout(() => {
                        msgBox.style.display = 'none';
                    }, 3000);
                })
                .catch(err => console.error(err));
        }

        // child checkbox listener
        document.querySelectorAll('.child-permission').forEach(childCheckbox => {
            childCheckbox.addEventListener('change', function() {
                const categoryClass = Array.from(this.classList).find(c => c.startsWith('cat_'));
                updateParentCheckbox(categoryClass);
                triggerAjax(this); // save instantly
            });
        });

        // On page load, sync all parent checkboxes
        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.category-master').forEach(masterCheckbox => {
                const categoryClass = masterCheckbox.getAttribute('data-category');
                updateParentCheckbox(categoryClass);
            });
        });

        // Global master toggle → check/uncheck everything
        document.getElementById('globalMaster').addEventListener('change', function() {
            const allCategories = document.querySelectorAll('.category-master');
            allCategories.forEach(cat => {
                cat.checked = this.checked;

                // trigger category change (so it updates children + AJAX)
                cat.dispatchEvent(new Event('change'));
            });
        });

        // Sync global master when page loads or when any child changes
        function updateGlobalMaster() {
            const allChildren = document.querySelectorAll('.child-permission');
            const allChecked = Array.from(allChildren).every(cb => cb.checked);
            document.getElementById('globalMaster').checked = allChecked;
        }

        // hook into child checkboxes
        document.querySelectorAll('.child-permission').forEach(child => {
            child.addEventListener('change', updateGlobalMaster);
        });

        // run on load
        window.addEventListener('DOMContentLoaded', updateGlobalMaster);
    </script>
@endsection
