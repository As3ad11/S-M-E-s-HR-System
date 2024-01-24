<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Covid-19 Tracker</p>
            <p class="text-sm font-light">Track Covid-19 Management.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('covidtracker') }}">HEALTH STATUS</x-action.tab-link>
                <x-action.tab-link href="{{ route('covidtracker.cases') }}" active="true">COVID CASE TRACK</x-action.tab-link>
                <x-action.tab-link href="{{ route('covidtracker.vaccinated') }}">VACCINATED LIST</x-action.tab-link>
            </div>

            <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
                <div class="flex items-center space-x-2">
                    <p class="text-sm font-semibold">Covid-19 Case Track</p>
                    <a href="{{ route('covidtracker.cases') }}" class="bg-green-500 hover:bg-green-600 text-white text-xs text-center rounded py-1 px-2">
                        Refresh
                    </a>
                </div>

                <x-table.base>
                    <x-slot name="thead">
                        <x-table.th>DATE</x-table.th>
                        <x-table.th align="text-right">CASE COUNT</x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($cases as $row)
                            <tr>
                                <x-table.td>{{ $row->date }}</x-table.td>
                                <x-table.td align="text-right">{{ $row->count }} CASE(S)</x-table.td>
                            </tr>
                        @empty
                            <tr>
                                <x-table.td colspan="2">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
