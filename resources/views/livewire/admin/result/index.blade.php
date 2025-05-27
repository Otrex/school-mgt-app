<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Result</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Result</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total Course Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Result</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $results_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Student Card -->

                    <!-- Total Category Student -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Course</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $courses->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <h4>Select Course</h4>
                    </div>

                    @forelse ($courses as $course)
                    <div class="col-xxl-4 col-md-6" wire:key="{{ $course->id }}">
                        <div class="card">
                            <div class="p-4">
                                <a href="{{ route('admin.result.view', $course) }}">{{ $course->name }}</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-xxl-12 col-md-12">
                        <div class="card">
                            <div class="p-4 text-center">
                                <span><em>No course(s) available</em></span>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</main><!-- End #main -->