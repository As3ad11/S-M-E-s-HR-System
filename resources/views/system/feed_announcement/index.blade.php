<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Feed</p>
            <p class="text-sm font-light">Manage meetings and announcements.</p>
        </div>

        <div class="flex items-start space-x-2">
            <div class="w-full bg-white p-4 border border-gray-100 rounded divide-y divide-gray-100">
                <div class="flex items-center justify-between py-4">
                    <p class="font-semibold">Announcement</p>
                    @if (auth()->user()->isAdmin())
                        <x-modal.trigger target="addAnnouncementModal">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>
                    @endif
                </div>

                <div class="py-4">
                    @forelse ($announcements as $row)
                        <div class="py-1">
                            <div class="space-y-2">
                                <div class="space-y-2 p-4 hover:bg-yellow-100 rounded shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <div>
                                                <span class="w-8 h-8 rounded-full flex items-center justify-center bg-yellow-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div class="flex flex-col">
                                                <x-modal.trigger target="viewAnnouncementModal{{ $row->id }}">
                                                    <button type="button" title="View" class="font-semibold text-blue-500 hover:underline hover:text-blue-600 text-left">{{ $row->title }}</button>
                                                </x-modal.trigger>
                                                <p class="text-xs text-gray-600 font-light">{{ $row->created_at }}</p>
                                            </div>
                                        </div>

                                        <div class="flex space-x-2 items-center">
                                            @if (auth()->user()->isAdmin())
                                                <x-modal.trigger target="editAnnouncementModal{{ $row->id }}">
                                                    <button type="button" class="text-blue-500 hover:text-blue-600" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </button>
                                                </x-modal.trigger>

                                                <form method="post">
                                                    @csrf
                                                    <input type="hidden" name="announcement_id" value="{{ $row->id }}"/>

                                                    <button type="submit" name="submit_announcement_delete" class="text-red-500 hover:text-red-600" title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="text-xs truncate">{{ $row->announcement }}</p>
                                </div>
                            </div>

                            <x-modal.overlay id="viewAnnouncementModal{{ $row->id }}" title="View Announcement">
                                <div class="p-4 space-y-4">
                                    <div class="flex items-center space-x-2">
                                        <div>
                                            <span class="w-10 h-10 rounded-full flex items-center justify-center bg-yellow-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                                </svg>
                                            </span>
                                        </div>

                                        <div class="flex flex-col">
                                            <p class="font-semibold">{{ $row->title }}</p>
                                            <p class="text-xs text-gray-600 font-light">{{ $row->created_at }}</p>
                                        </div>
                                    </div>

                                    <p class="font-light text-sm">{{ $row->announcement }}</p>
                                </div>
                            </x-modal.overlay>

                            @if (auth()->user()->isAdmin())
                                <x-modal.overlay id="editAnnouncementModal{{ $row->id }}" title="Edit Announcement">
                                    <div class="p-4">
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" name="announcement_id" value="{{ $row->id }}"/>
                                            <div class="space-y-2 text-left">
                                                <x-form.input label="Title" id="title" name="title" value="{{ $row->title }}" />
                                                <x-form.textarea label="Announcement" id="announcement" name="announcement" value="{{ $row->announcement }}" />
                                                <div class="flex items-center justify-end space-x-2">
                                                    <x-action.button type="submit" accent="primary" name="submit_announcement_update" class="px-4 py-2">ADD</x-action.button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal.overlay>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm">No announcement yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="w-96 flex-none bg-white p-4 border border-gray-100 rounded divide-y divide-gray-100">
                <div class="flex items-center justify-between py-4">
                    <p class="font-semibold">Event & Meetings</p>

                    @if (auth()->user()->isAdmin())
                        <x-modal.trigger target="addFeedModal">
                            <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                        </x-modal.trigger>
                    @endif
                </div>

                <div class="py-4">
                    <form method="post" class="w-40">
                        @csrf
                        <x-form.input type="date" label="Choose your date" id="feed_date" name="feed_date" onchange="this.form.submit()" value="{{ $feed_date }}" />
                    </form>
                </div>

                <div class="py-4 flex flex-col space-y-2">
                    @forelse ($feeds as $row)
                        <div class="space-y-2 bg-white hover:bg-gray-100 p-4 transition duration-200 ease-in-out rounded shadow">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    @if (isset($row->User->Profile->profile_image) and $row->User->Profile->profile_image)
                                        <div class="w-10 h-10 rounded-full bg-cover" style="background-image: url({{ Storage::url('public/dp/' . $row->User->Profile->profile_image) }})"></div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="flex flex-col">
                                        <p class="font-semibold">{{ $row->User->Department->DepartmentName->name }}</p>

                                        <div class="flex items-center space-x-2">
                                            <p class="text-sm">{{ $row->User->Profile->first_name }} {{ $row->User->Profile->last_name }}</p>
                                            <p class="text-xs text-gray-600 font-light">{{ $row->created_at }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex space-x-2 items-center">
                                    @if (auth()->user()->isAdmin())
                                        <x-modal.trigger target="editFeedModal{{ $row->id }}">
                                            <button type="button" class="text-blue-500 hover:text-blue-600" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                        </x-modal.trigger>
                                    @endif

                                    @if (auth()->user()->isAdmin())
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" name="feed_id" value="{{ $row->id }}"/>

                                            <button type="submit" name="submit_feed_delete" class="text-red-500 hover:text-red-600" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                @if (auth()->user()->isAdmin())
                                    <x-modal.overlay id="editFeedModal{{ $row->id }}" title="Edit Feed">
                                        <div class="p-4">
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="feed_id" value="{{ $row->id }}"/>
                                                <div class="space-y-2 text-left">
                                                    <x-form.input label="Time" id="time" name="time" value="{{ $row->time }}" />
                                                    <x-form.input label="Location" id="location" name="location" value="{{ $row->location }}" />
                                                    <x-form.input label="Title" id="title" name="title" value="{{ $row->title }}" />
                                                    <x-form.textarea label="Description" id="description" name="description" value="{{ $row->description }}" />
                                                    <div class="flex items-center justify-end space-x-2">
                                                        <x-action.button x-on:click="modal=false" accent="secondary" class="px-4 py-2">CANCEL</x-action.button>
                                                        <x-action.button type="submit" accent="primary" name="submit_feed_update" class="px-4 py-2">SAVE</x-action.button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </x-modal.overlay>
                                @endif
                            </div>

                            <div class="text-sm">
                                <p class="font-semibold text-base">{{ $row->title }}</p>

                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-xs">{{ $row->time }}</p>
                                </span>

                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-xs">{{ $row->location }}</p>
                                </span>

                                <p>{{ $row->description }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm">No events or meeting for today.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->isAdmin())
        <x-modal.overlay id="addFeedModal" title="Create Events or Meetings">
            <div class="p-4">
                <form method="post">
                    @csrf
                    <div class="space-y-2 text-left">
                        <x-form.input label="Time" id="time" name="time" value="{{ old('time') }}" />
                        <x-form.input label="Location" id="location" name="location" value="{{ old('location') }}" />
                        <x-form.input label="Title" id="title" name="title" value="{{ old('title') }}" />
                        <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" />
                        <div class="flex items-center justify-end space-x-2">
                            <x-action.button type="submit" accent="primary" name="submit_feed_create" class="px-4 py-2">ADD</x-action.button>
                        </div>
                    </div>
                </form>
            </div>
        </x-modal.overlay>

        <x-modal.overlay id="addAnnouncementModal" title="Add Announcement">
            <div class="p-4">
                <form method="post">
                    @csrf
                    <div class="space-y-2 text-left">
                        <x-form.input label="Title" id="title" name="title" value="{{ old('title') }}" />
                        <x-form.textarea label="Announcement" id="announcement" name="announcement" value="{{ old('announcement') }}" />
                        <div class="flex items-center justify-end space-x-2">
                            <x-action.button x-on:click="modal=false" accent="secondary" class="px-4 py-2">CANCEL</x-action.button>
                            <x-action.button type="submit" accent="primary" name="submit_announcement_create" class="px-4 py-2">ADD</x-action.button>
                        </div>
                    </div>
                </form>
            </div>
        </x-modal.overlay>
    @endif
</x-layouts.dashboard>
