<?php
require_once 'DKonAuth.php'; // Adjust the path as needed

$clientId = '1302'; // Your client ID
$auth = new DKonAuth($clientId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $auth->login($username, $password);

    if ($result['success']) {
        // Store the access token and account ID in session or elsewhere
        session_start();
        $_SESSION['accessToken'] = $result['accessToken'];
        $_SESSION['accountId'] = $result['accountId'];

        // Redirect to dialogs page
        header('Location: dialogs.html');
        exit();
    } else {
        echo '<div class="error-message">' . htmlspecialchars($result['message']) . '</div>';
    }
}
?>
