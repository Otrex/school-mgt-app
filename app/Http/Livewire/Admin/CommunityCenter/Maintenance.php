<?php
namespace App\Http\Livewire\Admin\CommunityCenter;

use App\Enums\MaintenanceStatus;
use App\Enums\TransactionSource;
use Livewire\Component;
use App\Models\CommunityCenter;
use App\Models\CommunityResource;
use App\Models\MaintenanceRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class Maintenance extends Component
{
    use WithPagination;

    public $center;
    public $resource;
    public $title;
    public $cost;
    public $status_filter;
    public $reason_for_request;

    protected array $rules = [
        'center' => 'required|int',
        'title' => 'required|string',
        'reason_for_request' => 'required|string',
        'cost' => 'required|int|min:0',
    ];

    public function delete($id) {
        MaintenanceRequest::destroy([$id]);
        $this->dispatchBrowserEvent('success', 'Request added deleted!');
    }

    public function approve($id)
    {
        $request = MaintenanceRequest::find($id);

        if ($request->status && $request->status != 'pending') {
            $this->dispatchBrowserEvent('error', 'Request has already been '. $request->status.'!');
            return;
        }

        $request->status = MaintenanceStatus::APPROVED;
        $request->save();
        // TODO Allocate funds

        $this->status_filter = MaintenanceStatus::APPROVED->value;

        $this->dispatchBrowserEvent('success', 'Request Approved!');
    }

    public function reject($id)
    {
        $request = MaintenanceRequest::find($id);

        if ($request->status && $request->status != 'pending') {
            $this->dispatchBrowserEvent('error', 'Request has already been '. $request->status.'!');
            return;
        }

        $request->status = MaintenanceStatus::REJECTED;
        $request->save();

        $this->status_filter = MaintenanceStatus::REJECTED->value;

        $this->dispatchBrowserEvent('success', 'Request Rejected!');
    }

    public function execute($id)
    {
        $request = MaintenanceRequest::find($id);

        if ($request->status == MaintenanceStatus::PENDING->value) {
            $this->dispatchBrowserEvent('error', 'Request has already been not been approved!');
            return;
        }

        if ($request->status == MaintenanceStatus::REJECTED->value) {
            $this->dispatchBrowserEvent('error', 'Request has already been '. $request->status.'!');
            return;
        }

        $request->is_fulfilled = true;
        $request->save();

        $this->status_filter = MaintenanceStatus::APPROVED->value;

        $this->dispatchBrowserEvent('success', 'Execution completed!');
    }

    public function record()
    {
        $this->validate();

        $user = Auth::guard('admin')->user();

        if ($user) {
            MaintenanceRequest::create([
                'requester_id' => $user->id,
                'resource_id' => $this->resource,
                'center_id' => $this->center,
                'title' => $this->title,
                'reason_for_request' => $this->reason_for_request,
                'cost' => $this->cost,
            ]);

            // TODO: assign funds to it

            $this->dispatchBrowserEvent('success', 'Request added successfully!');

            $this->center = null;
            $this->cost = null;
            $this->title = null;
            $this->resource = null;
            $this->reason_for_request = null;
        }
    }

    public function render()
    {
        title('Admin - Community Centers Maintenance');

        $total_maintenance_funds = Transaction::where('source', TransactionSource::MAINTENANCE)->sum('amount');

        $centers = CommunityCenter::all();

        $maintenanceStatuses = MaintenanceStatus::toArray();

        $resources = (isset($this->center)) ? CommunityResource::where('community_center_id', $this->center)->get() : [];

        $maintenances = MaintenanceRequest::where('status', 'like', '%'.$this->status_filter.'%')->latest()->paginate();

        return view('livewire.admin.community-center.maintenance', compact(
            'total_maintenance_funds',
            'maintenances',
            'centers',
            'resources',
            'maintenanceStatuses'
        ))
            ->extends('layouts.admin')
            ->section('content');
    }
}