@props(['trigger'])
<div x-data="{ show: false }" @click.away="show = false" class="relative"><!--x-date es de Alpine javascript -->
    {{-- Trigger --}}
    <div @click="show = !show">
        {{$trigger}}
    </div>

    {{-- Links --}}
    <!-- Se muestra si es true -->
    <div x-show="show" class="py-2 absolute bg-gray-100 w-full mt-2 rounded-xl w-full z-50 overflow-auto max-h-52"
         style="display:none">
        {{$slot}}
    </div>
</div>
