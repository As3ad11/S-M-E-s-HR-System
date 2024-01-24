<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Dashboard</p>
            <p class="text-sm font-light">All information in one page.</p>
        </div>

        <div class="space-y-2">
            <div>
                <div class="flex items-center space-x-2">
                    @if (isset($user->Profile->profile_image) and $user->Profile->profile_image)
                        <div class="w-20 h-20 rounded-full bg-cover" style="background-image: url({{ Storage::url('public/dp/' . $user->Profile->profile_image) }})"></div>
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif

                    <div>
                        <div>
                            <p class="font-bold">{{ $user->Profile->first_name ?? '' }} {{ $user->Profile->last_name ?? '' }}</p>
                            <p class="text-sm font-light">{{ $user->Profile->position ?? '' }}</p>
                            <p class="text-xs text-gray-400 font-light">Joined {{ ($user->Profile->join_date) ? date('d F Y', strtotime($user->Profile->join_date)) : '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if (auth()->user()->isManager())
                <div class="grid grid-cols-3 gap-2">
                    <div class="space-y-2 flex flex-col">
                        <div class="bg-white border border-gray-100 rounded p-4 space-y-4 h-full">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-semibold">Salary</p>
                            </div>

                            @include('system.dashboard.charts.salary')
                        </div>

                        <div class="bg-white border border-gray-100 rounded p-4 space-y-4 h-full">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-semibold">Revenue</p>
                            </div>

                            @include('system.dashboard.charts.ravenue')
                        </div>
                    </div>

                    <div class="space-y-2 flex flex-col">
                        <div class="bg-white border border-gray-100 rounded p-4 space-y-4 h-full">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-semibold">Task</p>

                                <div class="flex space-x-2">
                                    <div>
                                        <x-form.select2 name="task_cycle" onchange="window.location='?general={{ $general_department }}&task-cycle='+this.value+'&task-department={{ $task_department }}&covid-cycle={{ $covid_cycle }}'">
                                            <option value="yearly" {{ ($task_cycle == 'yearly') ? 'selected' : '' }}>Yearly</option>
                                            <option value="monthly" {{ ($task_cycle == 'monthly') ? 'selected' : '' }}>Monthly</option>
                                        </x-form.select2>
                                    </div>

                                    <div>
                                        <x-form.select2 name="task_department" onchange="window.location='?general={{ $general_department }}&task-cycle={{ $task_cycle }}&task-department='+this.value+'&covid-cycle={{ $covid_cycle }}'">
                                            <option value="all" {{ ($task_department == 'all') ? 'selected' : '' }}>All Department</option>
                                            @forelse ($departments as $row)
                                                <option value="{{ $row->id }}" {{ ($task_department == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                            @empty

                                            @endforelse
                                        </x-form.select2>
                                    </div>
                                </div>
                            </div>

                            @include('system.dashboard.charts.task')
                        </div>

                        <div class="bg-white border border-gray-100 rounded p-4 space-y-4 h-full">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-semibold">Covid</p>

                                <div class="flex space-x-2">
                                    <div>
                                        <x-form.select2 name="covid_cycle" onchange="window.location='?general={{ $general_department }}&task-cycle={{ $task_cycle }}&task-department={{ $task_department }}&covid-cycle='+this.value">
                                            <option value="yearly" {{ ($covid_cycle == 'yearly') ? 'selected' : '' }}>Yearly</option>
                                            <option value="monthly" {{ ($covid_cycle == 'monthly') ? 'selected' : '' }}>Monthly</option>
                                        </x-form.select2>
                                    </div>
                                </div>
                            </div>

                            @include('system.dashboard.charts.covid')
                        </div>
                    </div>

                    <div class="space-y-2 flex flex-col">
                        <div>
                            <x-form.select2 name="general_department" onchange="window.location='?general='+this.value+'&task-cycle={{ $task_cycle }}&task-department={{ $task_department }}&covid-cycle={{ $covid_cycle }}'">
                                <option value="all" {{ ($general_department == 'all') ? 'selected' : '' }}>All Department</option>
                                @forelse ($departments as $row)
                                    <option value="{{ $row->id }}" {{ ($general_department == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                @empty

                                @endforelse
                            </x-form.select2>
                        </div>

                        <div class="flex flex-col space-y-2 h-full">
                            <div class="bg-white border border-gray-100 rounded p-4 h-full flex flex-col">
                                <p class="text-sm text-center text-gray-400 font-semibold">Employee</p>
                                <div class="h-full flex items-center justify-center">
                                    <p class="text-5xl text-gray-700 font-semibold tracking-tighter">{{ number_format($general['employee'], 0, '.', ' ') }}</p>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-100 rounded p-4 h-full flex flex-col">
                                <p class="text-sm text-center text-gray-400 font-semibold">Salary</p>
                                <div class="h-full flex items-center justify-center">
                                    <p class="text-5xl text-gray-700 font-semibold tracking-tighter">RM {{ number_format($general['salary'], 2, '.', ' ') }}</p>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-100 rounded p-4 h-full flex flex-col">
                                <p class="text-sm text-center text-gray-400 font-semibold">Task</p>
                                <div class="h-full flex items-center justify-center">
                                    <p class="text-5xl text-gray-700 font-semibold tracking-tighter">{{ number_format($general['task'], 0, '.', ' ') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white border border-gray-100 rounded p-4 space-y-4">
                <div>
                    <p class="text-sm font-semibold">Latest Announcement</p>
                </div>

                <div class="border rounded">
                    <table class="text-sm w-full">
                        <tbody class="divide-y">
                            @foreach ($announcements as $row)
                                <tr>
                                    <td class="p-4 text-xs uppercase">
                                        <div class="flex items-center space-x-2">
                                            <span class="w-7 h-7 rounded-full flex items-center justify-center bg-yellow-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                                </svg>
                                            </span>

                                            <div>
                                                <p class="text-xs font-semibold">{{ $row->title }}</p>
                                                <p class="text-xs text-gray-500 font-light">{{ $row->created_at }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs text-center">{{ $row->announcement }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if (auth()->user()->isAdmin())
                <div class="bg-white border border-gray-100 rounded p-4 space-y-4">
                    <div>
                        <p class="text-sm font-semibold">Latest Leave Application</p>
                    </div>

                    <div class="border rounded">
                        <table class="text-sm w-full">
                            <tbody class="divide-y">
                                @foreach ($leaves as $row)
                                    <tr>
                                        <td class="p-4 text-xs uppercase">
                                            <div class="flex items-center space-x-2">
                                                @if (isset($row->Profile->profile_image) and $row->Profile->profile_image)
                                                    <div class="w-8 h-8 rounded-full bg-cover" style="background-image: url({{ Storage::url('public/dp/' . $row->Profile->profile_image) }})"></div>
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    {{ $row->profile->first_name }} {{ $row->profile->last_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-xs text-center">FROM: {{ $row->start_date }}</td>
                                        <td class="p-4 text-xs text-center">UNTIL: {{ $row->end_date }}</td>
                                        <td class="p-4 text-xs text-right">{{ $row->count }} day(s)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="bg-white border border-gray-100 rounded p-4 space-y-4">
                <div>
                    <p class="text-sm font-semibold">Latest Health Status</p>
                </div>

                <div class="border rounded">
                    <table class="text-sm w-full">
                        <tbody class="divide-y">
                            @foreach ($health as $row)
                                <tr>
                                    <td class="p-4 text-xs uppercase">
                                        <div class="flex items-center space-x-2">
                                            @if (isset($row->Profile->profile_image) and $row->Profile->profile_image)
                                                <div class="w-8 h-8 rounded-full bg-cover" style="background-image: url({{ Storage::url('public/dp/' . $row->Profile->profile_image) }})"></div>
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                {{ $row->Profile->first_name }} {{ $row->Profile->last_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs text-center">{{ $row->Status->name }}</td>
                                    <td class="p-4 text-xs text-right">{{ ucwords($row->conditions) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
