<main id="main" class="main">
    <div class="pagetitle">
        <h1>All Voucher</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Voucher</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total Student Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $vouchers_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Student Card -->

                    <!-- Total Male Student -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                            <h5 class="card-title">Used</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $used->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Female Student -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Unused</h5>

                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $un_used->count() }}</h6>
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
                                        <h5 class="card-title">Vouchers</h5>
                                        <div>
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.voucher.add') }}"><span class="bi bi-plus"></span></a>
                                            <button type="button" class="btn btn-success btn-sm" @click="filter = !filter">
                                                <span class="bi bi-funnel-fill"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mb-3" x-cloak x-show="filter" @click.outside="filter = false">
                                        <div class="col-xxl-12 mb-2">Filter by:</div>
                                        <div class="col-xxl-6 col-md-6 col-sm-12 mb-2">
                                            <select wire:model="voucher_status" class="form-select form-select-sm">
                                                <option value="">Voucher Status</option>
                                                <option value="1">Used</option>
                                                <option value="0">Unused</option>
                                            </select>
                                        </div>
                                        <div class="col-xxl-6 col-md-6 col-sm-12 mb-2">
                                            <select wire:model="price" class="form-select form-select-sm">
                                                <option value="">Price</option>
                                                @foreach ($voucher_prices as $voucher_price)
                                                    <option value="{{ $voucher_price->price }}">{{ '₦'.number_format($voucher_price->price, 2) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xxl-12 col-md-12 col-sm-12 mb-2">
                                            <button type="button" wire:click="resetFilter" class="btn btn-primary btn-sm">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$vouchers" />
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">Code</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Voucher Status</th>
                                            <th scope="col">Date Generated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($vouchers as $voucher)
                                        <tr wire:key="{{ $voucher->id }}">
                                            <td><x-table-data :name="$voucher->code" /></td>
                                            <td><x-table-data :name="'₦'.number_format($voucher->price, 2)" /></td>
                                            <td><x-table-data :name="($voucher->is_used) ? 'Used' : 'Unused'" /></td>
                                            <td><x-table-data :name="$voucher->created_at->format('d/m/Y')" /></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5"><div class="text-center"><em>Voucher(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $vouchers->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>