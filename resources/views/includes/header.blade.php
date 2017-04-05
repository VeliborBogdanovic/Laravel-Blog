<header>
    <nav class="main-nav">
        <ul>
            <li {{ Request::is('blog')? 'class=active':''}} ><a  href="{{ route('blog.index') }}">Blog</a></li>
            <li {{ Request::is('about')? 'class=active':''}} ><a  href="{{ route('about') }}">About</a></li>
            <li {{ Request::is('contact')? 'class=active':''}}><a  href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </nav>
</header>

