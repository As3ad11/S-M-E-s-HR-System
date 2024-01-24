<x-layouts.dashboard>
    <div class="space-y-12">
        <div>
            <p class="text-xl font-semibold">Profile</p>
            <p class="text-sm font-light">Your professional and personal information.</p>
        </div>

        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <p class="font-semibold">Family</p>

                <div class="flex items-center space-x-2">
                    <x-action.link href="{{ route('profile', ['id' => $user->id]) }}" accent="secondary" class="px-4 py-2">CLOSE</x-action.link>
                    <x-modal.trigger target="addFamilyModal">
                        <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                    </x-modal.trigger>
                </div>
            </div>

            <x-table.base>
                <x-slot name="thead">
                    <x-table.th>NAME</x-table.th>
                    <x-table.th>CONTACT</x-table.th>
                    <x-table.th>EMAIL</x-table.th>
                    <x-table.th>DATE OF BIRTH</x-table.th>
                    <x-table.th>RELATIONSHIP</x-table.th>
                    <x-table.th align="text-center">EMERGENCY</x-table.th>
                    <x-table.th></x-table.th>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($user->Family as $row)
                        <tr>
                            <x-table.td>{{ $row->name }}</x-table.td>
                            <x-table.td>{{ $row->phone }}</x-table.td>
                            <x-table.td>{{ $row->email }}</x-table.td>
                            <x-table.td>{{ $row->date_of_birth }}</x-table.td>
                            <x-table.td>{{ $row->relationship }}</x-table.td>
                            <x-table.td align="text-center">{{ (($row->emergency_flag)) ? 'YES' : 'NO' }}</x-table.td>
                            <x-table.td align="text-right">
                                <x-action.row.drop-list>
                                    <x-slot name="action">
                                        <x-modal.trigger target="updateFamilyModal{{ $row->id }}">
                                            <x-action.row.option type="button">Update</x-action.row.option>
                                        </x-modal.trigger>

                                        <input type="hidden" name="family_id" value="{{ $row->id }}">
                                        <x-action.row.option name="submit_delete">Delete</x-action.row.option>
                                    </x-slot>
                                </x-action.row.drop-list>

                                <x-modal.overlay id="updateFamilyModal{{ $row->id }}" title="Update Family">
                                    <div class="p-4">
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" name="family_id" value="{{ $row->id }}">

                                            <div class="space-y-2 text-left">
                                                <x-form.input label="Name" id="name" name="name" value="{{ $row->name }}" />
                                                <x-form.input label="Contact Number" id="phone" name="phone" value="{{ $row->phone }}" />
                                                <x-form.input label="Email Address" id="email" name="email" value="{{ $row->email }}" />
                                                <x-form.input type="date" label="Date of Birth" id="date_of_birth" name="date_of_birth" value="{{ $row->date_of_birth }}" />
                                                <x-form.input label="Relationship" id="relationship" name="relationship" value="{{ $row->relationship }}" />
                                                <x-form.select label="Emergency Contact" id="emergency" name="emergency">
                                                    <option value="null" disabled>Please choose</option>
                                                    <option value="1" {{ ($row->emergency_flag == 1) ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ ($row->emergency_flag == 0) ? 'selected' : '' }}>No</option>
                                                </x-form.select>
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
                            <x-table.td colspan="7">NO INFORMATION</x-table.td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table.base>
        </div>
    </div>

    <x-modal.overlay id="addFamilyModal" title="Add Family">
        <div class="p-4">
            <form method="post">
                @csrf

                <div class="space-y-2 text-left">
                    <x-form.input label="Name" id="name" name="name" />
                    <x-form.input label="Contact Number" id="phone" name="phone" />
                    <x-form.input label="Email Address" id="email" name="email" />
                    <x-form.input type="date" label="Date of Birth" id="date_of_birth" name="date_of_birth" />
                    <x-form.input label="Relationship" id="relationship" name="relationship" />
                    <x-form.select label="Emergency Contact" id="emergency" name="emergency">
                        <option value="null" disabled>Please choose</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </x-form.select>
                    <div class="flex items-center justify-end space-x-2">
                        <x-action.button x-on:click="modal=false" accent="secondary" class="px-4 py-2">CANCEL</x-action.button>
                        <x-action.button type="submit" accent="primary" name="submit_add" class="px-4 py-2">ADD</x-action.button>
                    </div>
                </div>
            </form>
        </div>
    </x-modal.overlay>
</x-layouts.dashboard>
