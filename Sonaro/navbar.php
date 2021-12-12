<div class="container-fluid g-0">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <div class="col text-start">
                <a class="navbar-brand" href="/Sonaro">
                <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
                </a>
            </div>
            <div class="col text-end">
                <a href="edit-profile.php" class="btn btn-primary">Profilio redagavimas</a>
                <a href="logout.php" class="btn btn-danger ml-3">Atsijungti</a>
            </div>
        </div>
    </nav>
</div>