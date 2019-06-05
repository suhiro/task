<ul class="nav flex-column">
    <li class="nav-item">
    <a class="nav-link  @if(request()->is('/home')) active @endif" href="{{ url('/home') }}">Home </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('device.tree') }}">Device Tree</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Administration</a>
  </li>
  
</ul>        
