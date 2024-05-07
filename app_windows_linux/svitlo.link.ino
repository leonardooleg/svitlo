#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>

//Параметри вашого Wi-Fi
const char* ssid = "Мій_Вайфай";
const char* password = "123456789";
const char* serverUrl = "ВАШЕ_ПОСИЛАННЯ"; //Замініть на ваше посилання типу https://svitlo.link/api/1234567891011

void setup() {
  Serial.begin(115200);

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }

  Serial.println("Connected to WiFi");
}

void loop() {
  // Make an HTTPS request
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClientSecure client;

    // Disable certificate verification
    client.setInsecure();

    // Connect to the server
    if (client.connect("leonardooleg.online", 443)) {
      Serial.println("Connected to server");

      // Make a GET request
      client.print("GET /get.php?ip=home HTTP/1.1\r\n");
      client.print("Host: leonardooleg.online\r\n");
      client.print("Connection: close\r\n\r\n");

      Serial.println("Request sent");

      // Read the response
      while (client.connected()) {
        // Read response line by line
        String line = client.readStringUntil('\n');
        Serial.println(line);
      }

      Serial.println("Request complete");

      // Close the connection
      client.stop();

      // Wait for 180 seconds (180000 milliseconds) after the request
      delay(180000);
    } else {
      Serial.println("Connection to server failed");
    }
  } else {
    Serial.println("WiFi not connected");
  }
}
