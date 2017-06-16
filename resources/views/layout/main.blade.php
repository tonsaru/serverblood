<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    {{ Html::style('css/bootstrap.css') }}
    <title></title>
  </head>
  <body>
    <div class="container">
      @yield('content')

      {{ Html::script('js/bootstrap.min.js')}}
      {{ Html::script('js/jquery.min.js')}}
    </div>
  </body>
</html>
