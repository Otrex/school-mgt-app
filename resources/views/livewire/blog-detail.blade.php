<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
        <h2>{{ $blog->title }}</h2>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <img src="{{ $blog->image }}" class="img-fluid" alt="">
                    <h3>{{ $blog->title }}</h3>
                    <p>
                        {{ $blog->summary }}
                        <p>{!! $blog->content !!}</p>
                    </p>
                </div>
            </div>
        </div>
    </section><!-- End Cource Details Section -->
</main><!-- End #main -->