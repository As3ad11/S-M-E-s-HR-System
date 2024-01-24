<x-layouts.dashboard>
    <div class="space-y-4">
        <div>
            <p class="text-xl font-semibold">Profile</p>
            <p class="text-sm font-light">Your professional and personal information.</p>
        </div>

        @if (request()->has('warning') and request()->input('warning') == "true")
            <x-notification.alert accent="warning">
                <p class="font-semibold">Please complete your Personal Information</p>
                <p class="text-xs font-light">You need to complete your Personal Information first before proceed to use the system.</p>
            </x-notification.alert>
        @endif

        <div x-data="{ tab: 'personal' }" class="space-y-4">
            <div>
                <x-tab.link target="personal">Personal</x-tab.link>
                <x-tab.link target="family">Family</x-tab.link>
                <x-tab.link target="identity">Identity</x-tab.link>
                <x-tab.link target="experience">Experience</x-tab.link>
                <x-tab.link target="education">Education</x-tab.link>
                <x-tab.link target="project">Project</x-tab.link>
                <x-tab.link target="document">Document</x-tab.link>
                <x-tab.link target="gallery">Gallery</x-tab.link>
            </div>

            <div class="bg-white border border-gray-100 rounded p-4">
                <div class="space-y-2 divide-y divide-gray-100" x-show="tab === 'personal'">
                    <div class="flex items-center justify-between py-2">
                        <p class="font-semibold">PERSONAL</p>

                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin())
                            <x-action.link href="{{ route('profile.personal', ['id' => $user->id]) }}" accent="primary" class="flex space-x-2 px-4 py-2">
                                <p>UPDATE</p>
                            </x-action.link>
                        @endif
                    </div>

                    <div class="space-y-6 py-2">
                        <div class="grid grid-cols-1 gap-2">
                            <div class="space-y-4 flex items-center space-x-4">
                                <div>
                                    @if (isset($user->Profile->profile_image) and $user->Profile->profile_image)
                                        <div class="w-20 h-20 rounded-full bg-cover" style="background-image: url({{ Storage::url('public/dp/' . $user->Profile->profile_image) }})"></div>
                                    @else
                                        <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                @if ($user->id == auth()->user()->id and isset($user->Profile->id))
                                    <form method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="space-y-2">
                                            <div class="flex flex-col">
                                                <input type="file" id="profile_image" name="profile_image" class="appearance-none text-xs">
                                            </div>

                                            <x-action.button type="submit" name="submit_profile_image" accent="primary" class="px-4 py-2">UPLOAD</x-action.button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <p class="text-xs font-light">First Name</p>
                                <p class="text-sm">{{ $user->Profile->first_name ?? '' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-light">Last Name</p>
                                <p class="text-sm">{{ $user->Profile->last_name ?? '' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <p class="text-xs font-light">Contact Number</p>
                                <p class="text-sm">{{ $user->Profile->phone ?? '' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-light">Position</p>
                                <p class="text-sm">{{ $user->Profile->position ?? '' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <p class="text-xs font-light">Department</p>
                                <p class="text-sm">{{ $user->Department->DepartmentName->name ?? '' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-light">Role</p>
                                <p class="text-sm">{{ $user->RoleName->role_name ?? '' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <p class="text-xs font-light">Address</p>
                                <p class="text-sm">{{ $user->Profile->address ?? '' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-light">Join Date</p>
                                <p class="text-sm">{{ $user->Profile->join_date ?? '' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-light">About</p>
                            <p class="text-sm">{{ $user->Profile->about ?? '' }}</p>
                        </div>

                        @if ($user->id == auth()->user()->id)
                            <div class="flex flex-col items-start">
                                <p class="text-xs font-light">Password</p>
                                <x-action.link href="{{ route('profile.password', ['id' => $user->id]) }}" accent="primary" class="flex space-x-2 px-4 py-2">
                                    <p>CHANGE PASSWORD</p>
                                </x-action.link>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-2" x-show="tab === 'family'">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Family</p>
                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin())
                            <x-action.link href="{{ route('profile.family', ['id' => $user->id]) }}" accent="primary" class="flex space-x-2 px-4 py-2">
                                <p>UPDATE</p>
                            </x-action.link>
                        @endif
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>NAME</x-table.th>
                            <x-table.th>CONTACT</x-table.th>
                            <x-table.th>EMAIL</x-table.th>
                            <x-table.th>DATE OF BIRTH</x-table.th>
                            <x-table.th>RELATIONSHIP</x-table.th>
                            <x-table.th align="text-right">EMERGENCY</x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($user->Family as $row)
                                <tr>
                                    <x-table.td>{{ $row->name }}</x-table.td>
                                    <x-table.td>{{ $row->phone }}</x-table.td>
                                    <x-table.td>{{ $row->email }}</x-table.td>
                                    <x-table.td>{{ $row->date_of_birth }}</x-table.td>
                                    <x-table.td>{{ $row->relationship }}</x-table.td>
                                    <x-table.td align="text-right">{{ (($row->emergency_flag)) ? 'YES' : 'NO' }}</x-table.td>
                                </tr>
                            @empty
                                <tr>
                                    <x-table.td colspan="6">NO INFORMATION</x-table.td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.base>
                </div>

                <div class="space-y-2" x-show="tab === 'identity'">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Identity Documents</p>
                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin())
                            <div>
                                <x-modal.trigger target="modal_add_identity_document">
                                    <x-action.button accent="primary" class="flex space-x-2 px-4 py-2">
                                        <p>ADD</p>
                                    </x-action.button>
                                </x-modal.trigger>

                                <x-modal.overlay id="modal_add_identity_document" title="Add Document">
                                    <div class="p-4">
                                        <form method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="space-y-2">
                                                <x-form.input label="Document Type (IC / Password / Paper)" id="type" name="type" />
                                                <x-form.input type="file" label="Upload Document" id="document" name="document" />
                                                <div class="flex items-center justify-end">
                                                    <x-action.button type="submit" accent="primary" name="submit_add_identity_document" class="px-4 py-2">
                                                        UPLOAD
                                                    </x-action.button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal.overlay>
                            </div>
                        @endif
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>TYPE</x-table.th>
                            <x-table.th>DOCUMENT</x-table.th>
                            <x-table.th>CREATE DATE</x-table.th>
                            <x-table.th></x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($identity_documents as $row)
                                <tr>
                                    <x-table.td>{{ $row->type }}</x-table.td>
                                    <x-table.td>{{ $row->document_name }}</x-table.td>
                                    <x-table.td>{{ $row->created_at }}</x-table.td>
                                    <x-table.td align="text-right">
                                        @if ($user->id == auth()->user()->id)
                                            <x-action.row.drop-list>
                                                <x-slot name="action">
                                                    <input type="hidden" name="identity_document_id" value="{{ $row->id }}">
                                                    <x-action.row.option name="submit_download_identity_document">Download</x-action.row.option>
                                                    <x-action.row.option name="submit_delete_identity_document">Delete</x-action.row.option>
                                                </x-slot>
                                            </x-action.row.drop-list>
                                        @endif
                                    </x-table.td>
                                </tr>
                            @empty
                                <tr>
                                    <x-table.td colspan="4">NO INFORMATION</x-table.td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.base>
                </div>

                <div class="space-y-2" x-show="tab === 'experience'">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Professional Experience</p>

                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin())
                            <x-action.link href="{{ route('profile.experience', ['id' => $user->id]) }}" accent="primary" class="flex space-x-2 px-4 py-2">
                                <p>UPDATE</p>
                            </x-action.link>
                        @endif
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>COMPANY</x-table.th>
                            <x-table.th>START</x-table.th>
                            <x-table.th>END</x-table.th>
                            <x-table.th>POSITION</x-table.th>
                            <x-table.th align="text-center">JOBSCOPE</x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($user->Experience as $row)
                                <tr>
                                    <x-table.td>{{ $row->company_name }}</x-table.td>
                                    <x-table.td>{{ $row->date_from }}</x-table.td>
                                    <x-table.td>{{ $row->date_until }}</x-table.td>
                                    <x-table.td>{{ $row->position }}</x-table.td>
                                    <x-table.td align="text-center">{{ $row->jobscope }}</x-table.td>
                                </tr>
                            @empty
                                <tr>
                                    <x-table.td colspan="5">NO INFORMATION</x-table.td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.base>
                </div>

                <div class="space-y-2" x-show="tab === 'education'">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Education</p>

                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin())
                            <x-action.link href="{{ route('profile.education', ['id' => $user->id]) }}" accent="primary" class="flex space-x-2 px-4 py-2">
                                <p>UPDATE</p>
                            </x-action.link>
                        @endif
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>INSTITUTION</x-table.th>
                            <x-table.th>START</x-table.th>
                            <x-table.th>END</x-table.th>
                            <x-table.th>COURSE</x-table.th>
                            <x-table.th align="text-center">RESULT</x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($user->Education as $row)
                                <tr>
                                    <x-table.td>{{ $row->institution_name }}</x-table.td>
                                    <x-table.td>{{ $row->date_from }}</x-table.td>
                                    <x-table.td>{{ $row->date_until }}</x-table.td>
                                    <x-table.td>{{ $row->course }}</x-table.td>
                                    <x-table.td align="text-center">{{ $row->result }}</x-table.td>
                                </tr>
                            @empty
                                <tr>
                                    <x-table.td colspan="5">NO INFORMATION</x-table.td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.base>
                </div>

                <div class="space-y-2" x-show="tab === 'project'">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Project</p>

                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin())
                            <div>
                                <x-modal.trigger target="modal_add_project">
                                    <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                                </x-modal.trigger>

                                <x-modal.overlay id="modal_add_project" title="Add Project">
                                    <div class="p-4">
                                        <form method="post">
                                            @csrf
                                            <div class="space-y-2">
                                                <x-form.input label="Project Name" id="project_name" name="project_name" />
                                                <x-form.input label="Project Description" id="project_description" name="project_description" />
                                                <x-form.input type="date" label="Start Date" id="start_date" name="start_date" />
                                                <x-form.input type="date" label="End Date" id="end_date" name="end_date" />
                                                <div class="flex items-center justify-end">
                                                    <x-action.button type="submit" accent="primary" name="submit_add_project" class="px-4 py-2">ADD</x-action.button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal.overlay>
                            </div>
                        @endif
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>NAME</x-table.th>
                            <x-table.th>DESCRIPTION</x-table.th>
                            <x-table.th>START</x-table.th>
                            <x-table.th>END</x-table.th>
                            <x-table.th>STATUS</x-table.th>
                            <x-table.th></x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($projects as $row)
                                <tr>
                                    <x-table.td>{{ $row->project_name }}</x-table.td>
                                    <x-table.td>{{ $row->project_description }}</x-table.td>
                                    <x-table.td>{{ $row->start_date }}</x-table.td>
                                    <x-table.td>{{ $row->end_date }}</x-table.td>
                                    <x-table.td>{{ $row->status }}</x-table.td>
                                    <x-table.td align="text-right">
                                        @if ($user->id == auth()->user()->id)
                                            <x-action.row.drop-list>
                                                <x-slot name="action">
                                                    <input type="hidden" name="project_id" value="{{ $row->id }}">

                                                    <x-modal.trigger target="modal_update_project">
                                                        <x-action.row.option type="button">Update</x-action.row.option>
                                                    </x-modal.trigger>

                                                    <x-action.row.option name="submit_delete_project">Delete</x-action.row.option>
                                                </x-slot>
                                            </x-action.row.drop-list>

                                            <x-modal.overlay id="modal_update_project" title="Update Project">
                                                <div class="p-4">
                                                    <form method="post">
                                                        @csrf

                                                        <input type="hidden" name="project_id" value="{{ $row->id }}">

                                                        <div class="space-y-2">
                                                            <x-form.input label="Project Name" id="project_name" name="project_name" value="{{ $row->project_name }}" />
                                                            <x-form.input label="Project Description" id="project_description" name="project_description" value="{{ $row->project_description }}" />
                                                            <x-form.input type="date" label="Start Date" id="start_date" name="start_date" value="{{ $row->start_date }}" />
                                                            <x-form.input type="date" label="End Date" id="end_date" name="end_date" value="{{ $row->end_date }}" />
                                                            <x-form.input label="Status" id="status" name="status" value="{{ $row->status }}" />
                                                            <div class="flex items-center justify-end">
                                                                <x-action.button type="submit" accent="primary" name="submit_update_project" class="px-4 py-2">UPDATE</x-action.button>
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

                <div class="space-y-2" x-show="tab === 'document'">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Documents</p>

                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin() or $user->Department->department_id == auth()->user()->Department->department_id)
                            <div>
                                <x-modal.trigger target="modal_add_document">
                                    <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                                </x-modal.trigger>

                                <x-modal.overlay id="modal_add_document" title="Add Document">
                                    <div class="p-4">
                                        <form method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="space-y-2">
                                                <x-form.input type="file" label="Upload Document" id="documents" name="documents[]" />
                                                <div class="flex items-center justify-end">
                                                    <x-action.button type="submit" accent="primary" name="submit_add_document" class="px-4 py-2">UPLOAD</x-action.button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal.overlay>
                            </div>
                        @endif
                    </div>

                    <x-table.base>
                        <x-slot name="thead">
                            <x-table.th>DOCUMENT</x-table.th>
                            <x-table.th>CREATED DATE</x-table.th>
                            <x-table.th></x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($documents as $row)
                                <tr>
                                    <x-table.td>{{ $row->document_name }}</x-table.td>
                                    <x-table.td>{{ $row->created_at }}</x-table.td>
                                    <x-table.td align="text-right">
                                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin() or $user->Department->department_id == auth()->user()->Department->department_id)
                                            <x-action.row.drop-list>
                                                <x-slot name="action">
                                                    <input type="hidden" name="document_id" value="{{ $row->id }}">
                                                    <x-action.row.option name="submit_download_document">Download</x-action.row.option>
                                                    @if ($user->id == auth()->user()->id)
                                                        <x-action.row.option name="submit_delete_document">Delete</x-action.row.option>
                                                    @endif
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

                <div class="space-y-2" x-show="tab === 'gallery'">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Gallery</p>

                        @if ($user->id == auth()->user()->id or auth()->user()->isAdmin())
                            <div>
                                <x-modal.trigger target="modal_add_photo">
                                    <x-action.button accent="primary" class="px-4 py-2">ADD</x-action.button>
                                </x-modal.trigger>

                                <x-modal.overlay id="modal_add_photo" title="Add Photo">
                                    <div class="p-4">
                                        <form method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="space-y-2">
                                                <x-form.input type="file" label="Upload Photo" id="photos" name="photos[]" />
                                                <div class="flex items-center justify-end">
                                                    <x-action.button type="submit" accent="primary" name="submit_add_photo" class="px-4 py-2">UPLOAD</x-action.button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal.overlay>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap">
                        @forelse ($photos as $row)
                            <div class="w-40 h-40 rounded relative bg-cover m-2" style="background-image:url({{ Storage::url('public/photos/' . $row->photo_name) }})">
                                @if ($user->id == auth()->user()->id)
                                    <form method="post" class="absolute top-1 right-1">
                                        @csrf
                                        <input type="hidden" name="photo_id" value="{{ $row->id }}">

                                        <button type="submit" name="submit_delete_photo" class="rounded-full hover:bg-gray-400 text-gray-200 hover:text-gray-800 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <div class="border border-gray-100 rounded w-full p-2">
                                <p class="font-light text-xs">No Information</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
