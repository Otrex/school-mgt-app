<main id="main" class="main">
    <style>
        .blur {
            filter: blur(3px);
            position: relative;
        }

        .blur::after {
            content: " ";
            display: block;
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <div class="alert alert-info"><b>Note: </b> Your patron account is not active, please activate your account to proceed </div>
    <div class="pagetitle">
        <nav class="">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Patron</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card px-3 pb-3">
                    <div class="card-title">Scholarships offered </div>
                    <h1>{{ $member->patron ? $member->patron->scholarshipSlots->count(): 0 }}</h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card px-3 pb-3">
                    <div class="card-title">Total Scholarship funds </div>
                    <h1><livewire:currency-format :amount="$member->patron ? $member->patron->verifiedTransactions()->sum('amount'): 0" /></h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card px-3 pb-3">
                    <div class="card-title">Maintenance</div>
                    <h1><livewire:currency-format :amount="$member->patron ? $member->patron->maintenanceTransaction()->where('type', 'credit')->sum('amount') : 0" /></h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card px-3 pb-3">
                    <div class="card-title">Next Due Date</div>
                    <h1>{{ $patron->next_due_date ? $patron->next_due_date : 'Not Set' }}</h1>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h4 class="fw-bold d-flex align-items-center ">Patron Details</h4>
                        <div>
                            @if ($patron->is_active)
                                <button wire:click="activate(false)" class="btn btn-danger" name="Opt-out" target="save" >Opt-out</button>
                            @else
                                <button wire:click="activate(true)" class="btn btn-secondary" name="Opt-in" target="save" >Opt-in</button>
                            @endif
                        </div>
                    </div>
                    <form wire:submit.prevent="saveUpdate" class="{{ $patron->is_active ? '': 'blur' }}">
                        <div>
                            <label for="slots" class="col-md-4 w-100 col-lg-3 col-form-label">Number of Scholarships:</label>
                            <div class="">
                                <input wire:model.defer="patron.no_of_slots" type="number" class="form-control w-100" id="slots">
                                <x-inline-error name="patron.no_of_slots" />
                            </div>
                        </div>
                        <div>
                            <label for="town" class="w-full col-form-label">Town (Optional): </label>
                            <div>
                                <select class="form-select" wire:model.defer="patron.town_id" aria-label="Default select example">
                                    <option value="">--Select--</option>
                                    @forelse ($towns as $town)
                                    <option value="{{ $town->id }}">{{ $town->name }}</option>
                                    @empty
                                    <option value="">No town available</option>
                                    @endforelse
                                </select>
                                <x-inline-error name="patron.town" />
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row">
                            <div class="col-md-4 no-wrap">
                                <label><input type="radio" wire:model.defer="patron.payment_frequency" name="frequency" value="one-time"  /> One Time</label>
                            </div>
                            <div class="col-md-4">
                                <label><input type="radio" wire:model.defer="patron.payment_frequency" name="frequency" value="monthly" /> Monthly </label>
                            </div>
                            <div class="col-md-4">
                                <label><input type="radio" wire:model.defer="patron.payment_frequency" name="frequency" value="quarterly" /> Quarterly </label>
                            </div>
                        </div>
                        <div class=" mt-3">
                            <x-button name="Update" target="save" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card px-3">
                    <h4 class="mb-3 fw-bold pt-3">Payments</h4>
                    <table class="table table-stripped px-3">
                        <thead>
                            <tr style="border-bottom: 1px solid #eee;">
                                <th scope="col">ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Reference</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (($member->patron ? $member->patron->transactions()->where('status', 'completed')->get(): []) as $transaction)
                            <tr wire:key="{{ $member->id }}">
                                <td><x-table-data :name="$transaction->id" /></td>
                                <td>
                                 {{ $formatNumber($transaction->amount) }}
                                </td>
                                <td><x-table-data :name="$transaction->ref" /></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button :id="$id('print-{{ $member->id }}')" class="btn btn-primary" wire:click="generateReceipt({{ $transaction->id}})" >
                                            <i class="bi bi-receipt"></i> Receipt
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4"><div class="text-center"><em>Transactions not available</em></div></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</main>