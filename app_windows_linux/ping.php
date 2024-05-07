<?php
function curlGetHttps($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if ($error) {
        return "Error: " . $error;
    } else {
        return $response;
    }
}
// Приклад визову функції
$url = "http://svitlo/api/1713478951512"; // Замінити на своє посилання URL для потрібного будинку
$response = curlGetHttps($url);
if (is_string($response)) {
    echo "Response:\n" . $response;
} else {
    echo "Error: Could not get response.";
}

?>
