@component('mail::message')
# Создание учетной записи

Вы зарегистрированы на портале как {{ $role }}.

Ваш логин: {{ $email }}

Ваш пароль: {{ $password }}

@component('mail::button', ['url' => $url])
    Войти
@endcomponent

С уважением,<br>
ГК Терминал
@endcomponent
