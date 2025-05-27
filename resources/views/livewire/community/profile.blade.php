
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('community.member.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex text-center flex-column align-items-center">
                        @livewire('components.communnity-member-avatar')
                        <h2>{{ (strlen(auth('community')->user()->fullname) >= 17) ? auth('community')->user()->first_name[0].". ".auth('community')->user()->last_name : auth('community')->user()->fullname }}</h2>
                    </div>
                </div>

                @if (!auth('community')->user()->patron)
                <div class="card">
                    <div class="card-body p-3">
                        <h4 class="fw-bold fs-4">Become a Patron</h4>
                        <!-- Profile Edit Form -->
                        <form wire:submit.prevent="becomePatron">
                            <div class="row mb-3">
                                <label for="slots" class="col-md-4 w-100 col-lg-3 col-form-label">Number of Scholarships you'd like to offer:</label>
                                <div class="">
                                    <input wire:model.defer="patron.slots" min="1" type="number" class="form-control w-100" id="slots">
                                    <x-inline-error name="patron.slot" />
                                </div>
                            </div>
                            <pre>Note: Each slot is worth N25,000 </pre>

                            <div class="row mb-3">
                                <label for="town" class="w-full col-form-label">Town (Optional): </label>
                                <div>
                                    <select class="form-select" wire:model="patron.town" aria-label="Default select example">
                                        <option value="">--Select--</option>
                                        @forelse ($towns as $town)
                                        <option value="{{ $town->id }}">{{ $town->name }}</option>
                                        @empty
                                        <option value="">No town available</option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="patron.town" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-4 no-wrap">
                                    <label><input type="radio" wire:model="patron.payment_frequency" name="frequency" value="one-time"  /> One Time</label>
                                </div>
                                <div class="col-md-4">
                                    <label><input type="radio" wire:model="patron.payment_frequency" name="frequency" value="monthly" /> Monthly </label>
                                </div>
                                <div class="col-md-4">
                                    <label><input type="radio" wire:model="patron.payment_frequency" name="frequency" value="quarterly" /> Quarterly </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <x-button name="Proceed" target="becomePatron" />
                                </div>
                            </div>
                        </form>
                        <!-- End Profile Edit Form -->

                    </div>
                </div>
                @else
                <div>
                    <div class="card">
                        <div class="card-body p-3">
                            <h4 class="fw-bold fs-4 mb-3 ">Hi Patron</h4>
                            <div class="mb-3">
                                <code class="fs-7" >
                                    <i class="fs-7">Note: 10% of your contributions will be used for the community center maintainance</i>
                                </code>
                            </div>
                            @php
                                $_patron = auth('community')->user()->patron;
                                $amount_to_be_paid = $_patron->no_of_slots * config('app.scholarship_cost');
                                $patron['amount'] = $amount_to_be_paid;
                            @endphp

                            @if ($_patron->amount_contributed > 0 && $_patron->amount_contributed < $amount_to_be_paid)
                                <p> You've covered <b>N{{ $_patron->amount_contributed }}</b> but still have <b>N{{ $amount_to_be_paid - $_patron->amount_contributed }}</b> left.
                            @elseif ($_patron->amount_contributed >= $amount_to_be_paid)
                                <div class="alert alert-primary"> You've completed your contribution. But you can still contribute more.</div>
                            @else
                                <p> Please make the payment of <b><livewire:currency-format :amount="$amount_to_be_paid" /></b> to cover for the number of scholarship slots you selected.</p>
                            @endif
                            <p> Enter the amount you want to contribute </p>
                            <div>
                                <input type="number" name="amount" disabled class="w-100" value="{{ $amount_to_be_paid }}" style="padding: 5px 10px" />
                            </div>
                            <div class="d-inline-block mt-3">
                                <a class="btn btn-primary" wire:click="redirectToGateway"> Make your contribution </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3" x-data="{ activeTab:  0 }">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                                    <span class="tab-icon bi bi-house-fill"></span>
                                    <span class="tab-title">Overview</span>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                                    <span class="tab-icon bi bi-pencil"></span>
                                    <span class="tab-title">Edit Profile</span>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">
                                    <span class="tab-icon bi bi-lock-fill"></span>
                                    <span class="tab-title">Change Password</span>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 3" class="tab-control" :class="{ 'active': activeTab === 3 }">
                                    <span class="tab-icon bi bi-image-fill"></span>
                                    <span class="tab-title">Change Profile Image</span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Referral Code</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->referrer_code ?? '--' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->fullname }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($member->gender ?? 'None') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->email ?? 'None' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->phone ?? 'None' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">State</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->state }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Local Government</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->local_government }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Community</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->town }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Home Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->home_address }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="save">
                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.first_name" type="text" class="form-control" id="first_name">
                                            <x-inline-error name="member.first_name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.last_name" type="text" class="form-control" id="last_name">
                                            <x-inline-error name="member.last_name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.phone" type="text" class="form-control" id="phone">
                                            <x-inline-error name="member.phone" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.email" type="email" class="form-control" id="email">
                                            <x-inline-error name="member.email" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="member.state" aria-label="Default select example">
                                                <option value="">--Select--</option>
                                                @forelse ($states as $state)
                                                <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                @empty
                                                <option value="">No state available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="member.state" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="local_government" class="col-md-4 col-lg-3 col-form-label">Local Government</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="member.local_government" aria-label="Default select example">
                                                <option value="">--Select--</option>
                                                @forelse ($local_governments as $lga)
                                                <option value="{{ $lga->name }}">{{ $lga->name }}</option>
                                                @empty
                                                <option value="">No LGA available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="member.local_government" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="town" class="col-md-4 col-lg-3 col-form-label">Community</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="member.town">
                                                <optgroup label="Towns">
                                                    @forelse ($towns as $town)
                                                    <option value="{{ $town->name }}">{{ $town->name }}</option>
                                                    @empty
                                                    <option value="">No town available </option>
                                                    @endforelse
                                                </optgroup>
                                                <optgroup label="Tertiary Institution">
                                                    @forelse ($tertiary_institutions as $tertiary_institution)
                                                    <option value="{{ $tertiary_institution->name }}">{{ $tertiary_institution->name }}</option>
                                                    @empty
                                                    <option value="">No tertiary institution available </option>
                                                    @endforelse
                                                </optgroup>
                                            </select>
                                            <div style="position: absolute;" wire:loading.class="spinner-border spinner-border-sm text-dark" wire:target="member.local_government" role="status"></div>
                                            <x-inline-error name="member.town" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="home_address" class="col-md-4 col-lg-3 col-form-label">Home Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea wire:model.defer="member.home_address" type="text" class="form-control" id="home_address"></textarea>
                                            <x-inline-error name="member.home_address" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-lg-3"></div>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save Changes" target="save" />
                                        </div>
                                    </div>
                                </form>
                                <!-- End Profile Edit Form -->
                            </div>

                            <div class="tab-pane fade pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form wire:submit.prevent="passwordReset">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model="old_password" type="password" class="form-control" id="currentPassword">
                                            <x-inline-error name="old_password" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model="new_password" type="password" class="form-control" id="newPassword">
                                            <x-inline-error name="new_password" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model="new_password_confirmation" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-lg-3"></div>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Reset Password" target="passwordReset" />
                                        </div>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>

                            <div class="tab-pane fade pt-3" :class="{ 'active show': activeTab === 3 }" x-show.transition.in.opacity.duration.600="activeTab === 3" id="profile-change-password">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-lg-12" wire:ignore>
                                        <form wire:submit.prevent="changeProfileImage">
                                            <div class="display-picture text-center">
                                                <label for="image" class="btn btn-secondary btn-sm mt-2 image-upload-box" id="img-add-btn">
                                                    <span style="font-size: 1.8em;" class="bi bi-image-fill"></span>
                                                    <div>Touch/Click to add profile image</div>
                                                </label>
                                                <input type="file" class="profile-image form-control visually-hidden" id="image" name="image">
                                            </div>
                                            <div class="crop-wrapper text-center">
                                                <div class="image-crop"></div>
                                                <button type="button" class="btn btn-success btn-sm" id="change">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm remove" id="change">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            <div class="text-center cropped-image">
                                                <img src="" id="preview"><br>
                                                <input type="hidden" id="crop-img" wire:model="avatar">
                                                <button class="btn btn-primary my-3" id="submit">
                                                    <span>Set Avatar</span>
                                                    <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="changeProfileImage"></span>
                                                </button>
                                                <x-inline-error name="avatar" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="d-none" id="x-refresh-btn" wire:click="refreshPage" > Ref </button>
        </div>

    </section>

    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('form:submitted', message => {
               var nav = document.getElementById('x-nav-patron');
               var btn = document.getElementById('x-btn-patron');

               nav.classList.remove('x-hide');
               btn.classList.remove('x-hide');
            });
            Livewire.on('paystack:popup', function (data) {
                var refreshBtn = document.getElementById('x-refresh-btn');
                var transaction = JSON.parse(data);

                const paystack = new PaystackPop();
                paystack.newTransaction({
                    ...transaction,
                    onSuccess: (transaction) => {
                        setTimeout(() => {
                            refreshBtn.click();
                        }, 4000);
                    },
                });
            })
        });
    </script>
</main><!-- End #main -->