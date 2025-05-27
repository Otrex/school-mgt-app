<main id="main" class="main">
    <div class="pagetitle">
        <h1>All School</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All School</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total School Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total School</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-buildings"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $school_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Student Card -->

                    <!-- Total Male Student -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                            <h5 class="card-title">States</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-globe-central-south-asia"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ count($state_count) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Female Student -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Local Governments</h5>

                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-globe"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ count($lga_count) }}</h6>
                            </div>
                            </div>
                        </div>

                        </div>
                    </div><!-- End Total Female Card -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <div x-data="{ filter: false }">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Schools</h5>
                                        <div>
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.school.add') }}"><span class="bi bi-plus"></span></a>
                                            <button type="button" class="btn btn-success btn-sm" @click="filter = !filter">
                                                <span class="bi bi-funnel-fill"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mb-3" x-show="filter" @click.outside="filter = false" x-cloak>
                                        <div class="col-xxl-12 mb-2">Filter by:</div>
                                        <div class="col-xxl-4 col-md-4 col-sm-12 mb-2">
                                            <select wire:model="state" id="" class="form-select form-select-sm">
                                                <option value="">--Select State--</option>
                                                @forelse ($states as $state)
                                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                @empty
                                                    <option value="">No state available</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-xxl-4 col-md-4 col-sm-12 mb-2">
                                            <select wire:model="local_government" id="" class="form-select form-select-sm">
                                                <option value="">--Select LGA--</option>
                                                @forelse ($local_governments as $lga)
                                                <option value="{{ $lga->name }}">{{ $lga->name }}</option>
                                                @empty
                                                    <option value="">No LGA available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="state" role="status"></div>
                                        </div>
                                        <div class="col-xxl-4 col-md-4 col-sm-12 mb-2">
                                            <select wire:model="town" id="" class="form-select form-select-sm">
                                                <option value="">--Select Town--</option>
                                                @forelse ($towns as $town)
                                                    <option value="{{ $town->name }}">{{ $town->name }}</option>
                                                @empty
                                                    <option value="">No town available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="local_government" role="status"></div>
                                        </div>
                                        <div class="col-xxl-12 col-md-12 col-sm-12 mb-2">
                                            <button type="button" wire:click="resetFilter" class="btn btn-primary btn-sm">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$schools" />
                                    </div>
                                    <div>
                                        <form>
                                            <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search school ...">
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">School</th>
                                            <th scope="col">State</th>
                                            <th scope="col">Local Government</th>
                                            <th scope="col">Town</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($schools as $school)
                                        <tr wire:key="{{ $school->id }}">
                                            <td><x-table-data :name="$school->name" /></td>
                                            <td><x-table-data :name="$school->state" /></td>
                                            <td><x-table-data :name="$school->local_government" /></td>
                                            <td><x-table-data :name="$school->town" /></td>
                                            <td>
                                                <div class="d-flex text-center">
                                                    <a href="{{ route('admin.school.view', $school) }}" style="margin-right: 10px;"><span class="bi bi-eye-fill"></span></a>
                                                    <span x-data="{ modal: false }">
                                                        <a href="javascript:void(0)" @click="modal = true" x-id="['delete-{{ $school->id }}']">
                                                            <span class="bi bi-trash-fill text-danger"></span>
                                                        </a>
                                                        <div :id="$id('delete-{{ $school->id }}')">
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
                                                                                <div class="bold mt-2">You are about to delete this school.</div>
                                                                                <div class="fs-12px">Are you sure?</div>
                                                                                <div class="mt-3">
                                                                                    <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                                                    <button type="button" class="btn btn-primary" wire:click="delete({{ $school->id }})">
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
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5"><div class="text-center"><em>School(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $schools->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>