<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Payslip</p>
            <p class="text-sm font-light">Manage your Payslip.</p>
        </div>

        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <form method="post">
                    @csrf
                    <div class="flex items-center space-x-2">
                        <div class="w-40">
                            <x-form.select id="year" name="year">
                                @for ($x = date('Y'); $x >= 2020; $x--)
                                    <option value="{{ $x }}" {{ ($x == $year) ? 'selected' : '' }}>{{ $x }}</option>
                                @endfor
                            </x-form.select>
                        </div>
                        <div class="w-40">
                            <x-form.select id="month" name="month">
                                @foreach ($months as $key => $name)
                                    <option value="{{ $key }}" {{ ($key == $month) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                        <x-action.button type="submit" accent="primary" name="submit" class="px-4 py-2">GO</x-action.button>
                    </div>
                </form>

                @if (auth()->user()->isAdmin())
                    <form method="post">
                        @csrf
                        <div>
                            <x-modal.trigger target="modal_assign_payslip">
                                <x-action.button accent="primary" class="px-4 py-2">ASSIGN PAYSLIP</x-action.button>
                            </x-modal.trigger>

                            <x-modal.overlay id="modal_assign_payslip" title="Assign Payslip">
                                <div class="p-4">
                                    <form method="post">
                                        @csrf

                                        <div class="space-y-4">
                                            <div class="space-y-2">
                                                <x-form.select id="employee" name="employee" >
                                                    <option value="">Choose Employee</option>
                                                    @foreach ($users as $row)
                                                        @if ($row->Profile)
                                                            <option value="{{ $row->id }}">{{ $row->Profile->fullname() }}</option>
                                                        @endif
                                                    @endforeach
                                                </x-form.select>
                                                <x-form.select id="year" name="year" >
                                                    <option value="">Choose Year</option>
                                                    @for ($x = date('Y'); $x >= 2020; $x--)
                                                        <option value="{{ $x }}">{{ $x }}</option>
                                                    @endfor
                                                </x-form.select>
                                                <x-form.select id="month" name="month" >
                                                    <option value="">Choose Month</option>
                                                    @foreach ($months as $key => $name)
                                                        <option value="{{ $key }}">{{ $name }}</option>
                                                    @endforeach
                                                </x-form.select>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-sm font-bold">Earning</p>
                                                <x-form.input label="Basic" id="basic" name="basic" type="number" step="0.01" min="0"  />
                                                <x-form.input label="Overtime" id="overtime" name="overtime" type="number" step="0.01" min="0"  />
                                                <x-form.input label="Commision" id="commision" name="commision" type="number" step="0.01" min="0"  />
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-sm font-bold">Deduction</p>
                                                <x-form.input label="EPF" id="epf" name="epf" type="number" step="0.01" min="0"  />
                                                <x-form.input label="Socso" id="socso" name="socso" type="number" step="0.01" min="0"  />
                                            </div>
                                            <div class="flex justify-end">
                                                <x-action.button type="submit" accent="primary" name="submit_assign_payslip" class="px-4 py-2">ASSIGN</x-action.button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </x-modal.overlay>
                        </div>
                    </form>
                @endif
            </div>

            <x-table.base>
                <x-slot name="thead">
                    <x-table.th>NAME</x-table.th>
                    <x-table.th>DATE</x-table.th>
                    <x-table.th></x-table.th>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($payslip as $row)
                        <tr>
                            <x-table.td>{{ $row->Profile->fullname() }}</x-table.td>
                            <x-table.td>{{ $row->month . ' ' . $row->year }}</x-table.td>
                            <x-table.td align="text-right">
                                @if (($row->user_id == auth()->user()->id) or auth()->user()->isAdmin())
                                    <x-action.row.drop-list>
                                        <x-slot name="action">
                                            <x-action.row.option type="link" href="{{ route('payslip.view', ['id' => $row->id]) }}">View</x-action.row.option>

                                            <input type="hidden" name="id" value="{{ $row->id }}" />
                                            <x-action.row.option name="submit_delete">Delete</x-action.row.option>
                                        </x-slot>
                                    </x-action.row.drop-list>
                                @endif
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="3">NO INFORMATION</x-table.td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table.base>
        </div>

        @if (auth()->user()->isHigherUp())
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Income</p>
                    <div>
                        <x-modal.trigger target="modal_add_income">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>
                        <x-modal.overlay id="modal_add_income" title="Add Income">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <x-form.input label="Amount" id="amount" name="amount" type="number" step="0.01" min="0" />
                                        <x-form.input label="Date" id="date" name="date" type="date" />
                                        <div class="flex items-center justify-end">
                                            <x-action.button type="submit" accent="primary" name="submit_add_income" class="px-4 py-2">ADD</x-action.button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </x-modal.overlay>
                    </div>
                </div>
                <x-table.base>
                    <x-slot name="thead">
                        <x-table.th>Income</x-table.th>
                        <x-table.th>Date</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($incomes as $row)
                            <tr>
                                <x-table.td>RM {{ number_format($row->amount, 2, '.', ' ') }}</x-table.td>
                                <x-table.td>{{ date('d F Y', strtotime($row->created_at)) }}</x-table.td>
                                <x-table.td align="text-right">
                                    <x-action.row.drop-list>
                                        <x-slot name="action">
                                            <x-modal.trigger target="modal_edit_income{{ $row->id }}">
                                                <x-action.row.option type="button">Update</x-action.row.option>
                                            </x-modal.trigger>
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <x-action.row.option name="submit_delete_income">Delete</x-action.row.option>
                                        </x-slot>
                                    </x-action.row.drop-list>
                                    <x-modal.overlay id="modal_edit_income{{ $row->id }}" title="Update Income">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Amount" id="amount" name="amount" value="{{ $row->amount }}" type="float" />
                                                    <div class="flex items-center justify-end">
                                                        <x-action.button type="submit" accent="primary" name="submit_update_income" class="px-4 py-2">UPDATE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                </x-table.td>
                            </tr>
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
</x-layouts.dashboard>
