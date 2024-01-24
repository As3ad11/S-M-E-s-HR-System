<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Covid-19 Tracker</p>
            <p class="text-sm font-light">Track Covid-19 Management.</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <x-action.tab-link href="{{ route('covidtracker') }}" active="true">HEALTH STATUS</x-action.tab-link>
                <x-action.tab-link href="{{ route('covidtracker.cases') }}">COVID CASE TRACK</x-action.tab-link>
                <x-action.tab-link href="{{ route('covidtracker.vaccinated') }}">VACCINATED LIST</x-action.tab-link>
            </div>

            <div class="space-y-4 bg-white border border-gray-100 rounded p-4">
                <div class="flex items-center space-x-2">
                    <p class="text-sm font-semibold">Health Status</p>

                    @if (auth()->user()->isAdmin())
                        <form method="post">
                            @csrf
                            <div class="flex items-center space-x-2">
                                <div class="w-72">
                                    <x-form.select id="employee" name="employee">
                                        <option value="" selected disabled>Find Employee</option>
                                        @foreach ($users as $row)
                                            @if ($row->Profile)
                                                <option value="{{ $row->id }}" {{ ($row->id == $current_user) ? 'selected' : '' }}>{{ $row->Profile->fullname() }}</option>
                                            @endif
                                        @endforeach
                                    </x-form.select>
                                </div>

                                <x-action.button type="submit" accent="primary" name="search_employee" class="px-4 py-2">GET</x-action.button>
                            </div>
                        </form>
                    @endif
                </div>

                <div class="space-y-2 w-full max-w-md">
                    @if ($covid_status)
                        <div class="bg-blue-400 text-white rounded p-2 text-sm text-center">
                            <p class="font-light">Covid-19 Risk Status</p>
                            <p class="font-semibold">
                                {{ $covid_status->Status->name }}
                            </p>
                        </div>

                        <div class="bg-gray-200 text-gray-800 rounded p-2 text-sm text-center">
                            <p class="font-light">Conditions</p>
                            <p class="font-semibold">
                                {{ $covid_status->conditions ?? 'No condition has been update' }}
                            </p>
                        </div>
                    @endif

                    @if ($vaccine_status)
                        <div class="bg-yellow-300 text-gray-800 rounded p-2 text-sm text-center">
                            <p class="font-light">Vaccination Status</p>
                            <p class="font-semibold">
                                {{ $vaccine_status->Vaccine->name }}
                            </p>
                        </div>
                    @endif

                    <div>
                        <x-modal.trigger target="modal_update_covid_status">
                            <x-action.button accent="success" class="px-4 py-2">UPDATE HEALTH STATUS</x-action.button>
                        </x-modal.trigger>

                        <x-modal.overlay id="modal_update_covid_status" title="Covid-19 Status">
                            <div class="p-4">
                                <form method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <x-form.select id="status" name="status" required>
                                            <option value="" selected disabled>Covid-19 Risk Status</option>
                                            @foreach ($covid_statuses as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </x-form.select>

                                        <x-form.textarea id="conditions" name="conditions" placeholder="How are you feeling?" />

                                        <x-action.button type="submit" accent="primary" name="submit_covid_status" class="px-4 py-2">UPDATE</x-action.button>
                                    </div>
                                </form>
                            </div>
                        </x-modal.overlay>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
