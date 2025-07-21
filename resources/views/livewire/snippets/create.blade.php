<article>
    <div>
        <div>
            <img class="h-24 w-full object-cover" src="{{asset('images/snippet_banner.png')}}" alt="">
        </div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="-mt-20 sm:-mt-24 sm:flex sm:items-end sm:space-x-5">
                <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="mt-6 min-w-0 flex-1">
                        <h1 class="truncate text-3xl font-bold text-gray-900">@if($editid > 0) Edit @else New @endif Snippet</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 px-4 pb-6 sm:px-6 lg:px-8 space-y-2">
        <div>
            <h2 class="text-sm font-medium text-gray-500">Tags</h2>
            <ul role="list" class="mt-2 leading-8">
                <div >
                    <input type="text" wire:model.live="tagsearch" class="block w-1/2 bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600 sm:text-sm/6" placeholder="Create/Search Tags">

                    @if(strlen($tagsearch) )
                    <ul x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute z-10 mt-1 max-h-60 w-1/2 overflow-auto rounded-md bg-white py-1 text-base ring-1 shadow-lg ring-black/5 focus:outline-hidden sm:text-sm" >
                        @if(!in_array($tagsearch,$tags))
                            <li wire:click="createtag('{{$tagsearch}}')" class="relative cursor-default select-none py-2 pl-8 pr-4 text-gray-900 hover:bg-orange-100" id="listbox-option-0" role="option">
                                <span class="block truncate font-normal"><strong>Add</strong> {{$tagsearch}}</span>
                                <span class="absolute inset-y-0 left-0 flex items-center pl-1.5 text-orange-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 stroke-green-600">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </span>
                            </li>
                        @endif

                        @if(!empty($tags))
                        @foreach($tags as $id => $label)
                        <li wire:click="linktag({{$id}})" class="relative cursor-default select-none py-2 pl-8 pr-4 text-gray-900 hover:bg-orange-100" id="listbox-option-0" role="option">
                            <span class="block truncate font-normal">{{$label}}</span>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-1.5 text-orange-600">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
                            </svg>

                            </span>
                        </li>
                        @endforeach
                        @endif

                    </ul>
                    @endif
                </div>

                @foreach($tagsSelected as $key => $tag)
                    <li class="inline group">
                        <div class="relative inline-flex items-center rounded-md bg-gray-200 pl-2.5 pr-1 py-1 ">
                            <div class="text-xs font-semibold text-gray-900">{{$tag}}</div>
                            <button wire:click="deletetag('{{$key}}')" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 stroke-gray-400 group-hover:stroke-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>



                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="space-y-4">
            <div>
                <label for="title" style="display:block">Title</label>
                <input type="text" class="h-8 w-full" style="border:1px solid #ccc" name="title" wire:model.lazy="title">
            </div>

            <div>
{{--                <livewire:trix :value="$content" />--}}
                <x-trix-field id="{{ $trixId }}" name="{{ $trixId }}"  wire:model.live="content" placeholder="{{ __('Share something in a snippet...') }}" autocomplete="off" />
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
    <div class="px-4 sm:px-6 lg:px-8 mt-4">
        @foreach ($errors->all() as $error)
            <p class="text-red-600">{{ $error }}</p>
        @endforeach
    </div>


</article>
