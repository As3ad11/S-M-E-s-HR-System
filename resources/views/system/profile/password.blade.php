<x-layouts.dashboard>
    <div class="space-y-4">
        @if ($message)
            <div class="text-xs bg-yellow-200 text-yellow-800 rounded py-2 px-4 mb-5">
                {{ $message }}
            </div>
        @endif

        <div class="space-y-3 bg-white p-4 rounded">
            <form method="post">
                @csrf

                <div class="space-y-2 divide-y divide-gray-100">
                    <div class="flex items-center justify-between pb-2">
                        <p class="font-semibold">Password</p>

                        <div class="flex items-center space-x-2">
                            <x-action.link href="{{ route('profile', ['id' => auth()->user()->id]) }}" accent="secondary" class="px-4 py-2">CANCEL</x-action.link>
                            <x-action.button type="submit" name="submit_update" accent="primary" class="px-4 py-2">SAVE</x-action.button>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4">
                        <x-form.input type="password" label="Old Password" id="old_password" name="old_password" />
                        <x-form.input type="password" label="New Password" id="password" name="password" />
                        <x-form.input type="password" label="Confirm Password" id="password_confirmation" name="password_confirmation" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.dashboard>
