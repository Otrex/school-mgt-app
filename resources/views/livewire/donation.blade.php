<main id="main">
    <!-- ======= Hero Section ======= -->
    <section class="hero" style="padding: 30px 0;min-height: 100vh">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="container position-relative">
                        <h1>Donate
                            @if ($amount == 'custom amount')
                                {{ $amount }}
                            @else
                                {!! is_null($amount) ? 'any amount' : (is_string($amount) ? 'custom amount' : '&#8358;'.number_format($amount, 2)) !!}
                            @endif
                            ,<br>to our cause
                        </h1>
                        <h2>Bringing technology to the underserved community in Nigeria</h2>
                        <a href="#why-donate" class="btn-get-started">Discover why donate</a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                    <div class="position-relative">
                        <div class="donation-form-wrapper">
                            <p class="donation-title">Donate to our cause</p>
                            <div class="donation-description">Do support our cause in providing top-notch digital skills training. Your donation can change lives and bridge the digital gap in our communities. Contribute today for a brighter, tech-enabled future!</div>
                            <div>
                                <form wire:submit.prevent="donate">
                                    <input type="hidden" wire:model="reference">
                                    <div class="donation-input-wrapper w-100">
                                        <input type="email" wire:model.lazy="email" placeholder="Your email address" class="donation-custom-input w-100">
                                    </div>
                                    <x-inline-error name="email" />

                                    <div class="donation-input-wrapper">
                                        <select wire:model="amount" id="amount" class="donation-select cursor">
                                            <option value="">Select Amount</option>
                                            <option value="10000">&#8358;10,000.00 NGN</option>
                                            <option value="25000">&#8358;25,000.00 NGN</option>
                                            <option value="50000">&#8358;50,000.00 NGN</option>
                                            <option value="100000">&#8358;100,000.00 NGN</option>
                                            <option value="200000">&#8358;200,000.00 NGN</option>
                                            <option value="300000">&#8358;300,000.00 NGN</option>
                                            <option value="500000">&#8358;500,000.00 NGN</option>
                                            <option value="custom amount">Custom Amount</option>
                                        </select>
                                    </div>
                                    <x-inline-error name="amount" />

                                    @if ($amount == "custom amount")
                                    <div class="d-flex align-items-center">
                                        <div class="currency-sign">&#8358;</div>
                                        <div class="donation-input-wrapper w-40">
                                            <input type="number" wire:model="custom_amount" class="donation-custom-input w-100">
                                        </div>
                                        <div class="currency-name">NGN</div>
                                    </div>
                                    <x-inline-error name="custom_amount" />
                                    @endif

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="donation-input-wrapper {{ ($payment_cycle == "Once") ? 'active' : '' }} w-100">
                                            <label for="once" class="d-flex justify-content-between cycle-label">
                                                <span>
                                                    Once
                                                    <input type="radio" class="visibility-hidden" wire:model.lazy="payment_cycle" value="Once" id="once">
                                                </span>
                                                <span class="bi bi-check-circle-fill {{ ($payment_cycle == "Once") ? 'd-inline' : 'd-none' }}"></span>
                                            </label>
                                        </div>
                                        <div class="donation-input-wrapper {{ ($payment_cycle == "Monthly") ? 'active' : '' }} w-100">
                                            <label for="monthly" for="once" class="d-flex justify-content-between cycle-label">
                                                <span>
                                                    Monthly
                                                    <input type="radio" class="visibility-hidden" wire:model.lazy="payment_cycle" value="Monthly" id="monthly">
                                                </span>
                                                <span class="bi bi-check-circle-fill {{ ($payment_cycle == "Monthly") ? 'd-inline' : 'd-none' }}"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <x-inline-error name="payment_cycle" />

                                    <button class="donation-btn">
                                        <span>Donate</span>
                                        <div wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="donate"></div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= About Section ======= -->
    <section id="why-donate" class="about" style="padding: 60px 0;">
        <div class="container">
            <div class="row" style="margin-bottom: 60px;">
                <div class="col-lg-12 pt-4 pt-lg-0 order-2 text-center order-lg-1 content">
                    <h2>Why donating to our cause?</h2>
                    <p class="fst-italic">
                        Your donation to our cause in creating a technological literacy awareness in unnderserved communities in Nigeria,
                        will help in achieving the following:
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="why-donation-card">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="why-donation-icon">
                                    <div class="bi bi-pc-display-horizontal"></div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <h5 class="why-donation-title">Access to technology</h5>
                                <div class="why-donation-reason">
                                    Providing access to technology for students who may not have access to it at home. This can help bridge the digital divide and ensure that all students have equal opportunities to learn.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-donation-card">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="why-donation-icon">
                                    <div class="bi bi-mortarboard"></div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <h5 class="why-donation-title">Improved learning</h5>
                                <div class="why-donation-reason">
                                    Computers can help improve the learning experience for students by providing access to educational resources and tools that can enhance their learning experience.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-donation-card">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="why-donation-icon">
                                    <div class="bi bi-rocket"></div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <h5 class="why-donation-title">Preparation for the future</h5>
                                <div class="why-donation-reason">
                                    In today’s digital age, computer skills are essential for success in many fields. You can help prepare students for the future by giving them the tools they need to succeed.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-donation-card">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="why-donation-icon">
                                    <div class="bi bi-people-fill"></div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <h5 class="why-donation-title">Community impact</h5>
                                <div class="why-donation-reason">
                                    Donations to a community computer school can have a positive impact on the community by helping to improve education and providing opportunities for students to succeed.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->
</main><!-- End #main -->