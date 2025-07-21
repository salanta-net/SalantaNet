<div>
    <div>
        <div class="mx-auto flex max-w-2xl items-center justify-end gap-x-8 lg:mx-0 lg:max-w-none mb-10">
            <div class="flex items-center gap-x-4 sm:gap-x-6">
                <button wire:click="sync" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Sync with Shopify</button>
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div class="rounded-md border border-1 p-4">
            <h2 class="text-base/7 font-semibold text-gray-900 ">1. Brand & Models</h2>
            <p class="mt-1 text-sm/6 text-gray-500"></p>

            <div class="space-y-4">
                <div class="flex justify-between">
                    <div class="w-full flex flex-col justify-between">
                        <div>
                            @if(empty($products))
                                <div class="text-gray-400">
                                    No Entries
                                </div>
                            @else
                                @foreach($products as $index => $product)
                                    <p class="inline-flex items-center">{{$product[0]}} {{$product[1]}} {{$product[2]}}-{{$product[3]}} [ {{$product[4]}} ]
                                        <button wire:click="delete({{$index}})" >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 stroke-red-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </p>
                                @endforeach
                            @endif
                        </div>
                        <div>

                        </div>
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
                                        @for($i = 2025; $i >= 1975; $i--)
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
                                        @for($j = 2025; $j >= 1975; $j--)
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
        </div>

        <div class="rounded-md border border-1 p-4">
            <h2 class="text-base/7 font-semibold text-gray-900">2. Document</h2>
            <p class="mt-1 text-sm/6 text-gray-500"></p>

            <div>
                    <div class="space-y-4">
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
                                                <input id="file-upload" wire:model="document"  type="file"  />
                                            </label>
                                            <p class="pl-1"></p>
                                        </div>
                                        <p class="text-xs/5 text-gray-600">PDF or ZIP up to 250MB</p>
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
            </div>

        </div>

        <div class="rounded-md border border-1 p-4">
            <h2 class="text-base/7 font-semibold text-gray-900">3. Images</h2>
            <p class="mt-1 text-sm/6 text-gray-500"></p>
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
                                    <input id="photos-upload" name="photos-upload" wire:model="photos" type="file" multiple/>
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

        <div class="rounded-md p-4">
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>

                <button wire:click="generate()" class="inline-flex items-center rounded-md bg-orange-500 px-4 py-2 text-sm leading-6 font-semibold text-white transition duration-150 ease-in-out hover:bg-orange-400">
                    <div wire:loading wire:target="generate" class="animate-pulse">
                        <svg class="mr-3 -ml-1 size-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </div>
                    Generate
                </button>
            </div>
        </div>

    </div>







</div>
