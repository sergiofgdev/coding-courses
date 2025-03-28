<x-dropdown>
    {{-- Lo que hay dentro de este tag, será insertado en {{$trigger}} de dropdown.blade.php--}}
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{isset($currentCategory)? ucwords($currentCategory->name) :'Categories'}}
            <x-down-arrow class="absolute pointer-events-none" style="right: 12px;">

            </x-down-arrow>
        </button>
    </x-slot>

{{--    <x-dropdown-item href="/" :active="request()->routeIs('home')">--}}
{{--        All--}}
{{--    </x-dropdown-item>--}}

    <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}"
                     :active="request()->routeIs('home')">All
    </x-dropdown-item>



    @foreach($categories as $category)

        {{--                    {{isset($currentCategory)&&$currentCategory->id == $category->id ? 'bg-blue-500 text-white':''}}--}}
        <x-dropdown-item
            href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
            :active="request()->is('categories/' . $category->slug)"
        >
            {{ucwords($category->name)}}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
