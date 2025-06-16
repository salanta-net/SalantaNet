<div class="px-6 pb-4 pt-6">
    <h2 class="text-lg font-medium text-gray-900">My List</h2>
    <p class="mt-1 text-sm text-gray-600">Search list of {{\Illuminate\Support\Facades\DB::table('snippets')->count()}} snippets</p>
    <div x-data="{ open: false }">
        <div class="mt-6 flex gap-x-2">

            <div class="min-w-0 flex-1">
                <label for="search" class="sr-only">Search</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="search" wire:model.live="search" class="block w-full rounded-md border-0 py-1.5 pl-10 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6" placeholder="Search">
                </div>
            </div>
            <button @click="open = ! open" class="group inline-flex justify-center rounded-md bg-white px-2 py-2 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path class="group-hover:text-orange-600" fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Filter</span>
            </button>

            <button type="button" wire:click="newsnippet" class="relative rounded-full bg-orange-600 px-2 text-white hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                <span class="absolute -inset-1.5"></span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"></path>
                </svg>
                <span class="sr-only">Add New</span>
            </button>
        </div>
        <div x-show="open"  @click.outside="open = false">
            <ul x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="relative z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base ring-1 shadow-lg ring-black/5 focus:outline-hidden sm:text-sm" >
                @foreach($tags as $tag)
                    <li wire:click="addfilter({{$tag->id}}, '{{$tag->label}}')" class="relative cursor-pointer select-none py-2 pl-8 pr-4 text-gray-900 hover:bg-orange-100" id="listbox-option-0" role="option">
                        <span class="block truncate font-normal">{{$tag->label}}</span>
                        <span class="absolute inset-y-0 left-0 flex items-center pl-1.5 text-orange-600">
                        @if(in_array($tag->id,array_keys($filterselected)))
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 stroke-green-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
                            </svg>
                        @endif

                </span>
                    </li>
                @endforeach
                    <li wire:click="applyfilter()" @click="open = false" class="relative cursor-pointer select-none py-2 pl-8 pr-4 flex justify-center text-gray-900 bg-orange-100 hover:bg-orange-200" id="listbox-option-0" role="option">
                        <span class="block truncate font-normal">Apply filter</span>
                        <span class="absolute inset-y-0 left-0 flex items-center pl-1.5 text-orange-600"></span>
                    </li>
            </ul>
        </div>
        <div>
            @if(!empty($filterselected))
                <ul role="list" class="mt-2 leading-8">
                    @foreach($filterselected as $key => $tag)
                        <li class="inline">
                            <div class="relative inline-flex items-center rounded-full px-2.5 py-1 ring-1 ring-inset ring-gray-300">
                                <div class="text-xs font-semibold text-gray-900">{{$tag}}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>


