<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Community Resource</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.communities') }}">All Community Centers</a></li>
                <li class="breadcrumb-item active">Add New Resource</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Community Resource</h5>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="add">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="type" class="form-control" placeholder="e.g Computer, Printer">
                                    <x-inline-error name="type" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Center</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-4">
                                            <select class="form-select" wire:model="state">
                                                <option value="">--Select--</option>
                                                @forelse ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @empty
                                                <option value="">No state available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="state" role="status"></div>
                                        </div>
                                        <div class="col-4">
                                            <select class="form-select" wire:model="local_government" aria-label="Default select example">
                                                <option value="">--Select--</option>
                                                @forelse ($local_governments as $lga)
                                                <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                                @empty
                                                <option value="">No LGA available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="local_government" role="status"></div>
                                        </div>
                                        <div class="col-4">
                                            <select class="form-select" wire:model="center">
                                                @forelse ($centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                                                @empty
                                                <option value="">No center available </option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="center" role="status"></div>
                                    <x-inline-error name="center" />
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
                                <label for="opening_hours" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="status">
                                        <option> --- Select --- </option>
                                        @forelse ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status}}</option>
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
                                    <x-button name="Add Resource" target="add" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->