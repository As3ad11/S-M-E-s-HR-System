<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Setting</p>
            <p class="text-sm font-light">Manage Your System Setting.</p>
        </div>

        <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Department</p>
                    <div>
                        <x-modal.trigger target="modal_create_department">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>
                        <x-modal.overlay id="modal_create_department" title="Add Department">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <x-form.input label="Name" id="name" name="name" />
                                        <div class="flex items-center justify-end">
                                            <x-action.button type="submit" accent="primary" name="submit_create_department" class="px-4 py-2">ADD</x-action.button>
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
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($departments as $row)
                            <tr>
                                <x-table.td>{{ $row->name }}</x-table.td>
                                <x-table.td align="text-right">
                                    <x-action.row.drop-list>
                                        <x-slot name="action">
                                            <x-modal.trigger target="modal_edit_department{{ $row->id }}">
                                                <x-action.row.option type="button">Update</x-action.row.option>
                                            </x-modal.trigger>
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <x-action.row.option name="submit_delete_department">Delete</x-action.row.option>
                                        </x-slot>
                                    </x-action.row.drop-list>
                                    <x-modal.overlay id="modal_edit_department{{ $row->id }}" title="Update Task">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Name" id="name" name="name" value="{{ $row->name }}" />
                                                    <div class="flex items-center justify-end">
                                                        <x-action.button type="submit" accent="primary" name="submit_update_department" class="px-4 py-2">UPDATE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                </x-table.td>
                            </tr>
                        @empty
                            <tr>
                                <x-table.td colspan="2">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Leave Categories</p>
                    <div>
                        <x-modal.trigger target="modal_create_leave_category">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>

                        <x-modal.overlay id="modal_create_leave_category" title="Add Leave Category">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <x-form.input label="Name" id="name" name="name" />
                                        <div class="flex items-center justify-end">
                                            <x-action.button type="submit" accent="primary" name="submit_create_leave_category" class="px-4 py-2">ADD</x-action.button>
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
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($leave_categories as $row)
                            <tr>
                                <x-table.td>{{ $row->name }}</x-table.td>
                                <x-table.td align="text-right">
                                    <x-action.row.drop-list>
                                        <x-slot name="action">
                                            <x-modal.trigger target="modal_edit_leave_category{{ $row->id }}">
                                                <x-action.row.option type="button">Update</x-action.row.option>
                                            </x-modal.trigger>
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <x-action.row.option name="submit_delete_leave_category">Delete</x-action.row.option>
                                        </x-slot>
                                    </x-action.row.drop-list>
                                    <x-modal.overlay id="modal_edit_leave_category{{ $row->id }}" title="Update Leave Category">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Name" id="name" name="name" value="{{ $row->name }}" />
                                                    <div class="flex items-center justify-end">
                                                        <x-action.button type="submit" accent="primary" name="submit_update_leave_category" class="px-4 py-2">UPDATE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                </x-table.td>
                            </tr>
                        @empty
                            <tr>
                                <x-table.td colspan="2">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Credit Categories</p>
                    <div>
                        <x-modal.trigger target="modal_create_credit_category">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>

                        <x-modal.overlay id="modal_create_credit_category" title="Add Credit Category">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <x-form.input label="Name" id="name" name="name" />
                                        <div class="flex items-center justify-end">
                                            <x-action.button type="submit" accent="primary" name="submit_create_credit_category" class="px-4 py-2">ADD</x-action.button>
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
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($credit_categories as $row)
                            <tr>
                                <x-table.td>{{ $row->name }}</x-table.td>
                                <x-table.td align="text-right">
                                    <x-action.row.drop-list>
                                        <x-slot name="action">
                                            <x-modal.trigger target="modal_edit_credit_category{{ $row->id }}">
                                                <x-action.row.option type="button">Update</x-action.row.option>
                                            </x-modal.trigger>
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <x-action.row.option name="submit_delete_credit_category">Delete</x-action.row.option>
                                        </x-slot>
                                    </x-action.row.drop-list>
                                    <x-modal.overlay id="modal_edit_credit_category{{ $row->id }}" title="Update Credit Category">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Name" id="name" name="name" value="{{ $row->name }}" />
                                                    <div class="flex items-center justify-end">
                                                        <x-action.button type="submit" accent="primary" name="submit_update_credit_category" class="px-4 py-2">UPDATE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                </x-table.td>
                            </tr>
                        @empty
                            <tr>
                                <x-table.td colspan="2">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Covid-19 Risk Status</p>
                    <div>
                        <x-modal.trigger target="modal_add_covid_status">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>
                        <x-modal.overlay id="modal_add_covid_status" title="Add Covid Status">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <x-form.input label="Name" id="name" name="name" />
                                        <x-form.select label="Report as Case" id="report_flag" name="report_flag">
                                            <option value="" selected disabled>Choose any</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </x-form.select>
                                        <div class="flex items-center justify-end">
                                            <x-action.button type="submit" accent="primary" name="submit_add_covid_status" class="px-4 py-2">ADD</x-action.button>
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
                        <x-table.th align="text-center">REPORT AS CASE</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($covid_status as $row)
                            <tr>
                                <x-table.td>{{ $row->name }}</x-table.td>
                                <x-table.td align="text-center">{{ ($row->report_flag == 1) ? 'YES' : 'NO' }}</x-table.td>
                                <x-table.td align="text-right">
                                    <x-action.row.drop-list>
                                        <x-slot name="action">
                                            <x-modal.trigger target="modal_edit_covid_status{{ $row->id }}">
                                                <x-action.row.option type="button">Update</x-action.row.option>
                                            </x-modal.trigger>
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <x-action.row.option name="submit_delete_covid_status">Delete</x-action.row.option>
                                        </x-slot>
                                    </x-action.row.drop-list>
                                    <x-modal.overlay id="modal_edit_covid_status{{ $row->id }}" title="Update Covid Status">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Name" id="name" name="name" value="{{ $row->name }}" />
                                                        <x-form.select label="Report as Case" id="report_flag" name="report_flag">
                                                            <option value="" selected disabled>Choose any</option>
                                                            <option value="1" {{ ($row->report_flag == 1) ? 'selected' : '' }}>Yes</option>
                                                            <option value="0" {{ ($row->report_flag == 0) ? 'selected' : '' }}>No</option>
                                                        </x-form.select>
                                                    <div class="flex items-center justify-end">
                                                        <x-action.button type="submit" accent="primary" name="submit_update_covid_status" class="px-4 py-2">UPDATE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                </x-table.td>
                            </tr>
                        @empty
                            <tr>
                                <x-table.td colspan="2">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Vaccinated Categories</p>
                    <div>
                        <x-modal.trigger target="modal_add_vaccinated_category">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>
                        <x-modal.overlay id="modal_add_vaccinated_category" title="Add Vaccinated Category">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <x-form.input label="Name" id="name" name="name" />
                                        <div class="flex items-center justify-end">
                                            <x-action.button type="submit" accent="primary" name="submit_add_vaccinated_category" class="px-4 py-2">ADD</x-action.button>
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
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($vaccinated_categories as $row)
                            <tr>
                                <x-table.td>{{ $row->name }}</x-table.td>
                                <x-table.td align="text-right">
                                    <x-action.row.drop-list>
                                        <x-slot name="action">
                                            <x-modal.trigger target="modal_edit_vaccinated_category{{ $row->id }}">
                                                <x-action.row.option type="button">Update</x-action.row.option>
                                            </x-modal.trigger>
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <x-action.row.option name="submit_delete_vaccinated_category">Delete</x-action.row.option>
                                        </x-slot>
                                    </x-action.row.drop-list>
                                    <x-modal.overlay id="modal_edit_vaccinated_category{{ $row->id }}" title="Update Vaccinated Category">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Name" id="name" name="name" value="{{ $row->name }}" />
                                                    <div class="flex items-center justify-end">
                                                        <x-action.button type="submit" accent="primary" name="submit_update_vaccinated_category" class="px-4 py-2">UPDATE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                </x-table.td>
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
