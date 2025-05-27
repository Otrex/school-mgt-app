@if (empty($type))
<a class="dropdown-item d-flex align-items-center" wire:click="logout" href="javascript:void(0)">
    <i class="bi bi-box-arrow-right"></i>
    <span>Sign Out</span>
</a>
@else
<li><a wire:click="logout" href="javascript:void(0)">Logout</a></li>
@endif