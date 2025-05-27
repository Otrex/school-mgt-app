@if (is_null($type))
<a class="dropdown-item d-flex align-items-center" wire:click="logout" href="javascript:void(0)">
    <i class="bi bi-box-arrow-right"></i>
    <span>Sign Out</span>
</a>
@else
<a href="javascript:void(0);" wire:click="logout" class="logout-link">
    <span>Log out</span>
    <div wire:loading.class="spinner-border spinner-border-sm text-dark" wire:target="logout"></div>
</a>
@endif