@if ($sortBy !== $field)
&nbsp; <i class="text-muted fas fa-sort"></i>
@elseif ($sortDiraction == 'asc')
&nbsp; <i class="fas fa-sort-up" style="color: #5582ec "></i>
@else
&nbsp; <i class="fas fa-sort-down" style="color: #5582ec "></i>
@endif
