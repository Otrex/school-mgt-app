<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Community Resources</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">


                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Community Resources</h5>
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.community-resource.add') }}"><span class="bi bi-plus"></span></a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$resources" />
                                    </div>
                                    <div>
                                        <form>
                                            <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search ...">
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">Image</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Serial Number</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Community Center</th>
                                            <th scope="col">LGA</th>
                                            <th scope="col">Usage Time (Max)</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($resources as $resource)
                                        <tr wire:key="{{ $resource->id }}">
                                            <td><x-table-data :name="$resource->image" /></td>
                                            <td><x-table-data :name="$resource->type->name" /></td>
                                            <td><x-table-data :name="$resource->serial_number" /></td>
                                            <td><x-table-data :name="$resource->description" /></td>
                                            <td><x-table-data :name="$resource->status" /></td>
                                            <td><x-table-data :name="$resource->communityCenter->name" /></td>
                                                <td><x-table-data :name="$resource->communityCenter->localGovernment->name" /></td>
                                            <td><x-table-data :name="$resource->max_usage_time" /></td>
                                            <td>
                                                <div class="d-flex text-center">
                                                    <a href="{{ route('admin.community-resource.edit', $resource) }}" style="margin-right: 10px;">
                                                        <span class="bi bi-pencil-square"></span>
                                                    </a>
                                                    <span x-data="{ modal: false }">
                                                        <a href="javascript:void(0)" @click="modal = true" x-id="['delete-{{ $resource->id }}']">
                                                            <span class="bi bi-trash-fill text-danger"></span>
                                                        </a>
                                                        <div :id="$id('delete-{{ $resource->id }}')">
                                                            <div class="modal-wrapper" x-show="modal" x-cloak>
                                                                <div class="modal-bg-wrapper">
                                                                    <div class="modal-bg"></div>
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content-center">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="d-flex justify-content-end align-items-center py-2">
                                                                                <button @click="modal = false" class="close-btn">
                                                                                    <i class="bi bi-x-circle-fill"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="text-center">
                                                                                <div class="modal-icon">
                                                                                    <div class="bi bi-trash"></div>
                                                                                </div>
                                                                                <div class="bold mt-2">You are about to delete this item.</div>
                                                                                <div class="fs-12px">Are you sure?</div>
                                                                                <div class="mt-3">
                                                                                    <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                                                    <button type="button" class="btn btn-primary" wire:click="delete({{ $resource->id }})">
                                                                                        Confirm
                                                                                        <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="delete"></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </span>
                                                    <a class="px-2" href="{{ route('admin.community-resource.logs', $resource) }}">
                                                        <i class="bi bi-journal-text"></i> logs
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5"><div class="text-center"><em>Resource(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $resources->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>