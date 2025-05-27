<main id="main">
    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="shadow-lg p-4">
                        <div class="my-3 text-center"><i class="bi bi-info-circle fs-1 text-info"></i></div>
                        <div class="text-center fs-4 text-info mb-1">Test Instruction</div>
                        <div class="px-3">
                            <div class="d-flex justify-content-between align-items-center text-center mb-2">
                                Welcome to this test, before you proceed with this test make sure you are ready because once the timer
                                start counting it doesn't stop and also make sure you attempt all question and submit before the timer stop.
                            </div>
                            <div class="text-center">
                                <b>Good Luck! 👍</b>
                            </div>
                            <div class="text-center mt-5">
                                <a href="javascript:void(0)" wire:click="proceed" class="btn-mark-completed">
                                    <span>Proceed</span>
                                    <i wire:loading.remove class="bi bi-arrow-right-circle-fill" wire:target="proceed"></i>
                                    <i wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="proceed"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>