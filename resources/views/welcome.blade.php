
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            </head> -->
    
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>StagePfe</title>
  <link rel="stylesheet" type="text/css" href="./css1/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css1/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="./css1/animate.css">
  <link rel="stylesheet" type="text/css" href="./css1/style.css">
 
</head>

<body>
  <!--header-->
  <header class="main-header" id="header">
    <div class="bg-color">
      <!--nav-->
      <nav class="nav navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                            <span class="fa fa-bars"></span>
                        </button>
              <a href="index.html" class="navbar-brand">SRTB</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="mynavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#header">Home</a></li>
                <li><a href="{{ route('login') }}">Administrateur</a></li>
                <li>
                            <a href="/EmployerLogin">Employer</a>
                    </li>
                <li><a href="#contact">Check</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!--/ nav-->
      <div class="container text-center">
        <div class="wrapper wow fadeInUp delay-05s">
          <h2 class="top-title">SRTB</h2>
          <h3 class="title">rECRUTEMENT</h3>
          <h4 class="sub-title">2019-2020</h4>
          
        </div>
      </div>
    </div>
  </header>
  <!--/ header-->
  <!---->
  <section id="cta-1">
    <div class="container">
      <div class="row">
        <div class="cta-info text-center">
          <h3><span class="dec-tec">“</span>We are hiring now drop your cv and take your place<span class="dec-tec">”</span> -SRTB</h3>
        </div>
      </div>
    </div>
  </section>
  <!---->
  <!---->
  
  <!---->
  
  <!---->
  <section class="section-padding wow fadeInUp delay-05s" id="contact">
    <div class="container">
      <div class="row white">
        <div class="col-md-8 col-sm-12">
          <div class="section-title">
            <h2 class="head-title black">Demande de Recrutement ici </h2>
            <hr class="botm-line">
            <p class="sec-para black">Ceci est le formulaire de recrutement svp remlir soingeusement...</p>
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          <div class="col-md-4 col-sm-6" style="padding-left:0px;">
            

            @if (session('recrutement'))
            <div class="alert alert-success">
           Merci Pour demander {{ session('recrutement.name') }}, Vuiellez consulter votre email
            </div>
            @endif
            
            <div class="contact-info">
              <form action="/Recruit" method="post" role="form" enctype="multipart/form-data" class="contactForm">
              @csrf
              <div class="form-group">
                  <input type="text" name="cin" class="form-control" id="cin" placeholder="Your CIN" data-rule="maxlen:8" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>

                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="numtel" id="numtel" placeholder="Your number" data-rule="maxlen:8" data-msg="Please enter a valid number" />
                  <div class="validation"></div>
                </div>

                <div class="form-group">                           
                            <select name="type"  id="type"
                                class="form-control" >
                                    <option value="">Choisir type de travaille</option>
                                    <option value="Controlleur">Controlleur</option>
                                     <option value="Chauffeur">Chauffeur</option>
                                      <option value="Controlleur">Receveur</option>
                            </select>
                           
                        </div>


                <div class="form-group">
                <label class="control-label"> Date de naissances</label>
                  <input type="date" class="form-control" name="date_naiss" id="date_naiss" placeholder="Your birthday"  data-msg="Please enter a valid date de naiisance" />
                  <div class="validation"></div>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="adresse" id="adresse" placeholder="adresse" data-rule="maxlen:50" data-msg="Please enter a valid adresse" />
                  <div class="validation"></div>
                </div>
                
                <div class="form-group">
                        <label class="control-label">Rejoingez votre cv ici</label>
                        <input type="file" name="fileA" multiple data-preview-file-type="any" />
                        </div>


                <div class="form-group">
                    <label class="control-label">Vous Avez un permid de bus ?</label>
                    <label>
                      <input name="group1" value="oui" type="radio" checked />
                      <span>Oui</span>
                      </label>

                      <input name="group1" value="non" type="radio"  />
                      <span>Non</span>
                      </label>
                        </div>

                        
                
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Your password" data-rule="minlen:6" data-msg="Please enter at least 6 chars" />
                  <div class="validation"></div>
                </div>
                <button type="submit" class="btn btn-send">S'inscrire</button>
              </form>
            </div>

          </div>
          <div class="col-md-4 col-sm-6">
            <h3 class="cont-title">Contactez nous</h3>
            <div class="location-info">
              <p class="white"><span aria-hidden="true" class="fa fa-map-marker"></span>Bizerte ,Tunisia </p>
              <p class="white"><span aria-hidden="true" class="fa fa-phone"></span>Phone: + (216) 72443026 -72436330</p>
              <p class="white"><span aria-hidden="true" class="fa fa-envelope"></span>Email: <a href="" class="link-dec">boc@srtbizerte.com.tn</a></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-icon-container hidden-md hidden-sm hidden-xs">
              <span aria-hidden="true" class="fa fa-envelope-o"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!---->
  <!---->
  <footer class="" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 footer-copyright">
          © Amine Dahmani - All rights reserved
          
        </div>
        <div class="col-sm-5 footer-social">
          <div class="pull-right hidden-xs hidden-sm">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!---->
  <!--contact ends-->
  <script src="./js1/jquery.min.js"></script>
  <script src="./js1/jquery.easing.min.js"></script>
  <script src="./js1/bootstrap.min.js"></script>
  <script src="./js1/wow.js"></script>
  <script src="./js1/custom.js"></script>
 

</body>
</html>

