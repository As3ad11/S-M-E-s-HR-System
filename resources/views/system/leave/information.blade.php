<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Leave</p>
            <p class="text-sm font-light">Manage Leave Application.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('leave') }}">NEW APPLICATION</x-action.tab-link>
                <x-action.tab-link href="{{ route('leave.history') }}">HISTORY</x-action.tab-link>
                <x-action.tab-link href="{{ route('leave.information') }}" active="true">LEAVE INFORMATION</x-action.tab-link>
            </div>

            @if (auth()->user()->isAdmin())
                <form method="post">
                    @csrf
                    <div class="flex space-x-2 items-center">
                        <div class="w-80">
                            <x-form.select id="employee" name="employee">
                                <option value="" selected disabled>Select Employee</option>
                                @foreach ($users as $row)
                                    @if ($row->Profile)
                                        <option value="{{ $row->id }}" {{ ($current_user == $row->id) ? 'selected' : '' }}>{{ $row->Profile->fullname() }}</option>
                                    @endif
                                @endforeach
                            </x-form.select>
                        </div>

                        <x-action.button type="submit" accent="primary" name="search_employee" class="px-4 py-2">SEARCH</x-action.button>
                    </div>
                </form>
            @endif

            <div class="space-y-4">
                <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold">Leave Information</p>
                        @if (auth()->user()->isAdmin())
                            <div>
                                <x-modal.trigger target="modal_add_leave">
                                    <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                                </x-modal.trigger>

                                <x-modal.overlay id="modal_add_leave" title="Modal">
                                    <div class="p-4">
                                        <form method="post">
                                            @csrf
                                            <div class="space-y-4">
                                                <x-form.select id="leave_type" name="leave_type">
                                                    <option value="" selected disabled>Choose Leave Type</option>
                                                    @foreach ($leave_categories as $row)
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endforeach
                                                </x-form.select>

                                                <x-form.input label="Balance" id="balance" name="balance" />

                                                <div class="flex items-center justify-end">
                                                    <x-action.button type="submit" accent="primary" name="submit_add_leave_balance" class="px-4 py-2">ADD</x-action.button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal.overlay>
                            </div>
                        @endif
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>LEAVE TYPE</x-table.th>
                            <x-table.th align="text-right">BALANCE</x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($leave_balances as $row)
                                <tr>
                                    <x-table.td>{{ $row->Leave->name }}</x-table.td>
                                    <x-table.td align="text-right">{{ $row->balance }} DAY(S)</x-table.td>
                                </tr>
                            @empty
                                <tr>
                                    <x-table.td colspan="2">NO INFORMATION</x-table.td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.base>
                </div>

                <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold">Credit Information</p>
                        <div>
                            <x-modal.trigger target="modal_add_credit">
                                <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                            </x-modal.trigger>

                            <x-modal.overlay id="modal_add_credit" title="Modal">
                                <div class="p-4">
                                    <form method="post">
                                        @csrf
                                        <div class="space-y-4">
                                            <x-form.select id="credit_category" name="credit_category" required>
                                                <option value="" selected disabled>Choose Credit Category</option>
                                                @foreach ($credit_categories as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </x-form.select>

                                            <x-form.input type="number" label="Amount" id="credit" name="credit" required />

                                            <div class="flex items-center justify-end">
                                                <x-action.button type="submit" accent="primary" name="submit_add_credit" class="px-4 py-2">APPLY</x-action.button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </x-modal.overlay>
                        </div>
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>CREDIT TYPE</x-table.th>
                            <x-table.th align="text-right">AMOUNT</x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($credit_amount as $row)
                                <tr>
                                    <x-table.td>{{ $row->Credit->name }}</x-table.td>
                                    <x-table.td align="text-right">RM {{ $row->amount }}</x-table.td>
                                </tr>
                            @empty
                                <tr>
                                    <x-table.td colspan="2">NO INFORMATION</x-table.td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.base>
                </div>

                @if (auth()->user()->isAdmin())
                    <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
                        <div class="flex items-center space-x-2">
                            <p class="text-sm font-semibold">Applied Credit</p>
                        </div>

                        <x-table.base>
                            <x-slot name="thead">
                                <x-table.th>NAME</x-table.th>
                                <x-table.th align="text-center">CREDIT TYPE</x-table.th>
                                <x-table.th align="text-right">AMOUNT</x-table.th>
                                <x-table.th></x-table.th>
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($credit_amount_pending as $row)
                                    @if ($row->Profile)
                                        <tr>
                                            <x-table.td>{{ $row->Profile->fullname() }}</x-table.td>
                                            <x-table.td align="text-center">{{ $row->Credit->name }}</x-table.td>
                                            <x-table.td align="text-right">RM {{ $row->amount }}</x-table.td>
                                            <x-table.td align="text-right">
                                                <x-action.row.drop-list>
                                                    <x-slot name="action">
                                                        <input type="hidden" name="credit_apply_id" value="{{ $row->id }}">
                                                        <x-action.row.option name="submit_credit_approve">Approve</x-action.row.option>
                                                        <x-action.row.option name="submit_credit_reject">Reject</x-action.row.option>
                                                    </x-slot>
                                                </x-action.row.drop-list>
                                            </x-table.td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <x-table.td colspan="3">NO INFORMATION</x-table.td>
                                    </tr>
                                @endforelse
                            </x-slot>
                        </x-table.base>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.dashboard>
