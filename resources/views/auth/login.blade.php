@extends('layouts.auth')

@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('admin.home') }}"><img src="{{ asset('dashboard/compiled/png/logo.png') }}"
                                                                 alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Войти в систему</h1>
                    <p class="auth-subtitle mb-5">
                        Войдите в систему, используя свои данные, которые вы ввели при регистрации
                    </p>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="email" type="email"
                                   class="form-control form-control-xl{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}"
                                   required autofocus/>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password"
                                   class="form-control form-control-xl{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="Пароль" required/>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value=""
                                   id="flexCheckDefault"{{ old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Запонмить меня
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Войти
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Нет учётной записи?
                            <a href="{{ route('register') }}" class="font-bold">Зарегистрироваться</a>
                        </p>
                        <p>
                            <a href="{{ route('password.request') }}" class="font-bold">
                                Забыли пароль?
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
@endsection
