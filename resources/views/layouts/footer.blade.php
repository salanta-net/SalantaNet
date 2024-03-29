<!-- Foooter -->
    <div class="max-w-screen-xl px-4 py-4 mx-auto space-y-4 overflow-hidden sm:px-6 lg:px-8">
        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            <div class="px-5 py-2">
                <a href="{{route('login')}}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Login
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    About
                </a>
            </div>

            <div class="px-5 py-2">
                <a href="{{route('guideline')}}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Guidelines
                </a>
            </div>
        </nav>
        <p class="mt-8 text-base leading-6 text-center text-gray-400">
            © {{now()->format('Y')}} Salanta.net, All rights reserved.
        </p>
    </div>
