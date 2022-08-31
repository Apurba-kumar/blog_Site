@extends('layout')

@section('head')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script> --}}
@endsection

@section('main')
<main class="container" style="background-color: #fff;">
    <section id="contact-us">
        <h1 style="padding-top: 50px;">Create New Post!</h1>

        <!-- Contact Form -->
        <div class="contact-form">
            <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Title -->
                <label for="title"><span>Title</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" />
                @error('title')
                {{-- The $attributeValue field is/must be $validationRule --}}
                    <p style="color: red; margin-bottom:25px;">{{$message}}</p>
                @enderror
                <!-- Image -->
                <label for="image"><span>Image</span></label>
                <input type="file" id="image" name="image" />
                @error('image')
                {{-- The $attributeValue field is/must be $validationRule --}}
                    <p style="color: red; margin-bottom:25px;">{{$message}}</p>
                @enderror
                <!-- Body-->
                <label for="body"><span>Body</span></label>
                <textarea id="body" name="body">{{ old('body') }}</textarea>
                @error('body')
                {{-- The $attributeValue field is/must be $validationRule --}}
                    <p style="color: red; margin-bottom:25px;">{{$message}}</p>
                @enderror
                <!-- Button -->
                <input type="submit" value="Submit" />
            </form>
        </div>

    </section>
@endsection
@section('scripts')
<script>
    CKEDITOR.replace( 'body' );
</script>
{{-- <script>
    ClassicEditor
            .create( document.querySelector( '#body' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script> --}}
@endsection


