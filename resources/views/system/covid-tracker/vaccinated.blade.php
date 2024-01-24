<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Covid-19 Tracker</p>
            <p class="text-sm font-light">Track Covid-19 Management.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('covidtracker') }}">HEALTH STATUS</x-action.tab-link>
                <x-action.tab-link href="{{ route('covidtracker.cases') }}">COVID CASE TRACK</x-action.tab-link>
                <x-action.tab-link href="{{ route('covidtracker.vaccinated') }}" active="true">VACCINATED LIST</x-action.tab-link>
            </div>

            <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold">Vaccinated List</p>

                    @if (auth()->user()->isAdmin())
                        <div>
                            <x-modal.trigger target="modal1">
                                <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                            </x-modal.trigger>

                            <x-modal.overlay id="modal1" title="Add Vaccinated Employee">
                                <div class="p-4">
                                    <form method="post">
                                        @csrf
                                        <div class="space-y-2">
                                            <x-form.select id="employee" name="employee">
                                                <option value="" selected disabled>Choose Employee</option>
                                                @foreach ($users as $user)
                                                    @if ($user->Profile)
                                                        <option value="{{ $user->id }}">{{ $user->Profile->fullname() }}</option>
                                                    @endif
                                                @endforeach
                                            </x-form.select>

                                            <x-form.select id="status" name="status">
                                                <option value="" selected disabled>Choose Status</option>
                                                @foreach ($vaccinated_categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </x-form.select>

                                            <div class="flex justify-end">
                                                <x-action.button type="submit" accent="primary" name="submit_create_vaccinated_status" class="px-4 py-2">ADD</x-action.button>
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
                            <x-form.select id="name" name="name">
                                <option value="" selected disabled>Choose Employee</option>
                                @foreach ($users as $user)
                                    @if ($user->Profile)
                                        <option value="{{ $user->id }}" {{ ($user->id == $current_user) ? 'selected' : '' }}>{{ $user->Profile->fullname() }}</option>
                                    @endif
                                @endforeach
                            </x-form.select>
                        </div>

                        <x-action.button type="submit" accent="primary" name="search" class="px-4 py-2">SEARCH</x-action.button>
                        <x-action.link href="{{ route('covidtracker.vaccinated') }}" accent="secondary" class="px-4 py-2">CLEAR</x-action.link>
                    </div>
                </form>

                <div class="space-y-2">
                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>NAME</x-table.th>
                            <x-table.th align="text-center">STATUS</x-table.th>
                            <x-table.th></x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($vaccinated as $row)
                                <tr>
                                    <x-table.td>{{ $row->Profile->fullname() }}</x-table.td>
                                    <x-table.td align="text-center">{{ $row->Vaccine->name }}</x-table.td>
                                    <x-table.td align="text-right">
                                        @if (auth()->user()->isAdmin())
                                            <x-action.row.drop-list>
                                                <x-slot name="action">
                                                    <x-modal.trigger target="modal_update_vaccinated{{ $row->id }}">
                                                        <x-action.row.option type="button">Update</x-action.row.option>
                                                    </x-modal.trigger>
                                                </x-slot>
                                            </x-action.row.drop-list>

                                            <x-modal.overlay id="modal_update_vaccinated{{ $row->id }}" title="Update Vaccinated Employee">
                                                <div class="p-4">
                                                    <form method="post">
                                                        @csrf
                                                        <div class="space-y-2">
                                                            <x-form.select id="employee" name="employee">
                                                                <option value="" selected disabled>Choose Employee</option>
                                                                @foreach ($users as $user)
                                                                    @if ($user->Profile)
                                                                        <option value="{{ $user->id }}" {{ ($user->id == $row->user_id) ? 'selected' : '' }}>{{ $user->Profile->fullname() }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </x-form.select>

                                                            <x-form.select id="status" name="status">
                                                                <option value="" selected disabled>Choose Status</option>
                                                                @foreach ($vaccinated_categories as $category)
                                                                    <option value="{{ $category->id }}" {{  ($category->id == $row->vaccination_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                                @endforeach
                                                            </x-form.select>

                                                            <div class="flex justify-end">
                                                                <x-action.button type="submit" accent="primary" name="submit_create_vaccinated_status" class="px-4 py-2">UPDATE</x-action.button>
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
                                    <x-table.td colspan="3">NO INFORMATION</x-table.td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.base>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
