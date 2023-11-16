<article>

    <div>
        <div>
            <img class="h-24 w-full object-cover" src="{{asset('images/snippet_banner.png')}}" alt="">
        </div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="-mt-16 sm:-mt-24 sm:flex sm:items-end sm:space-x-5">
                <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="mt-6 min-w-0 flex-1">
                        <h1 class="truncate text-2xl font-bold text-gray-900">New Snippet</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 px-4 pb-6 sm:px-6 lg:px-8 space-y-2">
        <div>
            <h2 class="text-sm font-medium text-gray-500">Tags</h2>
            <ul role="list" class="mt-2 leading-8">
                @foreach($tags as $key => $tag)
                    <li class="inline">
                        <button wire:click="updatetags('{{$key}}')" class="relative inline-flex items-center rounded-full px-2.5 py-1 ring-1 ring-inset @if(key_exists($key,$tagsSelected)) ring-orange-600 @else ring-gray-300 @endif hover:bg-gray-50">
                            <div class="absolute flex flex-shrink-0 items-center justify-center">
                                <span class="h-1.5 w-1.5 rounded-full bg-{{$tag}}" aria-hidden="true"></span>
                            </div>
                            <div class="ml-3 text-xs font-semibold text-gray-900">{{$key}}</div>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="space-y-2">
            <div>
                <label for="title" style="display:block">Title</label>
                <input type="text" class="h-8 w-full" style="border:1px solid #ccc" name="title" wire:model.lazy="title">
            </div>

            <div>
                <livewire:trix :value="$body" />
            </div>
        </div>
        <div class="mt-2">
            <button type="button" wire:click="save" class="inline-flex items-center gap-x-1.5 rounded-md bg-orange-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                Save
            </button>
        </div>
    </div>

</article>
