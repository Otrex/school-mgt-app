<button type="submit" class="btn btn-primary">
    <span>{{ $name }}</span>
    <div wire:loading.class="spinner-border spinner-border-sm text-{{ $spinner_color }}" wire:target="{{ $target }}" role="status"></div>
</button>