<main id="main" class="main">

    <div class="pagetitle">
        <h1>Generate New Voucher</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.vouchers') }}">All Voucher</a></li>
                <li class="breadcrumb-item active">Generate New Voucher</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Voucher Generating Form</h5>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="generate">
                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Price (&#8358;)</label>
                                <div class="col-sm-10">
                                    <input type="number" wire:model.defer="price" class="form-control" id="price">
                                    <x-inline-error name="price" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" wire:model.defer="quantity" class="form-control" id="quantity">
                                    <x-inline-error name="quantity" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Generate" target="generate" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->