<div class="container">
    <div class="row">
        <h1>Create</h1>
    </div>
    <div class="row flex-center">
        <div class="form-div">
            <form class="form" action="/users" method="POST">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Senha" required>
                <a class="btn btn-primary text-white" href="/users">back</a>
                <button class="btn btn-success text-white" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
