<?php

declare(strict_types=1);

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$english = is_string($requestPath) && preg_match('~^/en(?:/|$)~', $requestPath) === 1;
$language = $english ? 'en' : 'fr';
$title = $english ? 'Website under maintenance' : 'Site en maintenance';
$heading = $english ? 'We are finalizing our website.' : 'Nous finalisons notre site web.';
$message = $english
    ? 'Our website is undergoing final work that requires maintenance. This may take some time.'
    : 'Notre site est en cours de finalisation. Ces travaux nécessitent une maintenance dont la durée peut se prolonger.';
$invitation = $english ? 'Please visit us again later.' : 'Nous vous invitons à revenir plus tard.';
$thanks = $english ? 'Thank you for your patience and understanding.' : 'Merci de votre patience et de votre compréhension.';

http_response_code(503);
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store, max-age=0');
header('Retry-After: 86400');

?>
<!doctype html>
<html lang="<?= $language ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | Groupe Babia Guinée</title>
    <link rel="icon" href="/assets/images/favicon.png" sizes="32x32">
    <style>
      @font-face {
        font-family: Montserrat;
        src: url('/assets/fonts/Montserrat-Regular.woff2') format('woff2');
        font-weight: 400;
        font-display: swap;
      }
      @font-face {
        font-family: Montserrat;
        src: url('/assets/fonts/Montserrat-SemiBold.woff2') format('woff2');
        font-weight: 600;
        font-display: swap;
      }
      * { box-sizing: border-box; }
      body {
        margin: 0;
        min-height: 100vh;
        min-height: 100svh;
        display: grid;
        place-items: center;
        padding: 32px 20px;
        background: #f2f5ef;
        color: #193b2d;
        font-family: Montserrat, Arial, sans-serif;
        line-height: 1.7;
      }
      main {
        width: 100%;
        max-width: 740px;
        padding: clamp(28px, 6vw, 64px);
        border: 1px solid #dce5db;
        border-top: 4px solid #b48c41;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 24px 70px #193b2d0d;
        text-align: center;
      }
      .logo { display: block; margin: 0 auto 16px; width: 88px; height: 88px; }
      .brand { margin: 0 0 32px; font-weight: 600; font-size: 15px; }
      .status {
        display: inline-block;
        margin: 0 0 20px;
        padding: 7px 16px;
        border-radius: 24px;
        background: #edf3e9;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
      }
      h1 { margin: 0 0 24px; font-size: clamp(28px, 5vw, 42px); line-height: 1.2; font-weight: 600; }
      .message { margin: 0 0 24px; color: #526258; font-size: 16px; }
      .invitation { margin: 0 0 8px; font-size: 16px; font-weight: 600; }
      .thanks { margin: 0; color: #526258; font-size: 14px; }
      nav { margin-top: 32px; padding-top: 24px; border-top: 1px solid #e4eae2; font-size: 13px; }
      nav a { display: inline-block; padding: 8px 12px; color: #193b2d; text-underline-offset: 4px; }
      nav a[aria-current] { font-weight: 600; }
      a:focus-visible { outline: 2px solid #193b2d; outline-offset: 3px; border-radius: 3px; }
    </style>
  </head>
  <body>
    <main>
      <img class="logo" src="/assets/images/logo.webp" alt="" width="88" height="88">
      <p class="brand">Groupe Babia Guinée</p>
      <p class="status"><?= $title ?></p>
      <h1><?= $heading ?></h1>
      <p class="message"><?= $message ?></p>
      <p class="invitation"><?= $invitation ?></p>
      <p class="thanks"><?= $thanks ?></p>
      <nav aria-label="<?= $english ? 'Language' : 'Langue' ?>">
        <a href="/" lang="fr" hreflang="fr"<?= !$english ? ' aria-current="page"' : '' ?>>Français</a>
        <a href="/en/" lang="en" hreflang="en"<?= $english ? ' aria-current="page"' : '' ?>>English</a>
      </nav>
    </main>
  </body>
</html>
