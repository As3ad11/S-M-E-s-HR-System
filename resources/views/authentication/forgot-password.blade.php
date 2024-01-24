<x-layouts.base>
    <section class="min-h-screen flex justify-center py-20">
        <div class="w-full max-w-screen-lg bg-white rounded shadow-sm flex overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
                <div class="w-full px-20 space-y-10">
                    <div>
                        <p class="text-4xl font-bold">{{ config('app.name') }}</p>
                    </div>

                    <div>
                        <p class="text-xl">Forgot Password?</p>
                        <p class="font-light">No worries. We got your back. Let's reset your password.</p>
                    </div>

                    @if (session('status'))
                        <x-notification.alert accent="primary" class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm font-light">{{ session('status') }}</p>
                        </x-notification.alert>
                    @else
                        <form method="post">
                            @csrf

                            <div class="space-y-4">
                                <x-form.input type="email" label="Email" id="email" name="email" value="{{ old('email') }}"  />

                                <div>
                                    <p class="text-xs">Remember your password? Login <x-action.link href="{{ route('login') }}" accent="classic-primary">here</x-action.link></p>
                                </div>

                                <x-action.button type="submit" accent="primary" class="w-full py-2">SEND RESET PASSWORD LINK</x-action.button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="w-full h-full bg-cover rounded bg-bottom" style="background-image: url(https://images.unsplash.com/photo-1510074468346-504b4d8a8630?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1996&q=80)"></div>
        </div>
    </section>
</x-layouts.base>
