<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Betterplace - @yield('title')</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
  </head>
  <body>

     <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="{{ setActive('') }}"><a href="/">Overview</a></li>
            <li class="{{ setActive('projects.list') }}"><a href="/projects/list?status=all">Projects</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="{{ setActive('projects.update-all') }}"><a href="/projects/update-all">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
            </a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="/js/d3-data.js"></script>
    <script src="/js/main.js"></script>
  </body>
</html>