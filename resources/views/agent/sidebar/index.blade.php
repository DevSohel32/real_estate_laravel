<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item {{ Request::is('agent/dashboard') ? 'active' : '' }}">
            <a href="{{ route('agent_dashboard') }}">Dashboard</a>
        </li>
        <li class="list-group-item {{ Request::is('agent/agent-payment') ? 'active' : '' }}">
            <a href="{{ route('agent_payment') }}">Make Payment</a>
        </li>
        <li class="list-group-item {{ Request::is('agent/order') ? 'active' : '' }}">
            <a href="{{ route('agent_order') }}">Orders</a>
        </li>
        <li class="list-group-item">
            <a href="user-property-add.html">Add Property</a>
        </li>
        <li class="list-group-item">
            <a href="user-properties.html">All Properties</a>
        </li>
        <li class="list-group-item">
            <a href="user-orders.html">Messages</a>
        </li>
        <li class="list-group-item {{ Request::is('agent/profile') ? 'active' : '' }}">
            <a href="{{ route('agent_profile') }}">Edit Profile</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('agent_logout') }}">Logout</a>
        </li>
    </ul>
</div>