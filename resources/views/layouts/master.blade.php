
<!doctype html>
<html lang="fr">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/monStyle.css') !!}
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet'
              type='text/css'>

    </head>
    <body class="body">
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar+ bvn"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">GSB Frais</a>
                </div>

                @if(Session::get('id') == 0)
                <div class="collapse navbar-collapse" id="navbar-collapse-target">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/seConnecter') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se connecter</a></li>
                    </ul>
                </div>
                @endif

                @if (Session::get('id') > 0)
                <div class="collapse navbar-collapse" id="navbar-collapse-target">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/listerFrais') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Lister</a></li>
                        <li><a href="{{ url('/ajouterFrais') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Ajouter</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/seDeconnecter') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se déconnecter</a></li>
                    </ul>
                </div>
                @endif

            </div><!--/.container-fluid -->
        </nav>
    </div>
    <div class="container">

        @yield('content')
    </div>
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/jquery-3.1.1.js') !!}
    {!! Html::script('assets/js/jquery-3.3.1.min.js') !!}
    {!! Html::script('assets/js/jquery-ui.min.js') !!}
    {!! Html::script('assets/js/npm.js') !!}

    {!! Html::script('assets/js/ui-bootstrap-tpls.0.11.js') !!}
    {!! Html::script('assets/js/ui-bootstrap-tpls.js') !!}
    {!! Html::script('assets/js/bootstrap.js') !!}
    </body>
</html>

