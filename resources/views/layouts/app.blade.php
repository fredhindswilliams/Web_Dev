<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Hinds FC - @yield('title')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <div style="position: absolute; top: 10px; right: 20px; display: flex; gap: 10px;">
        <a href="{{route('posts.index') }}">Posts</a>
        @auth
            <a href="{{ route('profiles.show', ['user' => Auth::user()]) }}">Profile</a>
            @if (Auth::user()->admin_status)
                <a href="{{route('users.index') }}">USERS</a>
            @endif
            <a href="#" id="notificationsDropdown">
                Notifications
                @if(auth()->user()->unreadNotifications->count())
                    <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                @endif
            </a>
            <div id="notificationsMenu" style="display:none;">
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <div>
                        <a href="{{ route('posts.show', $notification->data['post_id']) }}">
                            {{ $notification->data['commenter_name'] }} commented: 
                            "{{ Str::limit($notification->data['comment_body'], 25) }}"
                        </a>
                    </div>
                @empty
                    <div>No new notifications</div>
                @endforelse
            </div>
            <script>
            document.getElementById('notificationsDropdown').addEventListener('click', function(e) {
                e.preventDefault();
                let menu = document.getElementById('notificationsMenu');
                menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
                fetch("{{ route('notifications.markAsRead') }}", { method: 'POST', headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                } });
            });
            </script>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            <button type="submit">Logout</button>
            </form>
        @endauth
    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endguest
    </div>

    <body>
        <h1>@yield('title')</h1>
        @if ($errors->any())
            <div  style="color: #c50606ff;">
                Errors:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div>
            <body style="background-color: #f3f3c8ff;">
                <p>@yield('content')<p>
            </body>
        </div>
        <style>
            nav svg {
                height: 1rem !important;
                width: 1rem !important;
            }
        </style>
        @livewireScripts
    </body>
</html>
