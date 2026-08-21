<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/helpers.php';
require_once dirname(__DIR__) . '/env.php';

load_env_file(project_path('.env'));

function admin_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_name('babia_admin');
    session_start();
}

function admin_credentials_configured(): bool
{
    return (string) env_value('ADMIN_USERNAME', '') !== ''
        && (string) env_value('ADMIN_PASSWORD_HASH', '') !== '';
}

function admin_is_authenticated(): bool
{
    admin_session_start();

    return isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] === true;
}

function admin_attempt_login(string $username, string $password): bool
{
    if (!admin_credentials_configured()) {
        return false;
    }

    $expectedUser = (string) env_value('ADMIN_USERNAME', '');
    $expectedHash = (string) env_value('ADMIN_PASSWORD_HASH', '');

    if (!hash_equals($expectedUser, $username)) {
        return false;
    }

    if (!password_verify($password, $expectedHash)) {
        return false;
    }

    admin_session_start();
    session_regenerate_id(true);
    $_SESSION['admin_authenticated'] = true;
    $_SESSION['admin_username'] = $username;

    return true;
}

function admin_logout(): void
{
    admin_session_start();
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}

function admin_require_auth(): void
{
    if (admin_is_authenticated()) {
        return;
    }

    header('Location: login.php');
    exit;
}

function admin_csrf_token(): string
{
    admin_session_start();

    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function admin_csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(admin_csrf_token()) . '">';
}

function admin_verify_csrf(): bool
{
    admin_session_start();

    $expected = $_SESSION['csrf_token'] ?? '';
    $actual = $_POST['csrf_token'] ?? '';

    return is_string($expected)
        && is_string($actual)
        && $expected !== ''
        && hash_equals($expected, $actual);
}
