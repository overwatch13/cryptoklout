<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php print $metaTitle; ?></title>
    <meta name="description" content="<?php print $metaDescription; ?>">
    <meta name="keywords" content="<?php print $metaKeywords; ?>">
    
    <?php if(isset($ogUrl)){ ?>
    <meta property="og:url" content="<?php echo $ogUrl; ?>" />
    <?php } ?>
    <?php if(isset($ogType)){ ?>
    <meta property="og:type" content="<?php echo $ogType; ?>" />
    <?php } ?>
    <?php if(isset($ogTitle)){ ?>
    <meta property="og:title" content="<?php echo $ogTitle; ?>" />
    <?php } ?>
    <?php if(isset($ogDescription)){ ?>
    <meta property="og:description" content="<?php echo $ogDescription; ?>" />
    <?php } ?>

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/img/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/img/ico/favicon.png" type="image/x-icon" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/js/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/js/vendors/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="/css/landy-iconfont.css">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https:/fonts.googleapis.com/css?family=Open+Sans:300,400,700,800">
    <!-- owl carousel-->
    <link rel="stylesheet" href="/js/vendors/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="/js/vendors/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/css/style.default.css" id="theme-stylesheet">
    
    <!-- for search and select -->    
    <link rel="stylesheet" href="/node_modules/select2/dist/css/select2.min.css">

    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/css/less/custom.css">

    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/css/less/media-queries.css">

    <!-- php dynamic css additions - page specific -->
    <?php 
    if(isset($cssSpecific)){
        foreach($cssSpecific as $value){
            echo '<link rel="stylesheet" href="/css/' . $value . '" type="text/css">';
            echo "\n";
        }
    }
    ?>

  </head>
  <body>

<!-- FACEBOOK SDK -->
<script>
  /*window.fbAsyncInit = function() {
    FB.init({
      appId      : '488287958023847',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));*/
</script>