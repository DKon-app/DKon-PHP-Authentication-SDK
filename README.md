

# DKon PHP Authentication SDK

This SDK simplifies user authentication for your web applications using the DKon API. It provides a straightforward way to log in users with their credentials and handle the response effectively.

## Features

- User authentication using the DKon API.
- Easy integration into your existing PHP applications.
- Clear success and error messages based on the authentication outcome.

## Installation

1. **Download the SDK**:
   Create a directory in your PHP project, e.g., `dkon-auth-sdk`, and place the `DKonAuth.php` file inside it.

2. **Include the SDK in Your Project**:
   In your PHP script, include the SDK at the top:
   ```php
   require_once 'path/to/dkon-auth-sdk/DKonAuth.php'; // Adjust the path as needed
   ```

## Usage

### Initialization

Create an instance of the `DKonAuth` class with your client ID:

```php
$clientId = '1302'; // Your client ID
$auth = new DKonAuth($clientId);
```

### User Login

Handle user login by calling the `login` method with the username and password:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $auth->login($username, $password);

    if ($result['success']) {
        session_start();
        $_SESSION['accessToken'] = $result['accessToken'];
        $_SESSION['accountId'] = $result['accountId'];

        // Redirect to your desired page
        header('Location: dialogs.html');
        exit();
    } else {
        echo '<div class="error-message">' . htmlspecialchars($result['message']) . '</div>';
    }
}
```

### HTML Form Example

Use the following HTML form to collect user credentials:

```html
<form id="login-form" class="form" method="POST" action="path/to/your/login.php">
    <input type="hidden" name="clientId" value="1302">
    <input type="text" id="username" name="username" placeholder="Username" required>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <button type="submit" class="button">Login</button>
</form>
```

## Requirements

- PHP 7.0 or higher
- cURL extension enabled

## License

https://Dkon.app/dev

## Contributions

Feel free to fork the repository and submit a pull request if you have improvements or new features to add!

## Support

For any issues or questions, please create an issue in the repository or contact the author.


