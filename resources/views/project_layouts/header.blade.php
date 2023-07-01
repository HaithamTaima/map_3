<div>
    <div style="float: right">
        <p style="margin-left:260px; padding-top: 10px;margin-bottom: 2px;color: white">Welcome {{$user_name}} </p>
        <a style="margin-left:260px;color: white" href="{{ route('logout') }}"
           onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>

</div>
