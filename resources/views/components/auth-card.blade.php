<div class="flex min-h-screen items-center pt-6 sm:justify-center sm:pt-0">
  <div class="mt-6 h-fit w-[26rem] overflow-hidden rounded-xl bg-white p-10 pt-12 sm:max-w-md">
    {{ $slot }}
  </div>
</div>

<script>
  const toggleVisibilityPassword = () => {
    const passwordInput = document.querySelector('input#password');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }

    document.querySelector('#eye').classList.toggle('hidden');
    document.querySelector('#eye-slash').classList.toggle('hidden');
  };
</script>
