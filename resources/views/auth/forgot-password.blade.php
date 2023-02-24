<x-auth-layout>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="brand-logo pb-4 text-center">
                <a href="#" class="logo-link">
                    <img class="logo-light logo-img logo-img-lg" src="{{ asset('images/logo.png') }}">
                    <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/logo-dark.png') }}">
                </a>
            </div>
            <div class="card">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Забыли пароль?</h5>
                        </div>
                    </div>
                    @if(session('status'))
                        <p class="text-success">{{ session('status') }}</p>
                    @endif
                    <form action="{{ route('password.email') }}" method="post" class="form-validate">
                        @csrf

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Email</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="email" name="email" required class="form-control form-control-lg" id="default-01" placeholder="Ваш email">
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Отправить ссылку</button>
                        </div>
                    </form>
                    <div class="form-note-s2 text-center pt-4">
                        <a href="{{ route('login') }}"><strong>Войти</strong></a>
                    </div>
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
