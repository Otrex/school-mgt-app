<main id="main" class="main">
    <div class="pagetitle">
        <h1>All Session</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Session</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total Session Card -->
                    <div class="col-xxl-12 col-md-12">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bar-chart-steps"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $session_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Student Card -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Sessions</h5>
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.session.add') }}"><span class="bi bi-plus"></span></a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$sessions" />
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
                                            <th scope="col">Session</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Default</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sessions as $session)
                                        <tr wire:key="{{ $session->id }}">
                                            <td><x-table-data :name="$session->session" /></td>
                                            <td><x-table-data :name="$session->start_date" /></td>
                                            <td><x-table-data :name="$session->end_date" /></td>
                                            <td><x-table-data :name="$session->default ? 'Yes' : 'No'" /></td>
                                            <td>
                                                <div class="d-flex text-center">
                                                    <a href="{{ route('admin.session.view', $session) }}" style="margin-right: 10px;"><span class="bi bi-eye-fill"></span></a>
                                                    {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete-{{ $session->id }}"><span class="bi bi-trash-fill text-danger"></span></a> --}}
                                                </div>

                                                {{-- Delete Modal --}}
                                                <div class="modal fade" id="delete-{{ $session->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <span class="bi bi-trash-fill text-danger fs-2"></span>
                                                                <div class="fs-6 bold">You are about to delete this session from the database</div>
                                                                <div>Are you sure?</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-primary" wire:click="delete({{ $session->id }})">
                                                                    <span>Confirm</span>
                                                                    <div wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="delete" role="status"></div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5"><div class="text-center"><em>Session(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $sessions->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</main><!-- End #main -->