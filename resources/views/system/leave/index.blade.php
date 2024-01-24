<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Leave</p>
            <p class="text-sm font-light">Manage Leave Application.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('leave') }}" active="true">NEW APPLICATION</x-action.tab-link>
                <x-action.tab-link href="{{ route('leave.history') }}">HISTORY</x-action.tab-link>
                <x-action.tab-link href="{{ route('leave.information') }}">LEAVE INFORMATION</x-action.tab-link>
            </div>

            <div class="space-y-2 bg-white border border-gray-100 rounded p-4">
                @if ($message != '')
                    <x-notification.alert accent="warning">
                        <p class="font-semibold">{{ $message }}</p>
                    </x-notification.alert>
                @endif

                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Applied Leave</p>
                    <div>
                        <x-modal.trigger target="modal_apply_leave">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>

                        <x-modal.overlay id="modal_apply_leave" title="Apply New Leave">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-4">
                                        @if (auth()->user()->isAdmin())
                                            <x-form.select id="user_id" name="user_id">
                                                <option value="" selected disabled>Choose Employee</option>
                                                @foreach ($users as $row)
                                                    @if ($row->Profile)
                                                        <option value="{{ $row->id }}">{{ $row->Profile->fullname() }}</option>
                                                    @endif
                                                @endforeach
                                            </x-form.select>
                                        @else
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        @endif

                                        <x-form.select id="leave_category" name="leave_category">
                                            <option value="" selected disabled>Choose Category</option>
                                            @foreach ($leave_categories as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </x-form.select>

                                        <x-form.input type="date" label="Start Date" id="start_date" name="start_date" />
                                        <x-form.input type="date" label="End Date" id="end_date" name="end_date" />
                                        <x-form.input type="number" label="Leave Count" id="count" name="count" />

                                        <div class="flex items-center justify-end">
                                            <x-action.button type="submit" accent="primary" name="submit_apply_leave" class="px-4 py-2">ADD</x-action.button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </x-modal.overlay>
                    </div>
                </div>

                <x-table.base>
                    <x-slot name="thead">
                        <x-table.th>NAME</x-table.th>
                        <x-table.th>CONTACT</x-table.th>
                        <x-table.th>EMAIL</x-table.th>
                        <x-table.th>START</x-table.th>
                        <x-table.th>END</x-table.th>
                        <x-table.th align="text-center">COUNT</x-table.th>
                        <x-table.th align="text-center">STATUS</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($leaves as $row)
                            @if ($row->Profile)
                                <tr>
                                    <x-table.td class="p-2">{{ $row->Profile->fullname() }}</x-table.td>
                                    <x-table.td class="p-2">{{ $row->Profile->phone }}</x-table.td>
                                    <x-table.td class="p-2">{{ $row->User->email }}</x-table.td>
                                    <x-table.td class="p-2">{{ $row->start_date }}</x-table.td>
                                    <x-table.td class="p-2">{{ $row->end_date }}</x-table.td>
                                    <x-table.td align="text-center" class="p-2">{{ $row->count }}</x-table.td>
                                    <x-table.td align="text-center" class="p-2">PENDING</x-table.td>
                                    <x-table.td align="text-right">
                                        @if (auth()->user()->isAdmin())
                                            <x-action.row.drop-list>
                                                <x-slot name="action">
                                                    <input type="hidden" name="leave_apply_id" value="{{ $row->id }}">
                                                    <input type="hidden" name="leave_apply_user_id" value="{{ $row->user_id }}">
                                                    <input type="hidden" name="leave_category_id" value="{{ $row->leave_category_id }}">
                                                    <input type="hidden" name="leave_count" value="{{ $row->count }}">
                                                    <x-action.row.option name="submit_leave_approve">Approve</x-action.row.option>
                                                    <x-action.row.option name="submit_leave_reject">Reject</x-action.row.option>
                                                </x-slot>
                                            </x-action.row.drop-list>
                                        @endif
                                    </x-table.td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <x-table.td colspan="7">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
