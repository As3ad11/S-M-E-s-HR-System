<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Organization</p>
            <p class="text-sm font-light">Manage your organization.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('organization') }}">EMPLOYEE LIST</x-action.tab-link>
                <x-action.tab-link href="{{ route('organization.chart') }}" active="true">CHART ORGANIZATION</x-action.tab-link>
            </div>

            <div class="space-y-2 bg-white border border-gray-100 rounded p-4">
                <div class="flex items-center justify-between space-x-2">
                    <p class="text-sm font-semibold">Chart Organization</p>
                    @if (auth()->user()->isAdmin())
                        <div>
                            <x-modal.trigger target="modal_add_to_chart">
                                <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                            </x-modal.trigger>

                            <x-modal.overlay id="modal_add_to_chart" title="Add Employee into Chart Organization">
                                <div class="p-4">
                                    <form method="post">
                                        @csrf
                                        <div class="space-y-2">
                                            <x-form.select id="employee" name="employee">
                                                <option value="null" selected disabled>Choose Employee</option>
                                                @foreach ($employee as $row)
                                                    @if ($row->Profile)
                                                        <option value="{{ $row->id }}">{{ $row->Profile->fullname() }}</option>
                                                    @endif
                                                @endforeach
                                            </x-form.select>
                                            <x-form.select id="level" name="level">
                                                <option value="null" selected disabled>Choose Level</option>
                                                <option value="1">Level 1</option>
                                                <option value="2">Level 2</option>
                                                <option value="3">Level 3</option>
                                            </x-form.select>
                                            <div class="flex items-center justify-end">
                                                <x-action.button type="submit" accent="primary" name="submit_add_chart" class="px-4 py-2">ADD</x-action.button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </x-modal.overlay>
                        </div>
                    @endif
                </div>

                <div class="space-y-2">
                    <div class="flex justify-center relative px-8">
                        <p class="absolute top-2 left-2 text-xs font-light">Level 1</p>
                        @forelse ($level_1_users as $row)
                            <span class="w-32 h-32 p-2 rounded-xl {{ ($row->user_id == auth()->user()->id) ? 'bg-indigo-200' : 'bg-gray-100' }} flex items-center justify-center text-white flex-col m-1 relative">
                                @if (auth()->user()->isAdmin())
                                    <form method="post" class="absolute top-0 right-0">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button type="submit" name="submit_remove" class="pt-1 pr-1 text-gray-200 hover:text-gray-800 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                <span class="{{ ($row->user_id == auth()->user()->id) ? 'bg-indigo-500' : 'bg-gray-500' }} p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <div class="flex flex-col justify-center items-center">
                                    @if ($row->Profile)
                                        <p class="text-xs {{ ($row->user_id == auth()->user()->id) ? 'text-indigo-800' : 'text-gray-800' }} text-center font-semibold">{{ mb_strimwidth($row->Profile->fullname(), 0, 32, "..."); }}</p>
                                        <p class="text-xs {{ ($row->user_id == auth()->user()->id) ? 'text-indigo-800' : 'text-gray-800' }} text-center">{{ mb_strimwidth($row->Profile->position, 0, 18, "..."); }}</p>
                                    @endif
                                </div>
                            </span>
                        @empty
                            <p class="text-sm">No data</p>
                        @endforelse
                    </div>

                    <div class="flex justify-center relative px-8">
                        <p class="absolute top-2 left-2 text-xs font-light">Level 2</p>
                        @forelse ($level_2_users as $row)
                            <span class="w-32 h-32 p-2 rounded-xl {{ ($row->user_id == auth()->user()->id) ? 'bg-indigo-200' : 'bg-gray-100' }} flex items-center justify-center text-white flex-col m-1 relative">
                                @if (auth()->user()->isAdmin())
                                    <form method="post" class="absolute top-0 right-0">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button type="submit" name="submit_remove" class="pt-1 pr-1 text-gray-200 hover:text-gray-800 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                <span class="{{ ($row->user_id == auth()->user()->id) ? 'bg-indigo-500' : 'bg-gray-500' }} p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <div class="flex flex-col justify-center items-center">
                                    @if ($row->Profile)
                                        <p class="text-xs {{ ($row->user_id == auth()->user()->id) ? 'text-indigo-800' : 'text-gray-800' }} text-center font-semibold">{{ mb_strimwidth($row->Profile->fullname(), 0, 32, "..."); }}</p>
                                        <p class="text-xs {{ ($row->user_id == auth()->user()->id) ? 'text-indigo-800' : 'text-gray-800' }} text-center">{{ mb_strimwidth($row->Profile->position, 0, 18, "..."); }}</p>
                                    @endif
                                </div>
                            </span>
                        @empty
                            <p class="text-sm">No data</p>
                        @endforelse
                    </div>

                    <div class="flex justify-center relative px-8">
                        <p class="absolute top-2 left-2 text-xs font-light">Level 3</p>
                        @forelse ($level_3_users as $row)
                            <span class="w-32 h-32 p-2 rounded-xl {{ ($row->user_id == auth()->user()->id) ? 'bg-indigo-200' : 'bg-gray-100' }} flex items-center justify-center text-white flex-col m-1 relative">
                                @if (auth()->user()->isAdmin())
                                    <form method="post" class="absolute top-0 right-0">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button type="submit" name="submit_remove" class="pt-1 pr-1 text-gray-200 hover:text-gray-800 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                <span class="{{ ($row->user_id == auth()->user()->id) ? 'bg-indigo-500' : 'bg-gray-500' }} p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <div class="flex flex-col justify-center items-center">
                                    @if ($row->Profile)
                                        <p class="text-xs {{ ($row->user_id == auth()->user()->id) ? 'text-indigo-800' : 'text-gray-800' }} text-center font-semibold">{{ mb_strimwidth($row->Profile->fullname(), 0, 32, "..."); }}</p>
                                        <p class="text-xs {{ ($row->user_id == auth()->user()->id) ? 'text-indigo-800' : 'text-gray-800' }} text-center">{{ mb_strimwidth($row->Profile->position, 0, 18, "..."); }}</p>
                                    @endif
                                </div>
                            </span>
                        @empty
                            <p class="text-sm">No data</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
