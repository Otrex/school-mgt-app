<main id="main" class="main">
    <div class="pagetitle">
        <h1>All Town</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Town</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total Male Student -->
                    <div class="col-xxl-12 col-md-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                            <h5 class="card-title">Total</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-globe-central-south-asia"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $town_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <div x-data="{ filter: false }">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Towns</h5>
                                        <div>
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.town.add') }}"><span class="bi bi-plus"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$towns" />
                                    </div>
                                    <div>
                                        <form>
                                            <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search town ...">
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">Name</th>
                                            <th scope="col">State of origin</th>
                                            <th scope="col">Local government of origin</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($towns as $town)
                                        <tr wire:key="{{ $town->id }}">
                                            <td><x-table-data :name="$town->name" /></td>
                                            <td><x-table-data :name="$town->localGovernment->state->name" /></td>
                                            <td><x-table-data :name="$town->localGovernment->name" /></td>
                                            <td>
                                                <div class="d-flex text-center">
                                                    <a href="{{ route('admin.town.view', $town) }}" style="margin-right: 10px;"><span class="bi bi-eye-fill"></span></a>
                                                    <span x-data="{ modal: false }">
                                                        <a href="javascript:void(0)" @click="modal = true" x-id="['delete-{{ $town->id }}']">
                                                            <span class="bi bi-trash-fill text-danger"></span>
                                                        </a>
                                                        <div :id="$id('delete-{{ $town->id }}')">
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
                                                                                <div class="bold mt-2">You are about to delete this town.</div>
                                                                                <div class="fs-12px">Are you sure?</div>
                                                                                <div class="mt-3">
                                                                                    <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                                                    <button type="button" class="btn btn-primary" wire:click="delete({{ $town->id }})">
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
                                            <td colspan="5"><div class="text-center"><em>town(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $towns->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>