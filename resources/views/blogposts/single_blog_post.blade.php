@extends('layout')
@section('main')

    <!-- main -->
    <main class="container">
      <section class="single-blog-post">
        <h1>{{ $post->title }}</h1>

        <p class="time-and-author">
            {{ $post-> created_at->diffForHumans()}}
          <span>Written By {{ $post->user->name }}</span>
        </p>

        <div class="single-blog-post-ContentImage" data-aos="fade-left">
          <img src="{{ asset($post->imagePath) }}" alt="" />
        </div>

        <div class="about-text">
          {!! $post->body !!}
        </div>
      </section>
      <section class="recommended">
        <p>Related</p>
        <div class="recommended-cards">
            @foreach ($relatedPosts as $relatedPost )

              <div class="recommended-card" >
                <img src="{{asset($relatedPost->imagePath)}}" alt="" loading="lazy" style="width: 350px; height:350px"/>
                <h4>
                  {{$relatedPost->title}}
                </h4>
              </div>

            @endforeach

        </div>
      </section>
    </main>

    @endsection
