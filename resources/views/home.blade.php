<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Página inicial</title>
        <style>
            
        </style>
        <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/font.css')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <div id="preloader"></div>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="">Pagina inicial</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Mobile</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Sobre o sistema</a></li>
                    </ul>
                    <button class="btn btn-primary px-4 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                        <span class="d-flex align-items-center">
                            <span class="">Entrar</span>
                        </span>
                    </button>
                </div>
            </div>
        </nav>
        <!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- Mashead text and app badges-->
                        <div class="text-center text-lg-start">
                            <h1 class="display-1 lh-1 mb-1">Invoke Vendas</h1>
                            <p class="lead fw-normal text-muted mb-4">Invoke Vendas é um sistema de vendas de alto desempenho para vendas rápida.</p>
                            <p class="lead fw-normal text-muted ">Ao lado você vai encontrar o video de demonstração do sistema.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Masthead device mockup feature-->
                        <iframe style="border-radius: 30px;" width="660" height="415" src="https://www.youtube.com/embed/2fwk9a-eqT8?si=Ll2oLyePuj1VdWQ2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </header>
        <!-- Quote/testimonial aside-->
        <aside class="text-center bg-gradient-primary-to-secondary">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-8">
                        <div class="h2 fs-1 text-white mb-4">"Um sistema que facilita sua vida e a dos funcionários no trabalho!"</div>
                        <img src="vendor/adminlte/dist/img/invokevendas_m.png" alt="..." style="height: 3rem" />
                    </div>
                </div>
            </div>
        </aside>
        <!-- App features section-->
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-phone icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Suporte para celular</h3>
                                        <p class="text-muted mb-0">Você pode revisar seus dados de vendas de longe!</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-person icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Flexibilidade</h3>
                                        <p class="text-muted mb-0">Você pode mander a conta de um cliente estando fora da empresa.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-5 mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi bi-laptop icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Segunda opção</h3>
                                        <p class="text-muted mb-0">Seu computador deu problema? não tem problema! você pode usar o celular para vender!</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Armazenamento em nuvem</h3>
                                        <p class="text-muted mb-0">Seus dados estão seguro no amazon AWS!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-0">
                        <!-- Features section device mockup-->
                        <div class="features-device-mockup">
                            <img style="border-radius: 30px; border: 4px solid black" width="340px" src="vendor/adminlte/dist/img/imgMobile.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic features section-->
        <section class="bg-light">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 text-center mb-5">
                        <h1>Sobre o sistema</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <span>
                                    <h2 class="text-center">Realizar vendas</h2>
                                </span>
                                <img class="img-fluid mb-4" src="assets/img/produtos/vendas.png" alt="..." />
                                <span >
                                    <h5 class="text-muted">Na parte de vender, você pode pesquisar produtos, andar através das setas e selecionar com enter. 
                                        Você pode cancelar item, venda completa e pode finalizar a venda.</h5>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <span>
                                    <h2 class="text-center">Gerenciamento de caixa</h2>
                                </span>
                                <img class="img-fluid mb-4" src="assets/img/produtos/caixa.png" alt="..." />
                                <span>
                                    <h5 class="text-muted">
                                        Nessa seção a gente controla o todo o dinheiro que entra e sai do caixa, podendo adicionar dinheiro, retirar, e quando vende produtos é adicionado aqui.

                                    </h5>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-3">

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <span>
                                    <h2 class="text-center">Produtos</h2>
                                </span>
                                <img class="img-fluid mb-4" src="assets/img/produtos/produtos.png" alt="..." />
                                <span>
                                    <h5 class="text-muted">
                                        Nessa seção podemos adicionar produtos, editar e excluir, com a seção de clientes é semelhante.
                                    </h5>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <span>
                                    <h2 class="text-center">Histórico de vendas</h2>
                                </span>
                                <img class="img-fluid mb-4" src="assets/img/produtos/historico.png" alt="..." />
                                <span>
                                   <h5 class="text-muted">
                                        Nessa seção fica armazenado todas transações e vendas do sistema.
                                   </h5>
                                </span>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </section>
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
        <!-- Footer-->
        <footer class="bg-black text-center py-5">
            <div style="height: 300px;" class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div>
                            <img style="width: 50px" src="{{asset('vendor/adminlte/dist/img/invokevendas_m.png')}}" alt="">
                            <h4 class="text-white-50">Invoke Vendas</h4>
                        </div>
                        <div class="text-white-50 small ">
                            <div class="mb-2">&copy; Invoke Vendas 2023. Todos direitos reservados.</div>
                            <a href="#!">Privacidade</a>
                            <span class="mx-1">&middot;</span>
                            <a href="#!">Termos</a>
                        </div>
                    </div>
                    <div class="col-md-4 py-5 px-5">
                        <div class="text-start">
                            <h5 class="text-white-50 m-4">
                                <a href="https://www.instagram.com/bruno__maxuel/" target="_blank">
                                    <i class="bi bi-instagram "></i> Instagram  
                                </a>
                            </h5>
                            <h5 class="text-white-50 m-4">
                                <a href="https://www.facebook.com/bruno.maxuel.5" target="_blank">
                                    <i class="bi bi-facebook "></i> Facebook  
                                </a>
                            </h5>
                            <h5 class="text-white-50 m-4">
                                <a href="https://www.linkedin.com/in/bruno-maxuel/" target="_blank">
                                    <i class="bi bi-linkedin"></i> Linkedin
                                </a>
                            </h5>
                            <h5 class="text-white-50 m-4">
                                <a href="https://www.youtube.com/@brunomaxuel992" target="_blank">
                                    <i class="bi bi-youtube"></i> Youtube
                                </a>
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-3 py-5  text-start">
                        <h5 class="text-white-50 m-4">Links úteis</h5>
                        <div class="m-4">
                            <a href="https://www.youtube.com/watch?v=-cQHBXYEhqM&t=474s">Projeto vendas desktop</a>
                        </div>
                        <div class="m-4">
                            <a href="https://www.youtube.com/watch?v=2fwk9a-eqT8">Projeto vendas web</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Feedback Modal-->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary-to-secondary p-4">
                        <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Entre na sua conta</h5>
                        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0 p-4">
                        <form id="contactForm" method="POST" action="{{route('login.auth')}}">
                            @csrf
                            <!-- Email address input-->
                            <div class="mb-3">
                                <div>Email</div>
                                <input class="form-control" id="email" type="email" name="email" placeholder="Seu email..." data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Name input-->
                            <div class="mb-3">
                                <div>Senha</div>
                                <input class="form-control" id="name" name="password" type="password" placeholder="Sua senha..." data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>

                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Entrar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('assets/js/main.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
