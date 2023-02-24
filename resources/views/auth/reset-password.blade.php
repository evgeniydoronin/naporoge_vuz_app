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
                            <h5 class="nk-block-title">Сбросить пароль</h5>
                        </div>
                    </div>
                    <form action="{{ route('password.update') }}" method="post" class="form-validate">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->token }}">

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Email</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" name="email" value="{{ old('email', $request->email) }}" readonly class="form-control form-control-lg" id="default-01">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Новый пароль</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" name="password" autofocus class="form-control form-control-lg" id="password" placeholder="Ваш пароль" required>
                                @error('password')
                                <div style="display:block" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password_confirmation">Повторите пароль</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation" placeholder="Повторите пароль" required>
                                @error('password_confirmation')
                                <div style="display:block" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Обновить пароль</button>
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
    <!-- content @e -->
</x-auth-layout>
