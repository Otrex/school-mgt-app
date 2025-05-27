<main id="main" class="main">

    <script>
        function html(data) {
            document.write(data);
        }

        function convert(number) {
            const formattedNumber = number.toLocaleString('en-US', {
                style: 'currency',
                currency: 'NGN', // Set currency code as per your requirement (default is USD)
                minimumFractionDigits: 0,
            });
            return formattedNumber.replace('NGN', '&#8358;');
        }
    </script>

    <div class="pagetitle">
        <h1>Community Center Maintenance</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Programs</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total Course Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                       <h1> <script>html(
                                        convert({{ $total_maintenance_funds }})
                                       )</script></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Student Card -->

                    <section class="section profile">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body pt-3" x-data="{ activeTab:  {{ $active_tab ?? 0 }} }">
                                        <!-- Bordered Tabs -->
                                        <ul class="nav nav-tabs nav-tabs-bordered">

                                            <li class="nav-item">
                                                <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">Request for Maintenance</button>
                                            </li>

                                            <li class="nav-item">
                                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">View Maintenance Requests</button>
                                            </li>

                                        </ul>
                                        <div class="tab-content pt-2">
                                            {{-- Exam Overview Details --}}
                                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                                <form wire:submit.prevent="record" class="py-4">

                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" wire:model.defer="title" class="form-control">
                                                            <x-inline-error name="name" />
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Community Center</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-select" wire:model="center">
                                                                @forelse ($centers as $center)
                                                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                                                                @empty
                                                                <option value="">No Centers available </option>
                                                                @endforelse
                                                            </select>
                                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="local_government" role="status"></div>
                                                            <x-inline-error name="center" />
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Resource</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-select" wire:model="resource">

                                                                @forelse ($resources as $resource)
                                                                <option value="{{ $resource->id }}">{{ $resource->type->name }}</option>
                                                                @empty
                                                                <option value="">No Resources available </option>
                                                                @endforelse
                                                                <option value=""> None </option>
                                                            </select>
                                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="local_government" role="status"></div>
                                                            <x-inline-error name="resource" />
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="inputPassword" class="col-sm-2 col-form-label"> Reason for Request</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" wire:model.defer="reason_for_request" style="height: 100px"></textarea>
                                                            <x-inline-error name="address" />
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Cost</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" min="0" wire:model.defer="cost" class="form-control">
                                                            <x-inline-error name="cost" />
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label class="col-md-4 col-lg-3 col-form-label"></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <x-button name="Save Changes" target="save" />
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            {{-- Edit Exam Form --}}
                                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div>
                                                            <x-entries-count :collection="$maintenances" />
                                                        </div>
                                                        <div class="d-flex flex-row gap-2">
                                                            <form>
                                                                <select class="form-select" wire:model="status_filter">
                                                                    @forelse ($maintenanceStatuses as $status)
                                                                    <option value="{{ $status }}">{{ $status }}</option>
                                                                    @empty
                                                                    <option value=""> - </option>
                                                                    @endforelse
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <table class="table table-stripped">
                                                        <thead>
                                                            <tr style="border-bottom: 1px solid #eee;">
                                                                <th scope="col">Title</th>
                                                                <th scope="col">Requester</th>
                                                                <th scope="col">Reason</th>
                                                                <th scope="col">Center</th>
                                                                <th scope="col">Cost</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($maintenances as $maintenance)
                                                            <tr wire:key="{{ $maintenance->id }}">
                                                                <td><x-table-data :name="$maintenance->title" /></td>
                                                                <td><x-table-data :name="$maintenance->requester->getFullNameAttribute()" /></td>
                                                                <td><x-table-data :name="$maintenance->reason_for_request" /></td>
                                                                <td><x-table-data :name="$maintenance->center->name .' '. ($maintenance->resource ? '('. $maintenance->resource->type->name.')': '')" /></td>
                                                                <td><x-table-data :name="$maintenance->cost" /></td>
                                                                <td>
                                                                    @if ($maintenance->status == 'pending' || $maintenance->status == null)
                                                                        <div>
                                                                            <button class="btn btn-primary" wire:click="approve({{ $maintenance->id }})">Approve</button>
                                                                            <button class="btn btn-danger" wire:click="reject({{ $maintenance->id }})">Reject</button>
                                                                        </div>
                                                                    @elseif ($maintenance->status === 'approved' && !$maintenance->is_fulfilled)
                                                                        <div>
                                                                            <button class="btn btn-primary" wire:click="execute({{ $maintenance->id }})"> Execute </button>
                                                                        </div>
                                                                    @elseif ($maintenance->is_fulfilled)
                                                                        <div>
                                                                            Executed
                                                                        </div>
                                                                    @else
                                                                        <div>
                                                                            {{ $maintenance->status }}
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="6"><div class="text-center"><em>Request(s) not available</em></div></td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                    {{ $maintenances->links('vendor.livewire.bootstrap') }}
                                                </div>
                                            </div>

                                            {{-- All Questions --}}
                                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</main><!-- End #main -->