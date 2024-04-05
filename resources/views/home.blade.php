<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Página inicial</title>
        <style>
            body{
                overflow: hidden;
            }
            #preloader {
                background-color: white;
                position: fixed;
                inset: 0;
                z-index: 9100;
            }
            #preloader:before {
            content: "";
            width: 150px;
            height: 150px;
            position: fixed;
            top: calc(50% - 70px);
            left: calc(50% - 70px);
            border: 40px solid;
            border-radius: 50%;
            border-color: #00A2E8 transparent;
            animation: spin 1.4s linear infinite;
            }
            @keyframes spin {
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
        <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/font.css')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}" />
        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.css')}}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <x-preloader/>
        <x-home.navbar/>
        <x-home.mashead/>
        <x-home.facades/>
        <x-home.systemFeature/>
        <x-home.aboutSystem/>
        <x-home.modalLogin/>
        <!-- Call to action section-->
        <section class="cta">
            <div class="cta-content">
                <div class="container p">
                    <h3 class="text-white-50 display-1 ">
                        Invoke Vendas, você evoluindo com a tecnologia!
                    </h3>
                </div>
            </div>
        </section>
       <x-home.footer/>
        <script src="{{asset('assets/js/home.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.body.style.overflow = 'hidden';
                if (document.querySelector('#preloader')) {
                    window.addEventListener('load', () => {

                    setTimeout(() => {
                        document.querySelector('#preloader').remove();
                    }, 200);
                    });
                }
            });
        </script>
    </body>
</html>
