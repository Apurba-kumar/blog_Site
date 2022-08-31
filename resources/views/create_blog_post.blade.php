@extends('layout')

@section('header')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script> --}}
@endsection

@section('main')
<main class="container" style="background-color: #fff;">
    <section id="contact-us">
        <h1 style="padding-top: 50px;">Create New Post!</h1>

        <!-- Contact Form -->
        <div class="contact-form">
            <form action="" method="">
                <!-- Title -->
                <label for="title"><span>Title</span></label>
                <input type="text" id="title" name="title" />

                <!-- Image -->
                <label for="image"><span>Image</span></label>
                <input type="file" id="image" name="image" />

                <!-- Body-->
                <label for="body"><span>Body</span></label>
                <textarea id="body" name="body"></textarea>

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


