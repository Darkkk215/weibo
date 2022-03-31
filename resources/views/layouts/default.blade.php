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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">Weibo App</a>
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item"><a class="nav-link" href="/help">帮助</a></li>
          <li class="nav-item" ><a class="nav-link" href="#">登录</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      @yield('content')
    </div>
  </body>
</html>
