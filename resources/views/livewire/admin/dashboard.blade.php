<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Programs</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $courses }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Blog Posts</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $blogs->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Students</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>{{ $students }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->

                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Community Members</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-globe-asia-australia"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>{{ $community_members }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity Should Be Added Here -->
                

                <!-- News & Updates Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>
                        <div class="news">
                            @forelse ($blogs as $blog)
                            <div class="post-item clearfix">
                                <img src="{{ is_url($blog->image) ? $blog->image : asset("storage/blog/{$blog->image}") }}" alt="">
                                <h4><a target="_blank" href="{{ route('blog.detail', $blog) }}">{{ $blog->title }}</a></h4>
                                <p>{{ (strlen($blog->summary) >= 97) ? substr($blog->summary, 0, 97)."..." : $blog->summary }}</p>
                            </div>
                            @empty
                            <div class="post-item clearfix p-2">
                                <div class="text-center"><em>No blog post available</em></div>
                            </div>
                            @endforelse
                        </div><!-- End sidebar recent posts-->
                    </div>
                </div><!-- End News & Updates -->
            </div><!-- End Right side columns -->
            
            <!-- Reports -->
            <div class="col-12">
                    <div class="card">

                        <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                        </div>

                        <div class="card-body">
                        <h5 class="card-title">Reports <span>/Today</span></h5>

                        <!-- Line Chart -->
                        <div id="reportsChart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                            new ApexCharts(document.querySelector("#reportsChart"), {
                                series: [{
                                name: 'Sales',
                                data: [31, 40, 28, 51, 42, 82, 56],
                                }, {
                                name: 'Revenue',
                                data: [11, 32, 45, 32, 34, 52, 41]
                                }, {
                                name: 'Customers',
                                data: [15, 11, 32, 18, 9, 24, 11]
                                }],
                                chart: {
                                height: 350,
                                type: 'area',
                                toolbar: {
                                    show: false
                                },
                                },
                                markers: {
                                size: 4
                                },
                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                fill: {
                                type: "gradient",
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.4,
                                    stops: [0, 90, 100]
                                }
                                },
                                dataLabels: {
                                enabled: false
                                },
                                stroke: {
                                curve: 'smooth',
                                width: 2
                                },
                                xaxis: {
                                type: 'datetime',
                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                },
                                tooltip: {
                                x: {
                                    format: 'dd/MM/yy HH:mm'
                                },
                                }
                            }).render();
                            });
                        </script>
                        <!-- End Line Chart -->

                        </div>

                    </div>
                    </div><!-- End Reports -->
                    
             <!-- Recent Sales -->
             <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">10 Best Performing Student in {{ $current_session }} session</h5>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Reg No.</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">School</th>
                                            <th scope="col">Cumm. Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($best_results as $index => $result)
                                            @php
                                                $student = \App\Models\User::find($index);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $student->reg_no }}</td>
                                                <td>{{ $student->fullname }}</td>
                                                <td>{{ $student->school }}</td>
                                                <td>{{ number_format($result, 2) }}%</td>
                                            </tr>
                                            @if ($loop->index == 10)
                                                @break;
                                            @endif
                                        @empty
                                        <tr><td colspan="5"><center><em>No result(s) available</em></center></td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Recent Sales -->



        </div>
    </section>
</main>
