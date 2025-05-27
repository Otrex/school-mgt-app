<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Purchase</h2>
            <p>
                <a href="{{ url()->previous() }}" class="text-light">Back</a>
                <i class="bi bi-caret-right-fill"></i>
                <a href="#" class="text-light">Purchase</a>
            </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details" style="padding-bottom: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ $course->image }}" class="img-fluid" alt="">
                    </div>
                    <div class="purchase-course-summary">
                        <div class="text-center bold">Thank you for your request to purchase this program, below is a summary of your purchase order:</div>
                        <div class="dotted-border"></div>
                        <div class="row my-3 text-center">
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="bold">Program</div>
                                <div>{{ $course->name }}</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="bold">Program Type</div>
                                <div>{{ $course->bill_type }}</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="bold">Fee</div>
                                <div>&#8358;{{ number_format($course->fee, 2) }}</div>
                            </div>
                        </div>

                        <div class="dotted-border"></div>

                        <div class="row my-3 text-center">
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="bold">Fullname</div>
                                <div>{{ $auth_user->fullname }}</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="bold">Phone number</div>
                                <div>{{ $auth_user->phone }}</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="bold">Email</div>
                                <div>{{ $auth_user->email }}</div>
                            </div>
                        </div>

                        <div class="dotted-border"></div>
                        <div class="bold my-3">Payment Mode</div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <input type="radio" wire:model="payment_mode" value="paystack" id="paystack">
                                <label for="paystack">Online Payment (Paystack)</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <input type="radio" wire:model="payment_mode" value="voucher" id="voucher">
                                <label for="voucher">Voucher</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <input type="radio" wire:model="payment_mode" value="bank transfer" id="bank_transfer">
                                <label for="bank_transfer">Bank Transfer</label>
                            </div>
                        </div>

                        @if ($payment_mode == 'bank transfer')
                        <div class="border p-3">
                            <div>
                                <div class="mb-2">Please make payment to the following bank account with your <b>email</b> as transfer description:</div>
                                <div>
                                    <span class="bold">Fee: </span>
                                    <span>&#8358;{{ number_format($course->fee, 2) }}</span>
                                </div>
                                <div>
                                    <span class="bold">Bank:</span> <span>First Bank</span>
                                </div>
                                <div>
                                    <span class="bold">Account name:</span> <span>Telage Concept LTD</span>
                                </div>
                                <div>
                                    <span class="bold">Account number:</span> <span>0928374234</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($payment_mode == 'voucher')
                        <div class="border p-3">
                            <form wire:submit.prevent="purchaseWithVoucher" class="purchase-form">
                                <div class="mb-2">Please enter your voucher code in the field below:</div>
                                <div class="form-group mt-3">
                                    <label for="voucher" class="bold">Fee: </label>
                                    <span>&#8358;{{ number_format($course->fee, 2) }}</span>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="voucher" class="bold">Voucher code</label>
                                    <input type="text" class="form-control" wire:model.defer="voucher_code" id="password" placeholder="Please enter your voucher code">
                                    <x-inline-error name="voucher_code" />
                                </div>
                                <button type="submit">
                                    Purchase
                                    <div wire:loading.class="spinner-grow spinner-grow-sm text-light" wire:target="purchaseWithVoucher"></div>
                                </button>
                            </form>
                        </div>
                        @endif

                        @if ($payment_mode == 'paystack')
                        <div class="border p-3">
                            <form wire:submit.prevent="purchaseWithPaystack" class="purchase-form">
                                <input type="hidden" wire:model="reference">
                                <div class="form-group mt-3">
                                    <label for="voucher" class="bold">Fee: </label>
                                    <span>&#8358;{{ number_format($course->fee, 2) }}</span>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="voucher" class="bold">Email</label>
                                    <span>{{ $auth_user->email }}</span>
                                    <input type="hidden" class="form-control" wire:model.defer="email">
                                    <x-inline-error name="email" />
                                </div>
                                <button type="submit">
                                    Purchase
                                    <div wire:loading.class="spinner-grow spinner-grow-sm text-light" wire:target="purchaseWithPaystack"></div>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Cource Details Section -->
</main><!-- End #main -->