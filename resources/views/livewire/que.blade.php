<div class="que" wire:poll.visible>
    <div class="processing">
        <h2 class="title">Processing</h2>
        <ul>
            @forelse ($processing as $item)
                <li>{{$item->or_no}}</li>
            @empty
                <li>No item</li>
            @endforelse
        </ul>
    </div>
    <div class="collect">
    <h2 class="title title-green">Collect now</h2>
        <ul>
            @forelse ($collecting as $item)
                <li>{{$item->or_no}}</li>
            @empty
                <li>No item</li>
            @endforelse
        </ul>
    </div>
</div>