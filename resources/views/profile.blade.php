<x-app-layout>
    <div class="flex items-center pt-6 sm:justify-center sm:pt-0">
      <div class="mt-6 w-[80%] overflow-hidden rounded-xl bg-white p-10 pt-12 ">

        <div class="title font-montserrat text-primary-purple pb-8 text-3xl font-bold tracking-wide drop-shadow-xl text-center">Profil Saya</div>
        
        <div id="error_wrapper">
        </div>
        {{-- <p class="text-gray-400 mt-2 dark:text-gray-400">{{Auth::user()->role}}</p> --}}
        {{-- <form method="" class="flex flex-col gap-y-1" action="{{  }}"> --}}
        <div id="input-field" class="flex flex-col gap-y-1 user-input" >

          <!-- NIP/Regis_number -->
              <div class="text-xs text-end mx-1 font-medium w-full" disabled>
                <span>Nomor Induk Pegawai : {{ Auth::user()->registration_number }}</span>
              </div>
          
          {{-- <div class="columns-2"> --}}

            <!-- Username -->
            <div class="input-wrapper">
              <label for="username" class="text-primary-purple font-montserrat pl-1 text-xs">Nama Lengkap</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="username" type="text"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="username" value="{{ Auth::user()->username }}" required autocomplete="username" disabled />
                  @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
              </div>
            </div>

          {{-- </div> --}}
            
          <!-- Email Address -->
          <div class="input-wrapper">
            <label for="email" class="text-primary-purple font-montserrat pl-1 text-xs">E-mail</label>
            <div class="relative flex h-14 w-full flex-col">
              <input id="email" type="email"
                class="absolute w-full cursor-text rounded-lg border-none  leading-normal shadow outline-none "
                name="email" value="{{ Auth::user()->email }}" required autocomplete="email" disabled />
                @error('email')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
            </div>
          </div>

          <!-- Address -->
          <div class="input-wrapper">
            <label for="address" class="text-primary-purple font-montserrat pl-1 text-xs">Alamat</label>
            <div class="relative flex h-14 w-full flex-col">
              <input id="address" type="text"
                class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                name="address" value="{{ Auth::user()->address }}" required autocomplete="address" disabled />
                @error('address')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
            </div>
          </div>

          <div class="columns-3">
            <!-- Phone -->
            <div class="input-wrapper">
              <label for="phone" class="text-primary-purple font-montserrat pl-1 text-xs">Nomor Telepon</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="phone" type="number"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="phone" value="{{ Auth::user()->phone }}" required autocomplete="phone" disabled />
                  @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
              </div>
            </div>
  
            <!-- NIK -->
            <div class="input-wrapper">
              <label for="nik" class="text-primary-purple font-montserrat pl-1 text-xs">NIK</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="nik" type="number"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="nik" value="{{ Auth::user()->nik }}" required autocomplete="nik" disabled />
                  @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
              </div>
            </div>

            <!-- Birthday -->
            <div class="input-wrapper">
              <label for="birthday" class="text-primary-purple font-montserrat pl-1 text-xs">Tanggal Lahir</label>
              <div class="relative flex h-14 w-full flex-col">
                <input id="birthday" type="date"
                  class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                  name="birthday" value="{{ Auth::user()->birthday }}" required autocomplete="birthday" disabled />
                  @error('birthday')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
              </div>
            </div>

          </div>
  
          {{-- <!-- password -->
          <div class="input-wrapper">
            <label for="password" class="text-primary-purple font-montserrat pl-1 text-xs">Confirm Password</label>
            <div class="relative flex h-14 w-full flex-col">
              <input id="password" type="password"
                class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "
                name="password" value="" required autocomplete="password" disabled />
                @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
            </div>
          </div> --}}

          {{-- <div class="input-wrapper"> --}}
            <div id="button-wrapper" class="relative flex mb-5 flex justify-end font-semibold">
              <button id="editButton" type="date" class="ml-5 rounded-lg" name="editButton">Edit</button>
              {{-- <button id="cancelButton" type="date" class="ml-5 rounded-lg bg-sky-200" name="cancelButton">Cancel</button>
              <button id="submitButton" type="date" class="ml-5 rounded-lg bg-orange-200" name="submitButton">Update</button> --}}
            </div>
          {{-- </div> --}}
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

<script>
var passwordEls = 
'<div class="input-wrapper">'+
    '<label for="password" class="text-primary-purple font-montserrat pl-1 text-xs">Password</label>'+
    '<div class="relative flex h-14 w-full flex-col">'+
      '<input id="password" type="password"'+
        'class="absolute w-full cursor-text rounded-lg border-none leading-normal shadow outline-none "'+
        'name="password" value="" required autocomplete="password" />'+
        // '@error("password")'+
          // '<div class="invalid-feedback">'+
              // '{{ $message }}'+
          // '</div>'+
        // '@enderror'+
        "<span class='text-danger'>{!! $errors->first('username', ':message') !!} </span>"+
    '</div>'+
  '</div>';

var initialVal;

  $(document).ready(function() {
    $(".user-input input").addClass("bg-gray-100");
    initialVal = {
      username : $('#username').val(),
      email : $('#email').val(),
      // password : $('#password').val(),
      address : $('#address').val(),
      phone : $('#phone').val(),
      nik : $('#nik').val(),
      birthday : $('#birthday').val()
    };
  });
  

    $('#input-field').on('click', '#editButton', function(){
      // $(".user-input input").prop("disabled",!$(".user-input input").prop('disabled'));
      $(".user-input input").prop("disabled",false);

      var els = 
              '<div id="button-wrapper" class="relative flex mb-5 flex justify-end font-semibold">' +
                '<button id="cancelButton" type="date" class="ml-5 rounded-lg bg-sky-200" name="cancelButton">Cancel</button>' +
                '<button id="submitButton" type="date" class="ml-5 rounded-lg bg-orange-200" name="submitButton">Update</button>' +
              '</div>';
      

      $('#input-field').append(passwordEls);
      $('#input-field').append(els);
      $(".user-input input").removeClass('bg-gray-100').addClass("bg-sky-50");
      $(this).parent().remove();
    });

    $('#input-field').on('click', '#cancelButton', function(){
      $(".user-input input").prop("disabled",true);
      $(".user-input input").removeClass('bg-sky-50').addClass("bg-gray-100");

      var els = 
              '<div id="button-wrapper" class="relative flex mb-5 flex justify-end font-semibold">' +
                '<button id="editButton" type="date" class="ml-5 rounded-lg" name="editButton">Edit</button>' +
              '</div>';

      $(this).parent().remove();
      $('#password').parent().parent().remove();
      $('#input-field').append(els);
      
      $('#username').val(initialVal.username);
      $('#email').val(initialVal.email);
      $('#address').val(initialVal.address);
      $('#phone').val(initialVal.phone);
      $('#nik').val(initialVal.nik);
      $('#birthday').val(initialVal.birthday);
    })

    $('#input-field').on('click', '#submitButton', function(){
        console.log('beforeAJAX');
        $("#error_wrapper *").remove();      

        axios({
          method: 'post',
          url: '/api/user/update',
          data:{
              username : $('#username').val(),
              email : $('#email').val(),
              password : $('#password').val(),
              address : $('#address').val(),
              phone : $('#phone').val(),
              nik : $('#nik').val(),
              birthday : $('#birthday').val()
          }
        })
        .then(response => {
          console.log(response.data);
          alert(response.data['success']); // pake alert duls
          location.reload();
        })
        .catch(error => {
          if (error.response) {
            // if (error.response.data.errors.username) {
            //    console.log(error.response.data.errors.username[0]);
            // }
            // if (error.response.data.errors.email) {
            //   error.response.data.errors.email[0];
            // }
            // if (error.response.data.errors.phone) {
            //   error.response.data.errors.phone[0];
            // }
            // if (error.response.data.errors.password) {
            //   error.response.data.errors.password[0];
            // }
            // if (error.response.data.errors.address) {
            //   error.response.data.errors.address[0];
            // }
            // if (error.response.data.errors.nik) {
            //   error.response.data.errors.nik[0];
            // }
            // if (error.response.data.errors.birthday) {
            //   error.response.data.errors.birthday[0];
            // }
            // Request made and server responded
            var errWrapper = 
            '<div class="flex justify-between flex-wrap items-center bg-red-100 border border-red-400 text-red-700 py-3 px-5 mb-5 rounded relative" role="alert">'+
              '<strong class="mx-1 w-[100%] font-bold">Holy sheeeeeeeeeesh!</strong>'+
              '<ul class="text-list">'+
                // '<strong class="mx-1 font-bold">Holy smokes!</strong>'+
                // '<span class="mx-1">Something seriously bad happened.</span>'+
              '</ul>'+
              // '<span class="top-0 bottom-0 right-0 py-3">'+
              //   '<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>'+
              // '</span>'+
            '</div>';

            $("#error_wrapper").append(errWrapper);

            $.each(error.response.data.errors, function(key,value) {
              console.log(key,value);
              $("#error_wrapper .text-list").append('<li class="text ml-5"><strong>'+$('#'+key).parent().siblings("label").html()+' : </strong><span class="mx-1">'+value+'</span></li>');
            });
            if(error.response.data.err){
              $("#error_wrapper .text-list").append('<li class="text ml-5"><div class="mx-1">'+error.response.data.err+'</div></li>');
            }
          }
          else if (error.request) {
            console.log(error.request);
          } else {
            console.log('Error', error.message);
          }
        });

        console.log('after');

    })
</script>
