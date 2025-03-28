@props(['posts'])

<x-post-featured-card :post="$posts[0]"/>
<!-- If there are not more than 1 post, the next grid won't load -->
@if($posts->count(1))
    <div class="lg:grid lg:grid-cols-6">
        @foreach($posts->skip(1) as $post)
            <x-post-card :post="$post" class="{{$loop->iteration <3 ? 'col-span-3' : 'col-span-2'}}"/>
        @endforeach
    </div>
@endif
