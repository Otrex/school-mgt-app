<main id="main">
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
        <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
            <h1>Learning Today,<br>Building Tomorrow</h1>
            <h2>Bringing tech education to the underserved communities in Nigeria</h2>
            <a href="{{ route('courses') }}" class="btn-get-started">Get Started</a>
        </div>
    </section><!-- End Hero -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                <img src="{{ asset('img/about.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>Whats our aim and objectives</h3>
                    <p>
                        We aim to bridge the gap in computer illiteracy among teeming youth by creating tech social club in underserved
                        communities and schools all around Nigeria through the following:
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Organizing trainings in schools and community centers.</li>
                        <li><i class="bi bi-check-circle"></i> Creating social clubs to facilitate peer-to-peer learning.</li>
                        <li><i class="bi bi-check-circle"></i> Creating an environment to facilitate mentorship and building employable individuals for the huge technological market.</li>
                    </ul>
                    <p>
                    The club aims to provide a holistic and enriching experience for secondary school students & members of underserved communities, empowering them with valuable skills and preparing them for a technology-driven future.
                    The mission is to equip participants, particularly those from underserved communities, with the necessary skills and knowledge to thrive in the digital age.
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
        <div class="container">
            <div class="row counters">
                <div class="col-lg-4 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $student_count ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Members</p>
                </div>

                <div class="col-lg-4 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $course_count ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Programs</p>
                </div>

                <div class="col-lg-4 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $completed_lessons ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Completed Lessons</p>
                </div>
            </div>
        </div>
    </section><!-- End Counts Section -->
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Why Blip?</h3>
                        <p>
                        Blip Computer School provides an environment where enthusiasts, coders and tech lovers of all skill levels can come together and work on projects for fun and their portfolio.
                        Blip Computer Club helps students develop problem-solving skills.
                        </p>
                        <div class="text-center">
                            <a href="{{ route('club.about') }}" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Peer-to-Peer learning.</h4>
                                    <p>
                                        Members of our communities are actively encouraged to collaborate and learn from each other.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Mentorship Guide</h4>
                                    <p>
                                        We ensure to encourage participants to tap into the extensive experience of mentors we make available.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-images"></i>
                                    <h4>Career building</h4>
                                    <p>
                                        As participants improve, we guide them towards opportunites to help them improve their careers.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <div class="section-title mt-2">
                <h2>Partners</h2>
                <p>Our Partners</p>
            </div>
            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-lg-3 col-md-4">
                    <div class="icon-box">
                        <span><img src="{{ asset('img/a-greater-aguata.png') }}" style="margin-right: 10px;" width="75" alt=""></span>
                        <h3><a href="https://web.facebook.com/people/A-Greater-Aguata/100084365693634/">Aguata Local Government</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Features Section -->

    <!-- ======= Popular Courses Section ======= -->
    <section id="popular-courses" class="courses">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Programs</h2>
                <p>Popular Programs</p>
            </div>
            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                @foreach ($courses as $course)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <a href="{{ route('course.detail', $course) }}"><img src="{{ $course->image }}" class="img-fluid" alt="..."></a>
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>{{ $course->courseCategory->name }}</h4>
                                <p class="price">&#8358;{{ number_format($course->fee, 2) }}</p>
                            </div>

                            <h3><a href="{{ route('course.detail', $course) }}">{{ $course->name }}</a></h3>
                            <p class="summary">{!! $course->summary !!}</p>
                        </div>
                    </div>
                </div> <!-- End Course Item-->
                @endforeach
            </div>
        </div>
    </section><!-- End Popular Courses Section -->

    <section id="popular-courses" class="courses">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Blog</h2>
                <p>Popular Blog</p>
            </div>

            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                @foreach ($blogs as $blog)
                @php
                    $tags = explode(',', $blog->tags);
                @endphp
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <a href="{{ route('blog.detail', $blog) }}"><img src="{{ $blog->image }}" class="img-fluid" alt="..."></a>
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>{{ $blog->category }}</h4>
                            </div>

                            <h3><a href="{{ route('blog.detail', $blog) }}">{{ Illuminate\Support\Str::words($blog->title, 5) }}</a></h3>
                            <p class="summary">{{ $blog->summary }}</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-rank d-flex align-items-center">
                                    <i class="bx bx-show"></i>&nbsp;50
                                    &nbsp;&nbsp;
                                </div>
                                <div>
                                    @foreach ($tags as $tag)
                                    <span class="tags">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Blog Item-->
                @endforeach
            </div>
        </div>
    </section>
</main><!-- End #main -->