{{--x-layout hace referencia a components--}}
<x-layout>
    @include("posts._header")
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <!-- We are going to check if there  are posts in the database -->
        @if($posts->count())
            <x-posts-grid :posts="$posts"/>
            {{ $posts->links() }}
        @else
            <p class="text-center">No post yet. Please check back later</p>
        @endif
    </main>
</x-layout>




