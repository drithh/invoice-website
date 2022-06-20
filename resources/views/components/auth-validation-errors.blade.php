@props(['errors'])

@if ($errors->any())
  <div {{ $attributes }}>
    {{-- <div class="font-medium text-primary-warmred">
            {{ __('Whoops! Something went wrong.') }}
        </div> --}}

    <ul class="text-primary-warmred mt-3 list-inside list-disc text-sm">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
