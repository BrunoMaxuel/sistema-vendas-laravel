<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Invoke Vendas</title>
  
    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.ico" rel="icon"> -->
    
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  </head>
  
  <body>
    <div id="preloader"></div>
  

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">brunomaxuel2@gmail.com</i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>(84) 98169 - 3614</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://www.facebook.com/bruno.maxuel.5" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/bruno__maxuel/" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/in/bruno-maxuel/" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>
  <!-- End Top Bar -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/favicon.ico"  alt="">
        <h1>Invoke Vendas</h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li>
              <button type="button" class="button" >Fazer login</button>
          </li>
          <li>
              <button type="button" class="button">Cadastrar</button>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
      <div class="container position-relative">
          <div class="row gy-8" data-aos="fade-in">
              <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                <h2>Bem-vindo a <span>Invoke Vendas</span></h2>
                <p style="font-size: 22px">Aqui tem sistema de qualidade!</p>
                <p style="font-size: 22px">Possuimos um sistema de vendas que combina com sua empresa!</p>
               
              </div>
              <div class="col-lg-6 order-1 order-lg-2">
                  <img style="border-radius: 20px;" src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
              </div>
          </div>
      </div>
  </section>

  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Sobre o sistema</h2>
          <!-- <p>O sistema é focado em ter um grande desempenho e facilidade para o usuário usar</p> -->
        </div>

        <div class="row gy-4s">
          <div class="content ps-0  col-lg-5">
            
            <h5>O sistema possui gráficos</h5>
            <ul>
              <li><i class="bi bi-check-circle-fill"></i> Gráfico indicando produtos mais vendidos</li>
              <li><i class="bi bi-check-circle-fill"></i> Gráfico mostrando vendas do mês</li>
              <li><i class="bi bi-check-circle-fill"></i> Gráfico mostrando produtos que precisam ser comprado</li>
            </ul>
            <img src="assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
            
          </div>
          <div class="col-lg-5">
            <div class="content ps-0 ps-lg-5">
              <h5>Características que os clientes mais gostam:</h5>
              <ul>
                <li><i class="bi bi-check-circle-fill"></i> Alta velocidade do sistema</li>
                <li><i class="bi bi-check-circle-fill"></i> O sistema permite realizar vendas rápidas, evitando filas de espera</li>
                <li><i class="bi bi-check-circle-fill"></i> Relatório de vendas, podendo saber quais produtos vendem mais</li>
              </ul>

              <div class="position-relative mt-4">
                <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->



    <!-- ======= Our Services Section ======= -->
    <section id="services" class="services sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Serviços do sistema</h2>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-4 col-md-6">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="bi bi-bar-chart-fill"></i>
              </div>
              <h3>Gráficos</h3>
              <p>Nosso sistema possui gráficos para melhorar administração da empresa</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-box"></i>
              </div>
              <h3>Controle de Caixa</h3>
              <p>O controle de caixa permite o usuário administrar o dinheiro que entra e sai no caixa, também fica incluso o dinheiro das vendas</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-bag-check"></i>
              </div>
              <h3>Controle de estoque</h3>
              <p>Nosso sistema permite controle de estoque, evitando faltar produtos na sua empresa</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-people"></i>
              </div>
              <h3>Clientes</h3>
              <p>Temos área de administração de clientes, quando estamos realizando uma venda, podemos adicionar a venda a conta do cliente</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-calendar4-week"></i>
              </div>
              <h3>Backup do sistema</h3>
              <p>O usuário pode baixar um arquivo com o backup de todos os dados, mas futuramente vai ser realizado automaticamente enviando para a nuvem</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-file-text"></i>
              </div>
              <h3>Relatório de vendas</h3>
              <p>Nosso sistema temos a lista de vendas, podemos editar, excluir ou imprimir</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>
    </section><!-- End Our Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Imagens do sistema</h2>
        </div>

        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4 portfolio-container">


            <div class="col-xl-4 col-md-6 portfolio-item filter-product">
              <div class="portfolio-wrap">
                <a href="" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/produtos/home.png" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Dashboard</a></h4>
                  <p>Aqui situa o inicio do sistema</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
              <div class="portfolio-wrap">
                <a href="" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/produtos/vendas.png" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Vendas</a></h4>
                  <p>A seguir temos a página de vendas</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-books">
              <div class="portfolio-wrap">
                <a href="" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/produtos/caixa.png" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Caixa</a></h4>
                  <p>Aqui temos a página do caixa</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-books">
              <div class="portfolio-wrap">
                <a href="" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/produtos/historico.png" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Histórico de vendas</a></h4>
                  <p>Aqui temos a página do histórico das vendas</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-books">
              <div class="portfolio-wrap">
                <a href="" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/produtos/clientes.png" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Clientes</a></h4>
                  <p>Aqui temos a página de clientes</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
          </div><!-- End Portfolio Container -->

        </div>

      </div>
    </section><!-- End Portfolio Section -->   

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Converse comigo</h2>
        </div>

        <div class="row gx-lg-0 gy-4">

          <div class="col-lg-4">

            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>Serrinha/RN Rua jose armando de lira 19</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>brunomaxuel2@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Telefone</h4>
                  <p>(84) 98169 - 3614</p>
                </div>
              </div><!-- End Info Item -->
            </div>

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Seu nome" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Seu email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="7" placeholder="Mensagem" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Carregando...</div>
                <div class="error-message"></div>
                <div class="sent-message">Mensagem enviada com sucesso!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar mensagem</button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>Invoke Vendas</span>
          </a>
          <p>Invoke Vendas é um software de vendas, foi desenvolvido pensando na satisfação dos clientes.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://www.facebook.com/bruno.maxuel.5"  class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/bruno__maxuel/"  class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/bruno-maxuel/" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Links úteis</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#about">Sobre o sistema</a></li>
            <li><a href="#services">Services</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Design de sistemas web</a></li>
            <li><a href="#"></a>Desenvolvimento de sistemas web</li>
            <li><a href="#">Desenvolvimento de sistema desktop</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Entre em contato</h4>
          <p>
            SERRINHA/RN <br>
            Rua jose armando de lira 19<br>
            Brasil<br><br>
            <strong>Telefone:</strong> (84) 98169 - 3614<br>
            <strong>Email:</strong> brunomaxuel2@gmail.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Invoke Vendas</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}">

  </script>
</body>

</html>