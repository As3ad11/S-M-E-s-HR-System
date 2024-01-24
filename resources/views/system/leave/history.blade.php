<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Leave</p>
            <p class="text-sm font-light">Manage Leave Application.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('leave') }}">NEW APPLICATION</x-action.tab-link>
                <x-action.tab-link href="{{ route('leave.history') }}" active="true">HISTORY</x-action.tab-link>
                <x-action.tab-link href="{{ route('leave.information') }}">LEAVE INFORMATION</x-action.tab-link>
            </div>

            <div class="space-y-2 bg-white border border-gray-100 rounded p-4">
                <div class="flex items-center space-x-2">
                    <p class="text-sm font-semibold">History Leave</p>
                </div>

                <x-table.base>
                    <x-slot name="thead">
                        <x-table.th>NAME</x-table.th>
                        <x-table.th>CONTACT</x-table.th>
                        <x-table.th>EMAIL</x-table.th>
                        <x-table.th>START</x-table.th>
                        <x-table.th>END</x-table.th>
                        <x-table.th align="text-center">COUNT</x-table.th>
                        <x-table.th align="text-right">STATUS</x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($leaves as $row)
                            <tr>
                                <x-table.td class="p-2">{{ $row->Profile->fullname() }}</x-table.td>
                                <x-table.td class="p-2">{{ $row->Profile->phone }}</x-table.td>
                                <x-table.td class="p-2">{{ $row->User->email }}</x-table.td>
                                <x-table.td class="p-2">{{ $row->start_date }}</x-table.td>
                                <x-table.td class="p-2">{{ $row->end_date }}</x-table.td>
                                <x-table.td align="text-center" class="p-2">{{ $row->count }}</x-table.td>
                                <x-table.td align="text-right" class="p-2">{{ ($row->status == 1) ? 'APPROVED' : 'REJECTED' }}</x-table.td>
                            </tr>
                        @empty
                            <tr>
                                <x-table.td colspan="6">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
