<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.community-center') }}">Community Center</a></li>
                <li class="breadcrumb-item active">Resource Logs({{ $resource->type->name }})</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">


                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Community Resources Logs for {{ $resource->type->name }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$logs" />
                                    </div>
                                    <div>
                                        <form>
                                            <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search ...">
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">Type</th>
                                            <th scope="col">Logger</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Check In</th>
                                            <th scope="col">Check Out</th>
                                            {{-- <th scope="col">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($logs as $log)
                                        <tr wire:key="{{ $log->id }}">
                                            <td><x-table-data :name="$log->resource->type->name" /></td>
                                            <td> <x-table-data :name="$log->owner->fullname" /> </td>
                                            <td><x-table-data :name="$log->description" /></td>
                                            <td><x-table-data :name="$log->check_in" /></td>
                                            <td><x-table-data :name="$log->check_out" /></td>
                                            {{-- <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.community-resource.log.view', $log) }}" style="margin-right: 10px;">
                                                        <span class="bi bi-eye-fill"></span>
                                                    </a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5"><div class="text-center"><em>Log(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $logs->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
