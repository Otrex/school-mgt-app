<main id="main">
    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="shadow-lg p-4">
                        <div class="text-center fs-4 text-complete">Payment Successfull!</div>
                        <div class="my-3 text-center"><i class="bi bi-check-circle fs-1 text-complete"></i></div>
                        @if (session()->has('payment_complete'))
                        <div class="px-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary">Payment Type</span>
                                <span class="text-dark text-title">{{ session('payment_complete')['payment_type'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary">Mobile</span>
                                <span class="text-dark">{{ session('payment_complete')['phone'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary">Email</span>
                                <span class="text-dark">{{ session('payment_complete')['email'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary">Amount paid</span>
                                <span class="text-dark">&#8358;{{ number_format(session('payment_complete')['amount_paid'], 2) }}</span>
                            </div>
                            <div class="text-center mt-5">
                                <a href="{{ url(session('payment_complete')['redirect_path']) }}" class="link-btn">Back to programs</a>
                                <a href="{{ route('index') }}" class="link-btn">Home</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Cource Details Section -->

</main>