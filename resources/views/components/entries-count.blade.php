<span>
    <span>{!! __('Showing') !!}</span>
    <span class="font-medium">{{ $collection->firstItem() ?? 0 }}</span>
    <span>{!! __('to') !!}</span>
    <span class="font-medium">{{ $collection->lastItem() ?? 0 }}</span>
    <span>{!! __('of') !!}</span>
    <span class="font-medium">{{ $collection->total() }}</span>
    <span>{!! __('entries') !!}</span>
</span>
