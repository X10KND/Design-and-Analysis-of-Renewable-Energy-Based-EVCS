#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Arduino_JSON.h>

const char * ssid = "WIFI_SSID";
const char * password = "WIFI_PASSWORD";

const char * serverName = "SERVER_ADDRESS";
String serverPath;

String sensorReadings;
String rxData;

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);
    Serial.println("Connecting");
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("");
    Serial.print("Connected to WiFi network with IP Address: ");
    Serial.println(WiFi.localIP());

    pinMode(LED_BUILTIN, OUTPUT);
    digitalWrite(LED_BUILTIN, LOW);
}

void loop() {

    //Check if data is sent from Arduino Mega
    //If data is received, transmit data to the server
    if (Serial.available()) {
        digitalWrite(LED_BUILTIN, HIGH);
        rxData = Serial.readString();
        Serial.println(rxData);
        httpSend(serverName, rxData);
        digitalWrite(LED_BUILTIN, LOW);
    }
}

void httpSend(String sName, String trx) {

    WiFiClient client;
    HTTPClient http;

    serverPath = sName + "?" + trx;
    Serial.println(serverPath);
    http.begin(client, serverPath.c_str());

    int httpResponseCode = http.GET();

    if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload);
    }
    else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
    }
    
    http.end();
}
