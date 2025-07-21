<div>
    <div>
        <div class="mx-auto flex max-w-2xl items-center justify-end gap-x-8 lg:mx-0 lg:max-w-none mb-10">
            <div class="flex items-center gap-x-4 sm:gap-x-6">
                <button wire:click="sync" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Sync with Shopify</button>
            </div>
        </div>
    </div>
    <nav aria-label="Progress" class="mb-4">
        <ol role="list" class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">
            @foreach($status as $index => $tab)
            <li wire:click="$set('activetab',{{$index}})" class="relative md:flex md:flex-1">
                <!-- Completed Step -->
                <a href="#" class="group flex w-full items-center">
        <span class="flex items-center px-6 py-4 text-sm font-medium">
            @if($tab[1] == 'done')
                <span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-green-600 group-hover:bg-green-800">
            <svg class="size-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
            </svg>
          </span>
            @elseif($tab[1] == 'pending')
                <span class="flex size-10 shrink-0 items-center justify-center rounded-full border-2 border-green-600">
          <span class="text-green-600">0{{$index}}</span>
        </span>
            @elseif($tab[1] == 'open')
                <span class="flex size-10 shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
            <span class="text-gray-500 group-hover:text-gray-900">0{{$index}}</span>
          </span>
            @endif
          <span class="ml-4 text-sm font-medium text-gray-900">{{$tab[0]}}</span>
        </span>
                </a>

                @if($index < count($status))
                    <!-- Arrow separator for lg screens and up -->
                    <div class="absolute top-0 right-0 hidden h-full w-5 md:block" aria-hidden="true">
                        <svg class="size-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                @elseif($index == count($status))

                @endif
            </li>
            @endforeach
{{--            <li wire:click="$set('activetab',1)" class="relative md:flex md:flex-1">--}}
{{--                <!-- Current Step -->--}}
{{--                <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">--}}
{{--        <span class="flex size-10 shrink-0 items-center justify-center rounded-full border-2 border-green-600">--}}
{{--          <span class="text-green-600">02</span>--}}
{{--        </span>--}}
{{--                    <span class="ml-4 text-sm font-medium text-green-600">File Upload</span>--}}
{{--                </a>--}}
{{--                <!-- Arrow separator for lg screens and up -->--}}
{{--                <div class="absolute top-0 right-0 hidden h-full w-5 md:block" aria-hidden="true">--}}
{{--                    <svg class="size-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">--}}
{{--                        <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li wire:click="$set('activetab',3)" class="relative md:flex md:flex-1">--}}
                <!-- Upcoming Step -->
{{--                <a href="#" class="group flex items-center">--}}
{{--        <span class="flex items-center px-6 py-4 text-sm font-medium">--}}
{{--          <span class="flex size-10 shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">--}}
{{--            <span class="text-gray-500 group-hover:text-gray-900">03</span>--}}
{{--          </span>--}}
{{--          <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Preview</span>--}}
{{--        </span>--}}
{{--                </a>--}}
            </li>
        </ol>
    </nav>

    @switch($activetab)
        @case(1)
            <div class="space-y-4">
                <div class="flex justify-between">
                    <div class="w-full">
                        @if(empty($products))
                        <div class="text-gray-400">
                            No Entries
                        </div>
                        @else
                            @foreach($products as $product)
                                <p>{{$product[0]}} {{$product[1]}} {{$product[2]}}-{{$product[3]}} [ {{$product[4]}} ]</p>
                            @endforeach
                        @endif
                    </div>

                    <div class="w-full space-y-4">
                        <div>
                            <label for="location" class="block text-sm/6 font-medium text-gray-900">Brand</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select wire:model="brandselected" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600 sm:text-sm/6">
                                    <option value="-1" class="text-gray-400">Select Brand</option>
                                    @foreach($brands as $index => $brand)
                                        <option value="{{$index}}">{{$brand}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-red-600">@error('brandselected') {{ $message }} @enderror</div>
                        </div>
                        <div>
                            <label for="model" class="block text-sm/6 font-semibold text-gray-900">Model</label>
                            <div class="mt-2.5">
                                <input wire:model="productmodel" id="model" autocomplete="model" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600" />
                            </div>
                            <div class="text-red-600">@error('productmodel') {{ $message }} @enderror</div>
                        </div>
                        <div class="flex justify-between space-x-4">
                            <div class="w-full">
                                <label for="yearfrom" class="block text-sm/6 font-medium text-gray-900">From</label>
                                <div class="mt-2 grid grid-cols-1">
                                    <select wire:model="yearfrom" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600 sm:text-sm/6">
                                        <option value="-1" class="text-gray-400">Select Year</option>
                                        @for($i = 2025; $i >= 1990; $i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="text-red-600">@error('yearfrom') {{ $message }} @enderror</div>
                            </div>
                            <div class="w-full">
                                <label for="yearto" class="block text-sm/6 font-medium text-gray-900">To</label>
                                <div class="mt-2 grid grid-cols-1">
                                    <select wire:model="yearto" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600 sm:text-sm/6">
                                        <option value="-1" class="text-gray-400">Select Year</option>
                                        @for($j = 2025; $j >= 1990; $j--)
                                            <option value="{{$j}}">{{$j}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="text-red-600">@error('yearto') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div>
                            <label for="version" class="block text-sm/6 font-semibold text-gray-900">Version</label>
                            <div class="mt-2.5">
                                <input wire:model="version" id="version" autocomplete="version" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600" />
                            </div>
                            <div class="text-red-600">@error('version') {{ $message }} @enderror</div>
                        </div>
                        <div class="flex justify-end">
                            <button wire:click="addbrand" class="inline-flex items-center gap-x-1.5 rounded-md bg-orange-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-orange-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                                <svg class="-ml-0.5 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @break
        @case(2)
            <div class="space-y-4">
{{--                <div>--}}
{{--                    <label for="location" class="block text-sm/6 font-medium text-gray-900">Document type</label>--}}
{{--                    <div class="mt-2 grid grid-cols-1">--}}
{{--                        <select wire:model.live="producttype" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600 sm:text-sm/6">--}}
{{--                            <option value="-1">Select Product Type</option>--}}
{{--                            @foreach($producttypes as $index => $pt)--}}
{{--                                <option value="{{$index}}">{{$pt}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div>
                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">File upload</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>

                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-600 focus-within:ring-2 focus-within:ring-orange-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-orange-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" wire:model="document"  type="file" class="sr-only" />
                                    </label>
                                    <p class="pl-1"></p>
                                </div>
                                <p class="text-xs/5 text-gray-600">PDF or ZIP up to 150MB</p>
                                @error('document') <span class="text-red-600">{{ $message }}</span> @enderror
                                @if(!empty($document))
                                    <div class="text-green-600 text-2xl">
                                        Done!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @break

        @case(3)
            <div>
                <div class="space-x-4">
                    <div>
                        <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Images</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                    <label for="photos-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-600 focus-within:ring-2 focus-within:ring-orange-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-orange-500">
                                        <span>Upload a file</span>
                                        <input id="photos-upload" name="photos-upload" wire:model="photos" type="file" class="sr-only" multiple/>
                                    </label>
                                    <p class="pl-1"></p>
                                </div>
                                <p class="text-xs/5 text-gray-600">Image up to 150MB</p>
                                @error('photos') <span class="text-red-600">{{ $message }}</span> @enderror
                                @if(!empty($photos))
                                    <div class="text-green-600 text-2xl">
                                        Done!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @break

        @case(4)

            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2 ">
                    <h2 class="text-xl">Preview</h2>
                    <div class="bg-gray-50 p-4 h-full">
                        <div class="mt-4">
                            @if($producttype >= 0)
                                {!! $content !!}
                                {{--                    <x-trix-field id="{{ $trixId }}" name="{{ $trixId }}"  wire:model.live="content" placeholder="{{ __('Share something in a snippet...') }}" autocomplete="off" />--}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>

                <button wire:click="generate()" class="inline-flex items-center rounded-md bg-orange-500 px-4 py-2 text-sm leading-6 font-semibold text-white transition duration-150 ease-in-out hover:bg-orange-400">
                    <div wire:loading wire:target="generate" class="animate-pulse">
                        <svg class="mr-3 -ml-1 size-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </div>
                    Generate
                </button>
            </div>
            @break

        @default

    @endswitch




</div>
