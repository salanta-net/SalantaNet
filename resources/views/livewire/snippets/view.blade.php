<div>
@if($tab == -1)
        @livewire('snippets.create')
@elseif($tab == 0)
        @livewire('snippets.create',['editSnippet'=>true,'editid'=> $editid])
@endif

<livewire:snippets.show />
</div>


