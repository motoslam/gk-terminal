@component('mail::message')
# Создание аккаунта

Вы зарегистрированы на портале как {{ $role }}.

Ваш пароль: {{ $password }}

@component('mail::button', ['url' => $url])
    Войти
@endcomponent

С уважением,<br>
ГК Терминал
@endcomponent
