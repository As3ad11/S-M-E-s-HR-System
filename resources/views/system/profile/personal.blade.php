<x-layouts.dashboard>
    <div class="space-y-3 bg-white p-4 rounded">
        <form method="post">
            @csrf

            <div class="space-y-2 divide-y divide-gray-100">
                <div class="flex items-center justify-between pb-2">
                    <p class="font-semibold">Personal</p>

                    <div class="flex items-center space-x-2">
                        <x-action.link href="{{ route('profile', ['id' => $user->id]) }}" accent="secondary" class="px-4 py-2">CLOSE</x-action.link>
                        <x-action.button type="submit" name="submit_add" accent="primary" class="px-4 py-2">SAVE</x-action.button>
                    </div>
                </div>

                <div class="space-y-4 pt-4">
                    <div class="grid grid-cols-2 gap-2">
                        <x-form.input label="First Name" id="first_name" name="first_name" value="{{ $user->Profile->first_name ?? '' }}" />
                        <x-form.input label="Last Name" id="last_name" name="last_name" value="{{ $user->Profile->last_name ?? '' }}" />
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <x-form.input label="Contact Number" id="phone" name="phone" value="{{ $user->Profile->phone ?? '' }}" />
                        <x-form.input label="Position" id="position" name="position" value="{{ $user->Profile->position ?? '' }}" />
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <x-form.select label="Department" id="department" name="department">
                            <option value="" selected disabled>Choose</option>
                            @foreach ($departments as $row)
                                <option
                                    value="{{ $row->id }}" {{ (isset($user->Department->department_id) and $user->Department->department_id == $row->id) ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </x-form.select>

                        @if (auth()->user()->isHigherUp())
                            <x-form.select label="Role" id="role" name="role">
                                <option value="" selected disabled>Choose</option>
                                @foreach ($roles as $row)
                                    <option
                                        value="{{ $row->role_code }}" {{ (isset($user->role) and $user->role == $row->role_code) ? 'selected' : '' }}>
                                        {{ $row->role_name }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <x-form.input label="Address" id="address" name="address" value="{{ $user->Profile->address ?? '' }}" />
                        <x-form.input type="date" label="Join Date" id="join_date" name="join_date" value="{{ $user->Profile->join_date ?? '' }}" />
                    </div>

                    <x-form.input label="About" id="about" name="about" value="{{ $user->Profile->about ?? '' }}" />
                </div>
            </div>
        </form>
    </div>
</x-layouts.dashboard>
