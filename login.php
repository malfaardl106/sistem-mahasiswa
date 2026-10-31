<?php
require "koneksi.php";
require "bahasa.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([":username" => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $t['login']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 400px;">
    <div class="card p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="m-0"><?php echo $t['login']; ?></h4>
            <div>
                <a href="login.php?lang=id" class="btn btn-sm btn-outline-secondary">ID</a>
                <a href="login.php?lang=en" class="btn btn-sm btn-outline-secondary">EN</a>
            </div>
        </div>
        <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label><?php echo $t['username']; ?></label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label><?php echo $t['password']; ?></label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100"><?php echo $t['btn_login']; ?></button>
        </form>
    </div>
</div>
</body>
</html>