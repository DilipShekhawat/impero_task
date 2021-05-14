
 <aside class="sidebar-shell sidebar-bg">
  <div class="menuIcon">
    <span></span>
  </div>

  <ul class="navigation-list">
    <li class="nav-items <?= Request::segment(1)  =='home' ? 'active' : '' ?> ">
      <a href="{{route('welcome')}}" class="nav-text"
        ><i class="nav-icons"><img src="{{asset('frontend/images/home-icon.svg')}}" /></i>
        <span class="text">home</span></a
      >
    </li>
  </ul>
  
</aside>
