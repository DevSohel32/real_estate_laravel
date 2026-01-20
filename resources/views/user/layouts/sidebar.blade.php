 <div class="col-lg-3 col-md-12">
     <div class="card">
         <ul class="list-group list-group-flush">
             <li class="list-group-item {{ Request::is('dashboard') ? 'active' : '' }}">
                 <a href="{{ route('dashboard') }}">Dashboard</a>
             </li>
             <li class="list-group-item">
                 <a href="user-orders.html">Messages</a>
             </li>
             <li class="list-group-item">
                 <a href="user-wishlist.html">Wishlist</a>
             </li>
             <li class="list-group-item {{ Request::is('profile') ? 'active' : '' }}">
                 <a href="{{ route('profile') }}">Edit Profile</a>
             </li>
             <li class="list-group-item">
                 <a href="{{ route('logout') }}">Logout</a>
             </li>
         </ul>
     </div>
 </div>
