<main id="main" data-aos="fade-in">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Programs</h2>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                @foreach ($courses as $course)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-3">
                    <div class="course-item">
                        <a href="{{ route('course.detail', $course) }}"><img src="{{ $course->image }}" class="img-fluid" alt="..."></a>
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>{{ $course->courseCategory->name }}</h4>
                                <p class="price">&#8358;{{ number_format($course->fee, 2) }}</p>
                            </div>

                            <h3><a href="{{ route('course.detail', $course) }}">{{ $course->name }}</a></h3>
                            <p class="program-summary">{!! $course->summary !!}</p>
                        </div>
                    </div>
                </div> <!-- End Course Item-->
                @endforeach
            </div>
        </div>
    </section><!-- End Courses Section -->
</main><!-- End #main -->