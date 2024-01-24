<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Task</p>
            <p class="text-sm font-light">Assign and Manage Task.</p>
        </div>

        <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
            <div>
                @if (auth()->user()->isAdmin() or auth()->user()->isManager())
                    <x-modal.trigger target="modal_assign_task">
                        <x-action.button accent="primary" class="px-4 py-2">ASSIGN</x-action.button>
                    </x-modal.trigger>

                    <x-modal.overlay id="modal_assign_task" title="Assign Task">
                        <div class="p-4">
                            <form method="post">
                                @csrf
                                <div class="space-y-2">
                                    <x-form.select id="user_id" name="user_id">
                                        <option value="" selected disabled>Choose Employee</option>
                                        @foreach ($users as $row)
                                            @if (auth()->user()->isAdmin() and $row->Profile)
                                                <option value="{{ $row->id }}">{{ $row->Profile->fullname() }}</option>
                                            @else
                                                @if ($row->Profile and $row->Department->department_id == auth()->user()->Department->department_id)
                                                    <option value="{{ $row->id }}">{{ $row->Profile->fullname() }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </x-form.select>

                                    <x-form.input label="Task" id="task" name="task" />
                                    <x-form.input type="date" label="Due Date" id="due_date" name="due_date" />

                                    <div class="flex items-center justify-end">
                                        <x-action.button type="submit" accent="primary" name="assign_task" class="px-4 py-2">ASSIGN</x-action.button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </x-modal.overlay>
                @endif
            </div>

            <x-table.base>
                <x-slot name="thead">
                    <x-table.th>NAME</x-table.th>
                    <x-table.th>TASK</x-table.th>
                    <x-table.th align="text-center">ASSIGNED DATE</x-table.th>
                    <x-table.th align="text-center">DUE DATE</x-table.th>
                    <x-table.th align="text-center">STATUS</x-table.th>
                    <x-table.th></x-table.th>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($tasks as $row)
                        <tr>
                            <x-table.td>{{ $row->Profile->fullname() }}</x-table.td>
                            <x-table.td>{{ $row->task }}</x-table.td>
                            <x-table.td align="text-center">{{ $row->created_at }}</x-table.td>
                            <x-table.td align="text-center">{{ $row->due_date }}</x-table.td>
                            <x-table.td align="text-center">{{ $row->status }}</x-table.td>
                            <x-table.td align="text-right">
                                <x-action.row.drop-list>
                                    <x-slot name="action">
                                        @if (auth()->user()->isAdmin() or auth()->user()->isManager())
                                            <x-modal.trigger target="modal_edit_task{{ $row->id }}">
                                                <x-action.row.option type="button">Update</x-action.row.option>
                                            </x-modal.trigger>
                                        @endif

                                        <input type="hidden" name="task_id" value="{{ $row->id }}">
                                        <x-action.row.option name="submit_task_progress">On Progress</x-action.row.option>
                                        <x-action.row.option name="submit_task_completed">Completed</x-action.row.option>
                                    </x-slot>
                                </x-action.row.drop-list>

                                @if (auth()->user()->isAdmin() or auth()->user()->isManager())
                                    <x-modal.overlay id="modal_edit_task{{ $row->id }}" title="Update Task">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="task_id" value="{{ $row->id }}">

                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Task" id="task" name="task" value="{{ $row->task }}" />
                                                    <x-form.input type="date" label="Start Date" id="created_at" name="created_at" value="{{ $row->created_at }}" />
                                                    <x-form.input type="date" label="Due Date" id="due_date" name="due_date" value="{{ $row->due_date }}" />

                                                    <div class="flex items-center justify-end">
                                                        <x-action.button type="submit" accent="primary" name="submit_edit_task" class="px-4 py-2">UPDATE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                @endif
                            </x-table.td>
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
</x-layouts.dashboard>
