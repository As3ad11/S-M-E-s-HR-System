<x-layouts.base>
    <section class="min-h-screen flex justify-center py-20">
        <div class="w-full max-w-screen-lg bg-white rounded shadow-sm flex overflow-hidden">
            <div class="w-full h-full bg-cover rounded bg-bottom" style="background-image: url(https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80)"></div>
            <div class="w-full h-full flex items-center justify-center">
                <div class="w-full px-20 space-y-10">
                    <div>
                        <p class="text-4xl font-bold">{{ config('app.name') }}</p>
                    </div>

                    <div>
                        <p class="text-xl">Welcome back!</p>
                        <p class="font-light">Continue your awesomeness with us!</p>
                    </div>

                    <form method="post">
                        @csrf

                        <div class="space-y-4">
                            <x-form.input type="email" label="Email" id="email" name="email" />
                            <x-form.input type="password" label="Password" id="password" name="password" />

                            <div>
                                <p class="text-xs">Don't have an account? Create account <x-action.link href="{{ route('register') }}" accent="classic-primary">here</x-action.link></p>
                                <p class="text-xs">Forgot password? Reset <x-action.link href="{{ route('password.request') }}" accent="classic-primary">here</x-action.link></p>
                            </div>

                            <x-action.button type="submit" accent="primary" class="w-full py-2">SIGN IN</x-action.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.base>
