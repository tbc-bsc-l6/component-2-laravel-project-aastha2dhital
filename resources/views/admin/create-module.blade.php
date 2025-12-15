<h1>Create Module Page</h1>
<form method="POST" action="/admin/modules">
    @csrf

    <label>Module Name</label><br>
    <input type="text" name="name"><br><br>

    <button type="submit">Create Module</button>
</form>