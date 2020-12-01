@extends('layouts.app')

@section('css');
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />
@endsection

 @section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Subir Imagenes</h1>
                <form action="{{route('admin.files.store')}}"
                    method="POST"
                    class="dropzone"
                    id="my-awesome-dropzone">
                </form> 
            </div>
        </div>

    </div>
 @endsection

 @section('js');
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"         integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous">
    </script>
    
    <script>
        Dropzone.options.myAwesomeDropzone = {
            headers:{
                'X-CSRF-TOKEN' : "{{csrf_token()}}"
            },

            dictDefaultMessage: "Clic o Arrastre una o varias imagenes al recuadro para subirlas",
            acceptedFiles: 'image/*',
            // maxFilesize: 10,
            // maxFiles: 12,
        };
    </script>
 @endsection