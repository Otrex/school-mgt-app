@if (!empty(auth()->user()->image))
<span>
    @if (empty($type))
    <a href="javascript:void(0);" wire:click="removeAvatar" class="remove-avatar">
        <img src="{{ is_url(auth()->user()->image) ? auth()->user()->image : asset("storage/avatar/".auth()->user()->image) }}" alt="Profile" class="rounded-circle">
        <div class="overlay">
            <div class="text">Remove</div>
        </div>
    </a>
    <span wire:loading.class="spinner-border spinner-border-sm position-absolute bottom-50 text-dark" wire:target="removeAvatar"></span>
    @else
    <img src="{{ is_url(auth()->user()->image) ? auth()->user()->image : asset("storage/avatar/".auth()->user()->image) }}" alt="Profile" class="rounded-circle">
    @endif
</span>
@else
<div class="user-word-avatar{{ $type }}">
    {{ auth()->user()->first_name[0]."".auth()->user()->last_name[0] }}
</div>
@endif