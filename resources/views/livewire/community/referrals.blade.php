<main id="main" class="main">
    <div class="pagetitle">
        <h1>Referrals</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('community.member.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Referrals</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Verified</th>
                        <th>Honored</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($referrals as $referral)
                        <tr>
                            <td>{{ $referral->referred->fullname }}</td>
                            <td>{{ $referral->referred->email }}</td>
                            <td>{{ $referral->referred->phone }}</td>
                            <td>{{ $referral->referred->email_verified_at != null ? 'Yes' : 'No' }}</td>
                            <td>{{ $referral->honoured ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main><!-- End #main -->