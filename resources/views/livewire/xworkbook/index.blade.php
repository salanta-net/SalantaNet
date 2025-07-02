<div>
    <div>
        <div class="mx-auto flex max-w-2xl items-center justify-end gap-x-8 lg:mx-0 lg:max-w-none">
            <div class="flex items-center gap-x-4 sm:gap-x-6">
{{--                <button type="button" class="hidden text-sm/6 font-semibold text-gray-900 sm:block">Copy URL</button>--}}
{{--                <a href="#" class="hidden text-sm/6 font-semibold text-gray-900 sm:block">Edit</a>--}}
                <button wire:click="sync" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Sync with Shopify</button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-2">
            <h2 class="text-xl">Input</h2>
            <div>
                <div>
                    <label for="location" class="block text-sm/6 font-medium text-gray-900">Brand</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select wire:model="brandselected" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600 sm:text-sm/6">
                            <option>Select Brand</option>
                            @foreach($brands as $brand)
                            <option>{{$brand}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label for="company" class="block text-sm/6 font-semibold text-gray-900">Models <span class="text-gray-500">separate with ,</span></label>
                    <div class="mt-2.5">
                        <input type="text" name="company" id="company" autocomplete="organization" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600" />
                    </div>
                </div>
                <div>
                    <label for="location" class="block text-sm/6 font-medium text-gray-900">Type</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="location" name="location" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600 sm:text-sm/6">
                            <option>Caterpillar</option>
                            <option selected>Electrical</option>
                            <option>Mexico</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="company" class="block text-sm/6 font-semibold text-gray-900">Price</label>
                    <div class="mt-2.5">
                        <input type="text" name="company" id="company" autocomplete="organization" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-orange-600" />
                    </div>
                </div>
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
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                                    </label>
                                    <p class="pl-1"></p>
                                </div>
                                <p class="text-xs/5 text-gray-600">PDF or ZIP up to 150MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center space-x-4">
                    <div class="">
                        <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">1. Example</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>

                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-600 focus-within:ring-2 focus-within:ring-orange-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-orange-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                                    </label>
                                    <p class="pl-1"></p>
                                </div>
                                <p class="text-xs/5 text-gray-600">Image up to 150MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">2. Example</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>

                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-600 focus-within:ring-2 focus-within:ring-orange-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-orange-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                                    </label>
                                    <p class="pl-1"></p>
                                </div>
                                <p class="text-xs/5 text-gray-600">Image up to 150MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">3. Example</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>

                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-600 focus-within:ring-2 focus-within:ring-orange-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-orange-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                                    </label>
                                    <p class="pl-1"></p>
                                </div>
                                <p class="text-xs/5 text-gray-600">Image up to 150MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                    <button type="submit" class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-orange-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">Generate</button>
                </div>
            </div>

        </div>
        <div class="col-span-2 ">
            <h2 class="text-xl">Shopify Preview</h2>
            <div class="bg-gray-50 p-4 h-full">
                <div>
                    <label for="title" class="block text-sm/6 font-semibold text-gray-900">Title</label>
                    <div class="mt-2.5">
                        <input type="text" name="title" id="title" autocomplete="title" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-green-600" />
                    </div>
                </div>
                <div>
                    <label for="description" class="block text-sm/6 font-semibold text-gray-900">Description</label>
                    <textarea id="description" name="description" rows="4" aria-describedby="message-description" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-green-600">test</textarea>
                </div>
            </div>



        </div>
    </div>

</div>
