<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">

    <title>Connexion | CS L'ile des Roses'</title>

    <link rel="apple-touch-icon" href="{!! asset('/images/favicon.png') !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('/images/favicon.png') !!}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/vendors.min.css') !!}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/bootstrap-extended.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/colors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/components.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/themes/dark-layout.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/themes/bordered-layout.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/themes/semi-dark-layout.min.css') !!}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/core/menu/menu-types/vertical-menu.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/plugins/forms/form-validation.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/pages/page-auth.min.css') !!}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/style.css') !!}">
    <!-- END: Custom CSS-->

    <!-- Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <style>
        .card{
            opacity: 0.97;
        }
   </style>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" style="background: url('{{ asset('/images/ready-back-school.jpg') }}'); background-repeat:no-repeat; background-size:cover;" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="auth-wrapper auth-v1 px-2">
                <div class="auth-inner py-2">
                    <!-- Login v1 -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="divider mt-2 mb-0">
                                <div class="divider-text"> 
                                    <a href="javascript:void(0);" class="brand-logo">
                                        {{-- <h2 class="brand-text text-primary ml-1">DIBA SMS</h2> --}}
                                        <img src="{!! asset('/images/logo.png') !!}" alt="Logo" />
                                    </a>
                                </div>
                              </div>
                            <h4 class="card-title mb-1">CS L'ile des Roses : Connexion</h4>
                            <p class="card-text mb-2">Entrer vos identifiants pour vous connecter.</p>

                            <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>

                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="exemple@example.com" aria-describedby="email" tabindex="1" autofocus oninput="checkUser()" />

                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {{-- <div class="d-flex justify-content-between">
                                    <label for="login-password">Mot de passe</label>
                                    <a href="page-auth-forgot-password-v1.html">
                                        <small>Mot de passe oublié ?</small>
                                    </a>
                                </div> --}}
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group d-none" id="content_confirm_password">
                                <label for="confirm_password" class="form-label">Confirmation de mot de passe</label>
                                <input type="password" name="confirm_password" class="form-control form-control-merge @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                @error('confirm_password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="remember-me" tabindex="3" />
                                <label class="custom-control-label" for="remember-me"> Se souvenir de moi </label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block mb-2" tabindex="4">Connectez-vous</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Login v1 -->
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{!! asset('/app-assets/vendors/js/vendors.min.js') !!}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{!! asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{!! asset('/app-assets/js/core/app-menu.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/js/core/app.min.js') !!}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{!! asset('/app-assets/js/scripts/pages/page-auth-login.js') !!}"></script>
    <!-- END: Page JS-->

    <script>
      $(window).on('load',  function(){
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      })
    </script>

    <script src="{!! asset('/js/functions.js') !!}"></script>

    <script>
        function checkUser(){
            var email = $('#email').val()

            var route = '{{ route("recover_user.email", ":email") }}';
                route = route.replace(':email', email);
            $.get(route, function(data) {
                if (data.response) {
                    $('#content_confirm_password').removeClass('d-none')
                }else{
                    $('#content_confirm_password').addClass('d-none')
                }
            });
        }

        window.onload = checkUser()

        @if(Session::has('User unactive')) 
            message_alert('danger',"Votre compte est désactivé. Vous n'avez plus les drois pour vous connecter sur cette plateforme !") 
        @endif

        @if(Session::has('password succes')) 
            message_alert('success',"Vous avez modifier votre mot de passe. Veuillez vous reconnecter.") 
        @endif

    </script>
  </body>
  <!-- END: Body-->
</html>
