<x-layouts.base>
    <section class="min-h-screen flex justify-center py-20">
        <div class="w-full max-w-screen-lg bg-white rounded shadow-sm flex overflow-hidden">
            <div class="w-full h-full bg-cover rounded-2xl bg-bottom" style="background-image: url(https://images.unsplash.com/photo-1593476550610-87baa860004a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1964&q=80)"></div>
            <div class="w-full h-full flex items-center justify-center">
                <div class="w-full px-20 space-y-10">
                    <div>
                        <p class="text-4xl font-bold">{{ config('app.name') }}</p>
                    </div>

                    <div>
                        <p class="text-xl">Reset password?</p>
                        <p class="font-light">Please do not forget again this time.</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <div class="space-y-4">
                            <x-form.input type="email" label="Email" id="email" name="email" value="{{ request()->input('email') }}" />
                            <x-form.input type="password" label="New Password" id="password" name="password" />
                            <x-form.input type="password" label="Confirm New Password" id="password_confirmation" name="password_confirmation" />
                            <x-action.button type="submit" accent="primary" class="w-full py-2">RESET PASSWORD</x-action.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.base>
