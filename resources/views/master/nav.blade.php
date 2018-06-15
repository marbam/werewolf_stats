<nav class="site-header sticky-top py-1">
  <div class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2 d-none d-md-inline-block" href="/" style="color:#999;">Home</a>
    @if(Auth::check())
      <a class="py-2 d-none d-md-inline-block" href="/insert">Add Game</a>
    @endif
    <a class="py-2 d-none d-md-inline-block" href="/list">List Games</a>
    <a class="py-2 d-none d-md-inline-block" href="/roles">Review: Roles</a>
    <a class="py-2 d-none d-md-inline-block" href="/factions">Review: Factions</a>
    @if(Auth::check())
      <a class="py-2 d-none d-md-inline-block" href="/logout">Logout</a>
    @else
      <a class="py-2 d-none d-md-inline-block" href="/login">Login</a>
    @endif
  </div>
</nav>

<style>
.site-header {
  background-color: rgba(0, 0, 0, .85);
  -webkit-backdrop-filter: saturate(180%) blur(20px);
  backdrop-filter: saturate(180%) blur(20px);
}
.site-header a {
  color: #999;
  transition: ease-in-out color .15s;
}
.site-header a:hover {
  color: #fff;
  text-decoration: none;
}
</style>