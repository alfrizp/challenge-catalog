<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg"
                alt="Logo" width="30" height="30">
        </a>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('app.home') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('suppliers.index') }}">{{ __('app.supplier') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">{{ __('app.product') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
