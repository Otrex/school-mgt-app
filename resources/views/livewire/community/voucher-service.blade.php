<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Result</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('community.member.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add New Result</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <span class="col-sm-2"></span>
                            <div class="col-sm-10">
                                <div class="alert alert-info fade show my-2" style="font-size: 12px; padding: 10px;" role="alert">
                                    <i class="bi bi-info-circle me-1"></i>
                                    This service serves as an avenue to work as a sales agent responsible for selling online training voucher;
                                    to start fill in the amount (in price) of voucher you want and the quantity, send in your purchasing fee to the
                                    account number below: <br>
                                    <strong>Account Name: Telage Concept Limited - Blip Computer Club</strong><br>
                                    <strong>Account Number: 8966138623</strong><br>
                                    <strong>Bank Name: Wema Bank</strong><br>
                                </div>
                            </div>
                        </div>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="send">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model.defer="course" aria-label="Default select example">
                                        <option value="">--Select Amount--</option>
                                        <option value="">&#8358;5,000.00</option>
                                        <option value="">&#8358;10,000.00</option>
                                    </select>
                                    <x-inline-error name="course" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" wire:model.defer="quantity">
                                    <x-inline-error name="quantity" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Send Request" target="send" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Voucher Requests</h5>
                        </div>

                        <table class="table table-stripped">
                            <thead>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th scope="col">Request ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>3ew23ewe33</td>
                                    <td>&#8358;5000</td>
                                    <td>10</td>
                                    <td>&#8358;5000</td>
                                    <td><span class="badge rounded-pill bg-warning text-light">Pending</span></td>
                                    <td>28/7/2023</td>
                                    <td><button class="btn btn-danger btn-sm">Cancel Request</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->