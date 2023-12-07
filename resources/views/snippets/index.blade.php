<x-app-layout>
    <div class="h-[93vh] bg-white">
        <div x-data="{ open: false }" @keydown.window.escape="open = false" class="flex h-full">

            <div x-show="open" class="relative z-40 lg:hidden" x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog" aria-modal="true" style="display: none;">

                <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state." class="fixed inset-0 bg-gray-600 bg-opacity-75" style="display: none;"></div>
                <div class="fixed inset-0 z-40 flex">
                    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-description="Off-canvas menu, show/hide based on off-canvas menu state." class="relative flex w-full max-w-xs flex-1 flex-col bg-white focus:outline-none" @click.away="open = false" style="display: none;">
                        <div x-show="open" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Close button, show/hide based on off-canvas menu state." class="absolute right-0 top-0 -mr-12 pt-2" style="display: none;">
                            <button type="button" class="relative ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="open = false">
                                <span class="absolute -inset-0.5"></span>
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="h-0 flex-1 overflow-y-auto pb-4 pt-5">
                            <livewire:snippets.search />
                            <livewire:snippets.lists />
                        </div>
                    </div>
                    <div class="w-14 flex-shrink-0" aria-hidden="true"></div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
                <div class="relative z-0 flex flex-1 overflow-hidden">
                    <main class="relative z-0 flex-1 overflow-y-auto focus:outline-none xl:order-last">
                        <nav class="flex items-start px-4 py-3 sm:px-6 lg:px-8 xl:hidden" aria-label="Breadcrumb">
                            <button type="button" class="inline-flex items-center space-x-3 text-sm font-medium text-gray-900" @click="open = true">
                                <svg class="-ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"></path>
                                </svg>
                                <span>My List</span>
                            </button>
                        </nav>
{{--                        @livewire('snippets.create-edit')--}}
                        @livewire('snippets.view')
                    </main>
                    <aside class="hidden w-96 flex-shrink-0 border-r border-gray-200 xl:order-first xl:flex xl:flex-col">
                        <livewire:snippets.search />
                        <livewire:snippets.lists />
                    </aside>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
