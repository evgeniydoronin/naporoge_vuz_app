<x-auth-layout>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="brand-logo pb-4 text-center">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    <img class="logo-light logo-img logo-img-lg" src="{{ asset('images/logo.png') }}" >
                    <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/logo-dark.png') }}">
                </a>
            </div>
            <div class="card">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Войти</h4>
                        </div>
                    </div>
                    @if(session('status'))
                        <p class="text-success">{{ session('status') }}</p>
                    @endif
                    <form action="{{ route('login') }}" method="post" class="form-validate">
                        @csrf

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" name="email" value="{{ old('email') }}"  class="form-control form-control-lg" id="email" placeholder="Ваш email" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Пароль</label>
                                <a class="link link-primary link-sm" href="{{ route('password.request') }}">Забыли пароль?</a>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Ваш пароль" required>
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" name="remember" class="custom-control-input" id="rememberCheck">
                            <label class="custom-control-label" for="rememberCheck">Запомнить</label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="nk-footer nk-auth-footer-full">
            <div class="container wide-lg">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="nk-block-content text-start text-lg-left">
                            <p class="text-soft">&copy; 2023</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-end">
                        <a href="https://evgeniydoronin.com" target="_blank">ED</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wrap @e -->
</x-auth-layout>
