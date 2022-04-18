<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{url('/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{url('/frontend/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{url('/frontend/assets/css/templatemo-sixteen.css')}}">
    <link rel="stylesheet" href="{{url('/frontend/assets/css/owl.css')}}">

</head>

<body>

    @include('frontend.partials.header')

<!-- Page Content -->

    @yield('page-content')


@include('frontend.partials.footer')


<!-- Bootstrap core JavaScript -->
<script src="{{url('frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<!-- Additional Scripts -->
<script src="{{url('frontend/assets/js/custom.js')}}"></script>
<script src="{{url('frontend/assets/js/owl.js')}}"></script>
<script src="{{url('frontend/assets/js/slick.js')}}"></script>
<script src="{{url('frontend/assets/js/isotope.js')}}"></script>
<script src="{{url('frontend/assets/js/accordions.js')}}"></script>


<script language = "text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t){                   //declaring the array outside of the
        if(! cleared[t.id]){                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value='';         // with more chance of typos
            t.style.color='#fff';
        }
    }
</script>


    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
</body>

</html>
