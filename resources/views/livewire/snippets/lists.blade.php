<nav class="min-h-0 flex-1 overflow-y-auto" aria-label="Directory" wire:init="loadSnippets">
    @foreach($snippets as $key => $snippet)
        <div class="relative">
            <div class="sticky top-0 z-10 border-b border-t border-gray-200 bg-gray-50 px-6 py-1 text-sm font-medium text-gray-500">
                <h3>{{$key}}</h3>
            </div>
            <ul role="list" class="relative z-0 divide-y divide-gray-200">
                @foreach($snippet as $item)
                <li>
                    <div class="relative flex items-center space-x-3 px-6 py-5 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-500 hover:bg-gray-50">
                        <div class="min-w-0 flex-1">
                            <button wire:click="show({{$item->id}})" class="focus:outline-none" @click="open = false">
                                <!-- Extend touch target to entire panel -->
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900 text-left">{{$item->title}}</p>
                                <p class="truncate text-sm text-gray-500">{{\Carbon\Carbon::parse($item->updated_at)->diffForHumans()}}</p>
                            </button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    @endforeach
    </nav>

