<nav class="fixed left-0 top-0 right-0 h-10 border-b border-zinc-100 z-10 bg-white">
    <div class="h-full flex justify-between items-center px-2">
        <div>
            <p> </p>
        </div>

        <div>
            <a href="{{ route('dashboard') }}" class="hover:text-gray-600 font-semibold">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="flex space-x-4">
            <span class="relative" x-data="{dropdown: false}">
                <span x-on:click="dropdown = !dropdown">
                    @if (isset(auth()->user()->Profile->profile_image) and auth()->user()->Profile->profile_image)
                        <button type="button" class="w-8 h-8 text-sm bg-gray-100 rounded-full flex items-center justify-center">
                            <div class="w-8 h-8 rounded-full bg-cover" style="background-image: url({{ Storage::url('public/dp/' . auth()->user()->Profile->profile_image) }})"></div>
                        </button>
                    @else
                        <button type="button" class="w-8 h-8 text-sm bg-gray-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </button>
                    @endif
                </span>

                <div class="absolute bg-white border rounded-lg py-2 mt-2 right-0 w-40" x-show="dropdown" x-on:click.away="dropdown = false" x-cloak>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('setting') }}" class="flex items-center space-x-4 px-4 py-1 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <p class="text-xs">Setting</p>
                        </a>
                    @endif

                    <a href="{{ route('profile', ['id' => auth()->user()->id]) }}" class="flex items-center space-x-4 px-4 py-1 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <p class="text-xs">Profile</p>
                    </a>

                    <form method="post" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="flex items-center space-x-4 px-4 py-1 hover:bg-gray-100 w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>

                            <p class="text-xs">Sign Out</p>
                        </button>
                    </form>
                </div>
            </span>


        </div>
    </div>
</nav>
