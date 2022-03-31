<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Weibo App') - Laravel 入门教程</title>
    <!--laravel mix
      css文件每次修改，由于浏览器缓存问题不会更新,
      mix解决方案是为每一次的文件修改做哈希处理。只要文件修改，哈希值就会变，提醒客户端需要重新加载文件
      我们只需要对 webpack.mix.js 稍作修改，即可使用此功能  .version()
      模板改成mix('css/app.css')
    -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  </head>
  <body>

    @include('layouts._header')

    <div class="container">
      @yield('content')
      @include('layouts._footer')
    </div>
  </body>
</html>
