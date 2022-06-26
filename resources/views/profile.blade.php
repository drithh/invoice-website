<x-app-layout>
    <div class="flex items-center pt-6 sm:justify-center sm:pt-0">
      <div class="mt-6 w-[80%] overflow-hidden rounded-xl bg-white p-10 pt-12 ">

        <div class="title font-montserrat text-primary-purple pb-8 text-3xl font-bold tracking-wide drop-shadow-xl text-center">Profil Saya</div>
        {{-- <p class="text-gray-400 mt-2 dark:text-gray-400">{{Auth::user()->role}}</p> --}}

        {{-- <form method="" class="flex flex-col gap-y-1" action="{{  }}"> --}}
        <div class="flex flex-col gap-y-1" >

          <!-- Username -->
          <div class="input-wrapper">
            <label for="username" class="text-primary-purple font-montserrat pl-1 text-xs">Username</label>
            <div class="relative flex h-14 w-full flex-col">
              <input id="username" type="text"
                class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                name="username" value="{{ Auth::user()->username }}" required autocomplete="username" disabled />
            </div>
          </div>
          <div class="columns-2">
            
            <!-- Email Address -->
            <div class="input-wrapper">
              <label for="email" class="text-primary-purple font-montserrat pl-1 text-xs">E-mail</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="email" type="email"
                  class="absolute w-full cursor-text rounded-lg border-none  leading-normal shadow outline-none "
                  name="email" value="{{ Auth::user()->email }}" required autocomplete="email" disabled />
              </div>
            </div>
  
            <!-- Fullname -->
            <div class="input-wrapper">
              <label for="fullname" class="text-primary-purple font-montserrat pl-1 text-xs">Fullname</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="fullname" type="text"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="fullname" value="{{ Auth::user()->fullname }}" required autocomplete="fullname" disabled />
              </div>
            </div>

          </div>

          <!-- Address -->
          <div class="input-wrapper">
            <label for="address" class="text-primary-purple font-montserrat pl-1 text-xs">Address</label>
            <div class="relative flex h-14 w-full flex-col">
              <input id="address" type="text"
                class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                name="address" value="{{ Auth::user()->address }}" required autocomplete="address" disabled />
            </div>
          </div>

          <div class="columns-3">
            <!-- Phone -->
            <div class="input-wrapper">
              <label for="phone" class="text-primary-purple font-montserrat pl-1 text-xs">Phone</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="phone" type="number"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="phone" value="{{ Auth::user()->phone }}" required autocomplete="phone" disabled />
              </div>
            </div>
  
            <!-- NIK -->
            <div class="input-wrapper">
              <label for="nik" class="text-primary-purple font-montserrat pl-1 text-xs">NIK</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="nik" type="number"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="nik" value="{{ Auth::user()->nik }}" required autocomplete="nik" disabled />
              </div>
            </div>

            <!-- Birthday -->
            <div class="input-wrapper">
              <label for="birthday" class="text-primary-purple font-montserrat pl-1 text-xs">Birthday</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="birthday" type="date"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="birthday" value="{{ Auth::user()->birthday }}" required autocomplete="birthday" disabled />
              </div>
            </div>

          </div>


        </div>

      </div>
    </div>




    <div class="flex text-7xl font-bold h-screen place-content-center place-items-center">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
  
        <x-nav-link :href="route('logout')" :active="request()->routeIs('logout')" onclick="event.preventDefault();this.closest('form').submit();">
          {{ __('Logout') }}
        </x-nav-link>
      </form>
    </div>
    
</x-app-layout>
