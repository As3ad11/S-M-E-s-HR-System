<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Organization</p>
            <p class="text-sm font-light">Manage your organization.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('organization') }}" active="true">EMPLOYEE LIST</x-action.tab-link>
                <x-action.tab-link href="{{ route('organization.chart') }}">CHART ORGANIZATION</x-action.tab-link>
            </div>

            <div class="space-y-2 bg-white border border-gray-100 rounded p-4">
                <div class="flex items-center justify-between space-x-2">
                    <p class="text-sm font-semibold">Employee List</p>
                    @if (auth()->user()->isAdmin())
                        <div>
                            <x-modal.trigger target="modal_create">
                                <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                            </x-modal.trigger>

                            <x-modal.overlay id="modal_create" title="Add New Employee">
                                <div class="p-4">
                                    <form method="post">
                                        @csrf
                                        <div class="space-y-2">
                                            <x-form.input label="First Name" id="first_name" name="first_name" />
                                            <x-form.input label="Last Name" id="last_name" name="last_name" />
                                            <x-form.input label="Contact" id="phone" name="phone" />
                                            <x-form.input label="Position" id="position" name="position" />
                                            <x-form.select id="department" name="department" label="Choose Department">
                                                <option value="" selected disabled>Choose</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </x-form.select>
                                            <x-form.input type="date" label="Join Date" id="join_date" name="join_date" />
                                            <x-form.input label="Address" id="address" name="address" />
                                            <x-form.input label="Email" id="email" name="email" />
                                            <x-form.input type="password" label="Password" id="password" name="password" />
                                            <div class="flex items-center justify-end">
                                                <x-action.button type="submit" accent="primary" name="create" class="px-4 py-2">ADD</x-action.button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </x-modal.overlay>
                        </div>
                    @endif
                </div>

                <form method="post">
                    @csrf

                    <div class="flex items-center space-x-2">
                        <div class="w-80">
                            <x-form.input id="name" name="name" placeholder="Search employee..." />
                        </div>
                        <x-action.button type="submit" accent="primary" name="submit_search_employee" class="px-4 py-2">SEARCH</x-action.button>
                    </div>
                </form>

                <x-table.base>
                    <x-slot name="thead">
                        <x-table.th>NAME</x-table.th>
                        <x-table.th>CONTACT</x-table.th>
                        <x-table.th>DEPARTMENT</x-table.th>
                        <x-table.th>JOINED DATE</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($employee as $row)
                            @if ($row->Profile)
                                <tr>
                                    <x-table.td>
                                        <x-action.link href="{{ route('profile', ['id' => $row->id]) }}" accent="classic-primary">{{ $row->Profile->fullname() }}</x-action.link>
                                    </x-table.td>
                                    <x-table.td>{{ $row->Profile->phone }}</x-table.td>
                                    <x-table.td>{{ $row->Department->DepartmentName->name }}</x-table.td>
                                    <x-table.td>{{ $row->Profile->join_date }}</x-table.td>
                                    <x-table.td align="text-right">
                                        @if (auth()->user()->isAdmin())
                                            <x-action.row.drop-list>
                                                <x-slot name="action">
                                                    <x-modal.trigger target="modal{{ $row->id }}">
                                                        <x-action.row.option type="button">Update</x-action.row.option>
                                                    </x-modal.trigger>
                                                </x-slot>
                                            </x-action.row.drop-list>

                                            <x-modal.overlay id="modal{{ $row->id }}" title="Update Employee">
                                                <div class="p-4">
                                                    <form method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                                        <div class="space-y-2 text-left">
                                                            <x-form.input label="First Name" id="first_name" name="first_name" value="{{ $row->Profile->first_name ?? '' }}" />
                                                            <x-form.input label="Last Name" id="last_name" name="last_name" value="{{ $row->Profile->last_name ?? '' }}" />
                                                            <x-form.input label="Contact" id="phone" name="phone" value="{{ $row->Profile->phone ?? '' }}" />
                                                            <x-form.input label="Position" id="position" name="position" value="{{ $row->Profile->position ?? '' }}" />
                                                            <x-form.select id="department" name="department" label="Department">
                                                                <option value="" selected disabled>Choose</option>
                                                                @foreach ($departments as $department)
                                                                    <option
                                                                        value="{{ $department->id }}" {{ ($department->id == $row->Department->department_id) ? 'selected' : '' }}>
                                                                        {{ $department->name }}
                                                                    </option>
                                                                @endforeach
                                                            </x-form.select>
                                                            @if (auth()->user()->isHigherUp())
                                                                <x-form.select id="role" name="role" label="Role">
                                                                    <option value="" selected disabled>Choose</option>
                                                                    @foreach ($roles as $role)
                                                                        <option
                                                                            value="{{ $role->role_code }}" {{ ($role->role_code == $row->role) ? 'selected' : '' }}>
                                                                            {{ $role->role_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </x-form.select>
                                                            @endif
                                                            <x-form.input type="date" label="Join Date" id="join_date" name="join_date" value="{{ $row->Profile->join_date ?? '' }}" />
                                                            <x-form.input label="Address" id="address" name="address" value="{{ $row->Profile->address ?? '' }}" />
                                                            <div class="flex items-center justify-end">
                                                                <x-action.button type="submit" accent="primary" name="update" class="px-4 py-2">UPDATE</x-action.button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </x-modal.overlay>
                                        @endif
                                    </x-table.td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <x-table.td colspan="5">NO INFORMATION</x-table.td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.base>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
