<span class="relative" x-data="{dropdown: false}">
    <button x-on:click="dropdown = !dropdown" class="bg-white hover:bg-indigo-200 hover:text-indigo-800 cursor-pointer transition duration-200 ease-in-out p-1 rounded-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
          </svg>
    </button>

    <div class="absolute bg-white border rounded-lg py-2 mt-2 right-0 w-40 z-20" x-show="dropdown" x-on:click.away="dropdown = false" x-cloak>
        <form method="post">
            @csrf
            {{ $action }}
        </form>
    </div>
</span>
