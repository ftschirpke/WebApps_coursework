<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- My own CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}"/>
        <!-- Bootstrap 5 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- My own JavaScript -->
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <!-- Vue.js -->
        <script src="https://unpkg.com/vue@3"></script>
        <!-- Axios -->
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <!-- He Encoder/Decoder -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/he/1.2.0/he.min.js" integrity="sha512-PEsccDx9jqX6Dh4wZDCnWMaIO3gAaU0j46W//sSqQhUQxky6/eHZyeB3NrXD2xsyugAKd4KPiDANkcuoEa2JuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <title>{{ $title ?? '(Course)work in progress'}}</title>
    </head>
    <body class="bg-secondary text-dark">
        <main>
            <div class="container pt-4">
                <div class="row justify-content-md-center">
                    <div class="col-lg-2"></div>
                    @if (session('flash_msg'))
                    <div class="alert alert-dark">
                        {{ session('flash_msg') }}
                    </div>
                    @endif
                    {{ $slot }}
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </main>

    </body>
</html>