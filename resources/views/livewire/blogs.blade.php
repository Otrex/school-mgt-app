<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Blogs</h2>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
        <div class="container" data-aos="fade-up">
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-md-6 d-flex align-items-stretch mb-3">
                    <div class="card">
                        <div class="card-img">
                            <img src="{{ $blog->image }}" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('blog.detail', $blog) }}">{{ $blog->title }}</a></h5>
                            <p class="fst-italic text-center">{{ $blog->created_at->format('D, F d Y \a\t h:ia') }}</p>
                            <p class="card-text">{{ $blog->summary }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Events Section -->
</main><!-- End #main -->