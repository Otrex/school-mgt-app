<main id="main" class="main">
    <div class="pagetitle">
        <h1>Patrons</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Patrons</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <section class="section container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title" >
                            Total Contributions
                        </div>
                        <h1>
                            <livewire:currency-format :amount="$totals['patron_contribution']" />
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title" >
                            Total Maintenance Fund
                        </div>
                        <h1>
                            <livewire:currency-format :amount="$totals['maintenance_funds']" />
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title" >
                            Total Allocated Scholarships
                        </div>
                        <h1>
                            {{ $totals['allocated_scholarship'] }}
                        </h1>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="section container-fluid ">

        <div class="card">
            <div class="card-body pt-3" x-data="{ activeTab:  0 }">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" class="tab-control" :class="{ 'active': activeTab === 1 }">View Patron</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                        <div class="pt-3">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    There are a total of {{ $patron_members->count() }} patrons.
                                </div>
                            </div>
                            <table class="table table-stripped">
                                <thead>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th scope="col">Name</th>
                                        <th scope="col">Contributing For</th>
                                        <th scope="col">Slots</th>
                                        <th scope="col">Total Contibution</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($patron_members as $member)
                                    <tr wire:key="{{ $member->id }}">
                                        <td><x-table-data :name="$member->getFullNameAttribute()" /></td>
                                        <td><x-table-data :name="($member->patron->town ? $member->patron->town->name: 'All') . ' Scholars'" /></td>
                                        <td><x-table-data :name="$member->patron->no_of_slots" /></td>
                                        <td><livewire:currency-format :amount="$member->patron->verifiedTransactions()->sum('amount')" /></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <button class="btn" wire:click.prevent="view_patron({{ $member->patron->id }})" @click="activeTab = 1" >
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Enabled</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4"><div class="text-center"><em>Program lessons not available</em></div></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $patron_members->links('vendor.livewire.bootstrap') }}
                        </div>
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                        @if ($current_patron)
                            <div>
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <div>
                                            <b>Name:</b> {{ $current_patron->member->getFullNameAttribute() }}
                                        </div>
                                        <div>
                                            <b>Number of Scholarships:</b> {{ $current_patron->no_of_slots }}
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary" @click="activeTab = 2" >View Payment History</button>
                                    </div>
                                </div>
                                <div class="row g-3 mt-3">
                                    <div class="col-md-12">
                                        <h4>Beneficiaries</h4>

                                        <table class="table table-stripped">
                                            <thead>
                                                <tr style="border-bottom: 1px solid #eee;">
                                                    <th scope="col">Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($current_patron->scholarshipSlots()->whereNotNull('beneficiary_id')->get() as $slot)
                                                <tr wire:key="{{ $slot->id }}">
                                                    <td><x-table-data :name="$slot->beneficiary ? $slot->beneficiary->getFullNameAttribute(): '--'" /></td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4"><div class="text-center"><em>Beneficiary not available</em></div></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="profile-edit">
                        @if ($current_patron)
                        <div>
                            <div class="d-flex flex-row justify-content-between">
                                <h4>Payments</h4>
                                <button class="btn btn-primary" @click="activeTab = 1" >View Beneficiaries</button>
                            </div>
                            <table class="table table-stripped">
                                <thead>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th scope="col">ID</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($current_patron->verifiedTransactions as $transaction)
                                    <tr wire:key="{{ $slot->id }}">
                                        <td><x-table-data :name="$transaction->id" /></td>
                                        <td><x-table-data :name="$transaction->amount" /></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4"><div class="text-center"><em>Beneficiary not available</em></div></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->