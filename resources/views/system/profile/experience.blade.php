<x-layouts.dashboard>
    <div class="space-y-12">
        <div>
            <p class="text-xl font-semibold">Profile</p>
            <p class="text-sm font-light">Your professional and personal information.</p>
        </div>

        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <p class="font-semibold">Professional Experience</p>

                <div class="flex items-center space-x-2">
                    <x-action.link href="{{ route('profile', ['id' => $user->id]) }}" accent="secondary" class="px-4 py-2">CLOSE</x-action.link>
                    <x-modal.trigger target="addModal">
                        <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                    </x-modal.trigger>
                </div>
            </div>

            <x-table.base>
                <x-slot name="thead">
                    <x-table.th>COMPANY</x-table.th>
                    <x-table.th>START</x-table.th>
                    <x-table.th>END</x-table.th>
                    <x-table.th>POSITION</x-table.th>
                    <x-table.th align="text-center">JOBSCOPE</x-table.th>
                    <x-table.th></x-table.th>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($user->Experience as $row)
                        <tr>
                            <x-table.td>{{ $row->company_name }}</x-table.td>
                            <x-table.td>{{ $row->date_from }}</x-table.td>
                            <x-table.td>{{ $row->date_until }}</x-table.td>
                            <x-table.td>{{ $row->position }}</x-table.td>
                            <x-table.td align="text-center">{{ $row->jobscope }}</x-table.td>
                            <x-table.td align="text-right">
                                <x-action.row.drop-list>
                                    <x-slot name="action">
                                        <x-modal.trigger target="updateModal{{ $row->id }}">
                                            <x-action.row.option type="button">Update</x-action.row.option>
                                        </x-modal.trigger>

                                        <input type="hidden" name="experience_id" value="{{ $row->id }}">
                                        <x-action.row.option name="submit_delete">Delete</x-action.row.option>
                                    </x-slot>
                                </x-action.row.drop-list>

                                <x-modal.overlay id="updateModal{{ $row->id }}" title="Update Professional">
                                    <div class="p-4">
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" name="experience_id" value="{{ $row->id }}">

                                            <div class="space-y-2 text-left">
                                                <x-form.input label="Company" id="company_name" name="company_name" value="{{ $row->company_name }}" />
                                                <x-form.input type="date" label="From" id="date_from" name="date_from" value="{{ $row->date_from }}" />
                                                <x-form.input type="date" label="Until" id="date_until" name="date_until" value="{{ $row->date_until }}" />
                                                <x-form.input label="Position" id="position" name="position" value="{{ $row->position }}" />
                                                <x-form.input label="Job Scope" id="jobscope" name="jobscope" value="{{ $row->jobscope }}" />
                                                <div class="flex items-center justify-end space-x-2">
                                                    <x-action.button x-on:click="modal=false" accent="secondary" class="px-4 py-2">CANCEL</x-action.button>
                                                    <x-action.button type="submit" accent="primary" name="submit_update" class="px-4 py-2">SAVE</x-action.button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal.overlay>
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

    <x-modal.overlay id="addModal" title="Add Professional Experience">
        <div class="p-4">
            <form method="post">
                @csrf

                <div class="space-y-2 text-left">
                    <x-form.input label="Company" id="company_name" name="company_name" />
                    <x-form.input type="date" label="From" id="date_from" name="date_from" />
                    <x-form.input type="date" label="Until" id="date_until" name="date_until" />
                    <x-form.input label="Position" id="position" name="position" />
                    <x-form.input label="Job Scope" id="jobscope" name="jobscope" />
                    <div class="flex items-center justify-end space-x-2">
                        <x-action.button x-on:click="modal=false" accent="secondary" class="px-4 py-2">CANCEL</x-action.button>
                        <x-action.button type="submit" accent="primary" name="submit_add" class="px-4 py-2">ADD</x-action.button>
                    </div>
                </div>
            </form>
        </div>
    </x-modal.overlay>
</x-layouts.dashboard>
