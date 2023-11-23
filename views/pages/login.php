<main class="form-signin w-100 m-auto">
    <form action="/login" method="post">
        <div class="d-flex" style="align-items: center; justify-content: space-between">
            <h2>Вход</h2>
        </div>
        <div class="form-floating mt-3">
            <input type="text" class="form-control" name="login" id="login" placeholder="name@areaweb.su">
            <label for="login">Логин</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Пароль">
            <label for="floatingPassword">Пароль</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Войти</button>
    </form>
</main>
