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
                                    <h5 class="card-title">Community Center Resources</h5>
                                    {{-- <a class="btn btn-primary btn-sm" href="{{ route('admin.community-resource.add') }}"><span class="bi bi-plus"></span></a> --}}
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$resources" />
                                    </div>
                                    <div >
                                        <form class="d-flex gap-2 align-items-center">
                                            <div>
                                                <select class="form-select" wire:model="center_id">
                                                    <option> --- Select Community Center --- </option>
                                                    @forelse ($centers as $center)
                                                    <option value="{{ $center->id }}">{{ $center->name }}</option>
                                                    @empty
                                                    <option value="">No Community Center available </option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div>
                                                <input
                                                    type="search"
                                                    wire:model="search"
                                                    class="form-control form-control-sm"
                                                    placeholder="Search ..."
                                                />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <style>
                                    table td {
                                        vertical-align: middle;
                                    }
                                </style>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">Image</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Serial Number</th>
                                            <th scope="col">Status</th>
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
                                            <td><x-table-data :name="$resource->status" /></td>
                                            <td>
                                                <div class="d-flex gap-2 text-center">
                                                    <span x-data="{ modal: false }">
                                                        <button class="btn btn-primary" href="javascript:void(0)" wire:click="fetchMemberLogs({{ $resource->id }})" @click="modal = true" x-id="['checkIn-{{ $resource->id }}']">
                                                            <i class="bi bi-person-workspace"></i> Check In
                                                        </button>
                                                        <div :id="$id('checkIn-{{ $resource->id }}')">
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
                                                                            <div class="text-left">
                                                                                <div>
                                                                                    @if ($latest_resource_activity)
                                                                                    <div class="row mb-3">
                                                                                        <label for="check_in" class=" text-nowrap col-form-label">Check In</label>
                                                                                        <div class="">
                                                                                            <input type="datetime" value="{{ $latest_resource_activity->check_in }}" disabled class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                        @if ($latest_resource_activity->check_out)
                                                                                        <div class="row mb-3">
                                                                                            <label for="check_out" class=" text-nowrap col-form-label">Check Out</label>
                                                                                            <div class="">
                                                                                                <input type="datetime" wire:model.defer="latest_resource_activity.check_out" disabled class="form-control">
                                                                                                <x-inline-error name="latest_resource_activity.check_out" />
                                                                                            </div>
                                                                                        </div>
                                                                                        @else
                                                                                        <div class="row mb-3">
                                                                                            <label for="check_out" class=" text-nowrap col-form-label">Check Out</label>
                                                                                            <div class="">
                                                                                                <input type="time" wire:model.defer="latest_resource_activity.check_out" class="form-control">
                                                                                                <x-inline-error name="latest_resource_activity.check_out" />
                                                                                            </div>
                                                                                        </div>
                                                                                        @endif
                                                                                    @else
                                                                                    <div class="row mb-3">
                                                                                        <label for="check_in" class=" col-form-label">Check In</label>
                                                                                        <div class="">
                                                                                            <input type="time" wire:model.defer="new_activity_check_in" class="form-control">
                                                                                            <x-inline-error name="check_in" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-3">
                                                                                        <label for="description" class=" col-form-label">Description</label>
                                                                                        <div class="">
                                                                                            <textarea class="form-control" wire:model.defer="new_activity_description" row="3"></textarea>
                                                                                            <x-inline-error name="resource.description" />
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="mt-3">
                                                                                    <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                                                    @if ($latest_resource_activity)
                                                                                    <button type="button" class="btn btn-primary" wire:click="checkOut">
                                                                                        Check-out
                                                                                        <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="delete"></span>
                                                                                    </button>
                                                                                    @else
                                                                                    <button type="button" class="btn btn-primary" wire:click="checkIn({{ $resource->id }})">
                                                                                        Confirm
                                                                                        <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="delete"></span>
                                                                                    </button>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </span>
                                                    {{-- <button class="btn btn-outline-primary px-2" href="{{ route('admin.community-resource.logs', $resource) }}">
                                                        <i class="bi bi-journal-text"></i> My Activity
                                                    </button> --}}
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