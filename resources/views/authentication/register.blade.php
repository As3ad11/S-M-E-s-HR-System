<x-layouts.base>
    <section class="min-h-screen flex justify-center py-20">
        <div class="w-full max-w-screen-lg bg-white rounded shadow-sm flex overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
                <div class="w-full px-20 space-y-10">
                    <div>
                        <p class="text-4xl font-bold">{{ config('app.name') }}</p>
                    </div>

                    <div>
                        <p class="text-xl">Hello there!</p>
                        <p class="font-light">Let's start our journey together!</p>
                    </div>

                    <form method="post">
                        @csrf

                        <div class="space-y-4">
                            <x-form.input type="email" label="Email" id="email" name="email" value="{{ old('email') }}" />
                            <x-form.input type="password" label="Password" id="password" name="password" />
                            <x-form.input type="password" label="Confirm Password" id="password_confirmation" name="password_confirmation" />

                            <div>
                                <p class="text-xs">Already have an account? Login <x-action.link href="{{ route('login') }}" accent="classic-primary">here</x-action.link></p>
                            </div>

                            <x-action.button type="submit" accent="primary" class="w-full py-2">SIGN UP</x-action.button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full h-full bg-cover rounded bg-bottom" style="background-image: url(https://images.unsplash.com/photo-1491975474562-1f4e30bc9468?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80)"></div>
        </div>
    </section>
</x-layouts.base>
