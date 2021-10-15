@if ($sortBy !== $field)
    <i class="text-muted fas fa-sort text-white"></i>
@elseif($sortDirection == 'desc')
    <i class="text-muted fas fa-sort-down text-white"></i>
@else
    <i class="text-muted fas fa-sort-up text-white"></i>
@endif