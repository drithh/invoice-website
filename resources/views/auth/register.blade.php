<x-guest-layout>
  <x-auth-card>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <div class="header text-primary-text mb-16 flex flex-col place-content-center place-items-center">
      <div class="title font-montserrat text-primary-text text-[22px] font-bold tracking-wide drop-shadow-xl">Create An
        Account</div>
      <div class="text font-poppins text-xs">Silakan mendaftar untuk melanjutkan</div>
    </div>

    <form method="POST" class="flex flex-col gap-y-1" action="{{ route('register') }}">
      @csrf

      <!-- Username -->
      <div class="input-wrapper">
        <label for="username" class="text-primary-text font-montserrat pl-1 text-xs">Userame</label>
        <div class="relative z-0 mt-2 flex h-14 w-full flex-col">
          <div
            class="pointer-events-none relative bottom-[6px] z-20 m-auto flex h-full w-full appearance-none place-content-between place-items-center items-center px-4">
            <x-people />
            <x-validation :errors="$errors" />
          </div>
          <input id="username" type="text"
            class="absolute top-[1.5px] z-10 w-full cursor-text rounded-lg border-none py-2 pr-8 pl-12 leading-normal shadow-md outline-none focus:outline-none"
            name="username" value="{{ old('email') }}" required autocomplete="username" autofocus />
        </div>
      </div>

      <!-- Email Address -->
      <div class="input-wrapper">
        <label for="email" class="text-primary-text font-montserrat pl-1 text-xs">Email</label>
        <div class="relative z-0 mt-2 flex h-14 w-full flex-col">
          <div
            class="pointer-events-none relative bottom-[6px] z-20 m-auto flex h-full w-full appearance-none place-content-between place-items-center items-center px-4">
            <x-mail />
            <x-validation :errors="$errors" />
          </div>
          <input id="email" type="email"
            class="absolute top-[1.5px] z-10 w-full cursor-text rounded-lg border-none py-2 pr-8 pl-12 leading-normal shadow-md outline-none focus:outline-none"
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
        </div>
      </div>


      <!-- Password -->
      <div class="input-wrapper text-primary-textgray">
        <label for="password" class="text-primary-text font-montserrat pl-1 text-xs">Password</label>
        <div class="relative z-0 mt-2 flex h-14 w-full flex-col">
          <div
            class="pointer-events-none relative bottom-[6px] z-20 m-auto flex h-full w-full appearance-none place-content-between place-items-center items-center px-4">
            <x-lock />
            <button type="button" class="pointer-events-auto" onclick="toggleVisibilityPassword()">
              <x-eye />
              <x-eye-slash class="hidden" />
            </button>
          </div>
          <input id="password" type="password"
            class="absolute top-[1.5px] z-10 w-full cursor-text rounded-lg border-none py-2 pr-8 pl-12 leading-normal shadow-md outline-none focus:outline-none"
            name="password" value="{{ old('password') }}" required autocomplete="password" autofocus />
        </div>
      </div>

      <!-- Retype Password -->
      <div class="input-wrapper text-primary-textgray">
        <label for="password-confirmation" class="text-primary-text font-montserrat pl-1 text-xs">Retype
          Password</label>
        <div class="relative z-0 mt-2 flex h-14 w-full flex-col">
          <div
            class="pointer-events-none relative bottom-[6px] z-20 m-auto flex h-full w-full appearance-none place-content-between place-items-center items-center px-4">
            <x-lock />
            <button type="button" class="pointer-events-auto" onclick="toggleVisibilityPassword()">
              <x-eye />
              <x-eye-slash class="hidden" />
            </button>
          </div>
          <input id="password-confirmation" type="password"
            class="absolute top-[1.5px] z-10 w-full cursor-text rounded-lg border-none py-2 pr-8 pl-12 leading-normal shadow-md outline-none focus:outline-none"
            name="password_confirmation" value="{{ old('password') }}" required autofocus />
        </div>
      </div>

      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <div class="wrapper text-primary-textgray mb-4 mt-6 flex place-content-center place-items-center px-2 text-sm">
        <span class="">Sudah Punya Akun?&nbsp;</span>
        @if (Route::has('login'))
          <a class="text-primary-green relative hover:text-gray-900 hover:underline" href="{{ route('login') }}">
            {{ __(' Login') }}
          </a>
        @endif
      </div>

      <div class="wrapper text-primary-textgray my-6 flex place-content-between place-items-center px-8 text-sm">
        <button type="reset" class="bg-primary-background h-9 w-24 rounded-lg py-2 px-4">Batal</button>
        <button type="submit"
          class="bg-primary-green h-9 w-24 rounded-lg py-2 px-4 font-medium text-white">Buat</button>
      </div>
    </form>
  </x-auth-card>
</x-guest-layout>
