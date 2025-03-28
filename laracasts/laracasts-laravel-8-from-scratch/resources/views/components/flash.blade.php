{{--Este código lo utilizamos en el layout, nos va a permitir mostrar un mensaje si tenemos en la sesión la variable 'success'--}}
@if (session()->has('success'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)" {{--    Alpine JS--}}
         x-show="show"
         class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif
