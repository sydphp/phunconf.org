<?php
define('DS', DIRECTORY_SEPARATOR);
define('PAGES_DIR', '../pages');
define('TICKETS_ON_SALE', $_GET['TICKETS'] || time() > strtotime('1:30pm 13 January 2015'));

// Page Varibles - these are overwritten in templates/pages.
$bodyClass = '';

$pageTemplate = PAGES_DIR.DS.$_SERVER['PATH_INFO'].'.phtml';

if( $_SERVER['REQUEST_URI'] == '/') {
    $pageTemplate = PAGES_DIR.DS.'index'.'.phtml';
}

if(!is_readable($pageTemplate)) {
    $pageTemplate = PAGES_DIR.'/404.phtml';
    http_response_code(404);
}

$ticketsLabel = (TICKETS_ON_SALE ? '<strong>Tickets!</strong>' : 'Tickets');

$navigation = [
    'Home' => '',
    'What\'s On' => 'whats-on',
    //'Sponsors' => 'sponsors',
    'Schedule' => 'schedule',
    $ticketsLabel => 'tickets',
    'Code of Conduct' => 'code-of-conduct',
];

ob_start();
require $pageTemplate;
$content = ob_get_clean();

?><!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | SydPHP Phunconference</title>
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Join us for the 5th Annual SydPHP Phunconference on 5th February 2015">
    <meta name="keywords" content="PHP, Phunconference, Sydney, Australia, SydPHP, Unconference, Workshops" />
    <link rel="canonical" href="http://phunconf.org/">
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.dropotron.min.js"></script>
    <script src="/js/skel.min.js"></script>
    <script src="/js/skel-layers.min.js"></script>
    <script src="/js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="/css/skel.css" />
        <link rel="stylesheet" href="/css/style.css" />
        <link rel="stylesheet" href="/css/style-wide.css" />
    </noscript>
</head>
<body class="<?=$bodyClass;?>">

<!-- Header -->
<div id="header">
    <div>

        <!-- Logo -->
        <div id="logo">
            <h1>
                <a href="/" class="">
                    <span class="phunconf">phunconf</span> <span class="version">5.0</span>
                </a>
            </h1>
        </div>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <?php
                foreach($navigation as $name => $slug) {
                    if(is_null($slug)) { continue; }
                    $class = ('/'.$slug == $_SERVER['REQUEST_URI'] ? 'current_page_item' : '');
                    ?><li class="<?=$class;?>"><a href="/<?=$slug;?>"><?=$name;?></a></li><?php
                }
                ?>

            </ul>
        </nav>

    </div>
</div>


<?= $content; ?>

<!-- Footer -->
<section id="footer">
    <div class="container">

        <!-- Social -->
        <section>
            <ul class="social">
                <li><a href="https://twitter.com/sydphp" class="icon fa-twitter"><span>Twitter</span></a></li>
            </ul>
        </section>

        <!-- Copyright -->
        <div class="copyright">
         &copy; <span class="brand" >Syd<span class="php">PHP</span></span> <span class="phunconf">Phunconference</span>. This website is on <a href="https://github.com/sydphp/phunconf.org">GitHub</a>
        </div>

    </div>
</section>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-58468722-1', 'auto');
    ga('send', 'pageview');

</script>

</body>
</html>

