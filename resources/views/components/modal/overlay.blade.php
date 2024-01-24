@props([
    'id' => 'modal-example',
    'title' => 'Modal Example',
])

<div
    class="fixed inset-0 z-50 flex flex-col items-center justify-end px-5 overflow-y-auto bg-slate-800 bg-opacity-50 sm:justify-start sm:px-0"
    x-data="{modal:false}"
    x-show="modal"
    x-on:modal-overlay.window="if ($event.detail.id == '{{ $id }}') modal=true"
    x-on:close-modal-overlay.window="if ($event.detail.id == '{{ $id }}') modal=false"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak>
	<div
        class="w-full my-10 transition-all transform sm:max-w-md"
        x-show="modal"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4 sm:translate-y-4"
        x-on:click.away="modal=false, bsd(false)"
        x-cloak>
		<div class="bg-white rounded shadow-sm">
            <div class="flex items-center justify-between px-4 py-2">
                <div>
                    <p class="font-semibold text-sm">{{ $title }}</p>
                </div>

                <div>
                    <button type="button" x-on:click="modal=false, bsd(false)" class="text-gray-300 hover:text-gray-800 hover:bg-gray-200 w-6 h-6 rounded-full flex items-center justify-center transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{ $slot }}
		</div>
	</div>
</div>
