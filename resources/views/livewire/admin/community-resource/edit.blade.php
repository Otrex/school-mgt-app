<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1 class="mb-2">Edit {{ ucwords($resource->type) }}</h1> --}}
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.community-center') }}">
                    Community Center
                </a></li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.community-resource.edit', $resource) }}">
                        {{ ucwords($resource->type->name) }}
                    </a>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Resource: <b>{{ ucwords($resource->type->name) }}</b></h5>
                                </div>

                                <div class="">
                                    <!-- General Form Elements -->
                        <form wire:submit.prevent="update">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="resource.type_id">
                                        <option> --- Select --- </option>
                                        @forelse ($resource_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @empty
                                        <option value="">No available resource types </option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="resource.type_id" />

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" wire:model.defer="image" class="form-control">
                                    <x-inline-error name="image" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" wire:model.defer="resource.description" row="3"></textarea>
                                    <x-inline-error name="resource.description" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="center" class="col-sm-2 col-form-label">Community Center</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="resource.community_center_id">
                                        <option> --- Select --- </option>
                                        @forelse ($centers as $center)
                                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                                        @empty
                                        <option value="">No Community Center available </option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="resource.community_center_id" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="center" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="resource.status">
                                        <option> --- Select --- </option>
                                        @forelse ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                        @empty
                                        <option value="">No Status available </option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="resource.status" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="serial_number" class="col-sm-2 col-form-label">Serial No</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model="resource.serial_number" placeholder="e.g TU4778H" class="form-control">
                                    <x-inline-error name="resource.serial_number" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="max_usage_time" class="col-sm-2 col-form-label">Max. Usage Time (In Minutes)</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" wire:model="resource.max_usage_time" placeholder="e.g 20" class="form-control">
                                    <x-inline-error name="resource.max_usage_time" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Update Resource" target="update" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</main><!-- End #main -->