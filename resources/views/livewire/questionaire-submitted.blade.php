<main id="main">
    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="shadow-lg p-4">
                        <div class="my-3 text-center"><i class="bi bi-check-circle fs-1 text-complete"></i></div>
                        <div class="text-center fs-4 text-complete mb-1">Answers Submitted</div>
                        <div class="px-3">
                            <div class="d-flex justify-content-between align-items-center text-center mb-2">
                                Your answers has been successfully submitted, to view your result proceed to your dashboard.
                            </div>
                            <div class="text-center mt-5">
                                @if (!is_null($route_name))
                                <a href="{{ route($route_name) }}" class="btn-mark-completed">
                                    <span>Dashboard</span>
                                </a>
                                @else
                                <a href="{{ route('index') }}" class="btn-mark-completed">
                                    <span>Home</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>