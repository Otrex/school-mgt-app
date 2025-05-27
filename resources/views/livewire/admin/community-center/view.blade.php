<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $center->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.community-center') }}">All Community Centers</a></li>
                <li class="breadcrumb-item active">{{ $center->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3" x-data="{ activeTab:  0 }">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">Edit Community Center</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Resources</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Community Center Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $center->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Town</div>
                                    <div class="col-lg-9 col-md-8">{{ $center->town->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Local Government</div>
                                    <div class="col-lg-9 col-md-8">{{ $center->localGovernment->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $center->address }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Manager</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($center->manager))
                                        <div>
                                            {{ $center->manager->first_name }} {{ $center->manager->last_name }}
                                        </div>
                                        @else
                                        <div> Not Assigned </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Opening Hours</div>
                                    <div class="col-lg-9 col-md-8">{{ $center->opening_hours }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Closing Hours</div>
                                    <div class="col-lg-9 col-md-8">{{ $center->closing_hours }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Is Active</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if ($center->is_active)
                                        <div> Yes </div>
                                        @else
                                        <div> No </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-overview">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$resources" />
                                    </div>
                                    <div class="d-flex flex-row gap-2">
                                        <form>
                                            <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search ...">
                                        </form>
                                        <a class="btn btn-primary btn-sm" @click="activeTab = 3">
                                            <span class="bi bi-plus"></span> Add New
                                        </a>
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
                                            <td>
                                                <div class="img-box">
                                                    @if ($resource->image)
                                                    <img src="{{ $resource->image }}" alt="{{ $resource->image }}" />
                                                    @else
                                                    <div class="placeholder">
                                                        <p> {{ $resource->serial_number }} </p>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
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
                                                                                    <button type="button" class="btn btn-primary" wire:click="deleteResource({{ $resource->id }})">
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

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="saveCenter">
                                    <div class="row mb-3">
                                        <label for="center" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="center.name" type="text" class="form-control" id="center">
                                            <x-inline-error name="center.name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="home_address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea wire:model.defer="center.address" type="text" class="form-control" id="address"></textarea>
                                            <x-inline-error name="center.address" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="local_government" class="col-md-4 col-lg-3 col-form-label">Manager</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="center.manager_id">
                                                <option value="">--Select--</option>
                                                @forelse ($members as $member)
                                                <option value="{{ $member->id }}">{{ $member->first_name }} {{ $member->last_name }}</option>
                                                @empty
                                                <option value="">No Member available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="center.state" role="status"></div>
                                            <x-inline-error name="center.manager_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="state" class="col-md-4 col-lg-3 col-form-label">States</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="center.state_id">
                                                <option value="">--Select--</option>
                                                @forelse ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @empty
                                                <option value="">No state available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="center.state_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="local_government" class="col-md-4 col-lg-3 col-form-label">Local Government</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="center.local_government_id">
                                                <option value="">--Select--</option>
                                                @forelse ($local_governments as $lga)
                                                <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                                @empty
                                                <option value="">No LGA available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="center.state" role="status"></div>
                                            <x-inline-error name="center.local_government_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="local_government" class="col-md-4 col-lg-3 col-form-label">Town</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="center.town_id">
                                                <option value="">--Select--</option>
                                                @forelse ($towns as $town)
                                                <option value="{{ $town->id }}">{{ $town->name }}</option>
                                                @empty
                                                <option value="">No Town available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="center.state" role="status"></div>
                                            <x-inline-error name="center.town_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="center" class="col-md-4 col-lg-3 col-form-label">Opening Hours</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="center.opening_hours" type="time" class="form-control" id="center">
                                            <x-inline-error name="center.opening_hours" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="center" class="col-md-4 col-lg-3 col-form-label">Closing Hours</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="center.closing_hours" type="time" class="form-control" id="center">
                                            <x-inline-error name="center.closing_hours" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="is_active" class="col-md-4 col-lg-3 col-form-label">Is Active</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" wire:model="center.is_active" type="checkbox" role="switch" id="is_active" checked>
                                                    <label class="form-check-label" for="is_active">&nbsp;</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="" class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-8">
                                            <x-button name="Save Changes" target="saveCenter" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            <div class="tab-pane fade profile-edit" :class="{ 'active show': activeTab === 3 }" x-show.transition.in.opacity.duration.600="activeTab === 3" id="profile-edit">
                                <div >
                                    <h5 class="card-title">Add Community Resource</h5>
                                    <!-- General Form Elements -->
                                    <form wire:submit.prevent="addResource">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" wire:model="type_id">
                                                    <option> --- Select --- </option>
                                                    @forelse ($resource_types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @empty
                                                    <option value="">No resource type available </option>
                                                    @endforelse
                                                </select>
                                                <x-inline-error name="type_id" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" wire:model.defer="image" placeholder="e.g TU4778H" class="form-control">
                                                <x-inline-error name="image" />
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Center</label>
                                            <div class="col-sm-10">
                                                <input type="text" disabled value="{{ $center->name }}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" wire:model.defer="description" row="3"></textarea>
                                                <x-inline-error name="description" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" wire:model="status">
                                                    <option> --- Select --- </option>
                                                    @forelse ($statuses as $status)
                                                    <option value="{{ $status }}">{{ $status }}</option>
                                                    @empty
                                                    <option value="">No Status available </option>
                                                    @endforelse
                                                </select>
                                                <x-inline-error name="status" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="serial_number" class="col-sm-2 col-form-label">Serial No</label>
                                            <div class="col-sm-10">
                                                <input type="text" wire:model.defer="serial_number" placeholder="e.g TU4778H" class="form-control">
                                                <x-inline-error name="serial_number" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="max_usage_time" class="col-sm-2 col-form-label">Max. Usage Time (In Minutes)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" wire:model.defer="max_usage_time" placeholder="e.g 20" class="form-control">
                                                <x-inline-error name="max_usage_time" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <x-button name="Add Resource" target="addResource" />
                                            </div>
                                        </div>
                                    </form><!-- End General Form Elements -->
                                </div>

                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->