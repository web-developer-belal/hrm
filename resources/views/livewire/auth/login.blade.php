<form wire:submit.prevent="login">
    <div class="h-screen flex flex-col justify-between p-6 pb-0">
        <div class=" mx-auto mb-8 text-center">
            <img src="{{ asset('assets/img/Logo-Babyshop.png') }}" class="img-fluid mx-auto" width="200" alt="Logo">
        </div>
        <div class="">
            <div class="text-center mb-3">
                <h2 class="mb-2">Sign In</h2>
                <p class="mb-0">Please enter your details to sign in</p>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm leading-normal font-medium text-title">Email
                    Address</label>
                <div class="relative">
                    <input type="email" wire:model='email'
                        class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                    <span class="absolute top-[10px] right-[10px] border-start-0">
                        <i class="ti ti-mail"></i>
                    </span>
                </div>
                @error('email')
                    <span class="text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm leading-normal font-medium text-title">Password</label>
                <div class="pass-group relative">
                    <input type="password" wire:model='password'
                        class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                    <span class="ti toggle-password ti-eye-off absolute top-[10px] right-[10px] border-start-0"></span>
                </div>
                @error('password')
                    <span class="text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="flex items-center justify-between mb-3">
                <div class="d-flex items-center">
                    <div class="form-check form-check-md mb-0">

                        <label class="flex items-center ">
                            <input
                                class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0 me-2"
                                type="checkbox">
                            <span>Remember Me</span>
                        </label>
                    </div>
                </div>
                <div class="text-end">
                    <a href="" class="text-primary">Forgot
                        Password?</a>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-full bg-primary text-white">Sign
                    In</button>
            </div>
            <div class="text-center">
                <h6 class="font-normal text-dark mb-0">Don’t have an account?
                    <a href="" class="hover-a text-primary"> Create Account</a>
                </h6>
            </div>

        </div>
        <div class="mt-8 pb-4 text-center">
            <p class="mb-0 text-gray-9">Copyright &copy; {{ date('Y') }} - {{ config('app.name') }}</p>
        </div>
    </div>
</form>
