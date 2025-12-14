<h1>Create Teacher</h1>

<form method="POST" action="/admin/teachers">
    @csrf

    <div>
        <label>Name</label><br>
        <input type="text" name="name">
    </div>

    <br>

    <div>
        <label>Email</label><br>
        <input type="email" name="email">
    </div>

    <br>

    <div>
        <label>Password</label><br>
        <input type="password" name="password">
    </div>

    <br>

    <button type="submit">Create Teacher</button>
</form>
