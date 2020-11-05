<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hambre Cero</title>
    <style type="text/css">
        .form-group2 {
            text-align: justify;
        }

        .navbar {
            background: #009DC7;
        }

        .card-title {
            background: #009DC7;
            text-align: center;
            color: white;
            font-size: 24px;
        }

    </style>
</head>

<body>
    <div class="container row">
        <nav class="navbar fixed-top navbar-light">
            <a class="navbar-brand" href="#" style="color: white;">Secretaria de Desarrollo Social</a>
        </nav>
    </div>

    {{-- <form action="/exl" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button>mandar excel</button>
    </form> --}}
    <div class="container">

        @yield('content')

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        function printHTML() {  
            if (window.print) {
                window.print();
            }
        }
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        $(document).ready(function() {
           
            $("#cuestionario").submit(function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "/",
                    data: $("#cuestionario").serialize(),
                    success: function(data) {
                        $("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        // $("[name = 'send']").attr("disabled", true);
                        $("[name = 'send']").hide();
                        $("[name='accion']").show();
                        $("[name='rel']").show();
                        setTimeout(function() { 
                            $("#sccs").alert('close');
                        }, 3000);                        
                        window.print();
                    }
                });
            });

        });
    </script>
</body>

</html>
