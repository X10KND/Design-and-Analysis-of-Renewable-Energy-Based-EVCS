#include <Wire.h>
#include <DS3231.h>
#include <PZEM004Tv30.h>

PZEM004Tv30 pzem(11, 12);

//RTClib myRTC;

#define output_V A0
#define output_I A1

#define PV_V A2
#define PV_I A3

#define inv_input 26
#define inv_output 32
#define grid_output 30
#define charger_output 28
#define export_output 34

#define charging_LED 38
#define loadshedding_LED 40
#define grid_LED 42
#define backup_LED 44
#define export_LED 46

int c = 0;
int prevc = 0;

int l = 0;
bool prevl = -1;

int in = 0;

float v_out;
float i_out;
float p_out;

float pv_v_out;
float pv_i_out;
float pv_p_out;

float grid_v;
float grid_i;
float grid_p;
float grid_e;
float grid_f;
float grid_pf;

int debounce = 5000;
int lastTrigger = 0;
bool switchTrig = false;

String transmit = "";

void setup() {

    Serial.begin(115200);
    Serial1.begin(115200);
    
    Wire.begin();

    delay(500);
    
    pinMode(inv_input, OUTPUT);
    pinMode(inv_output, OUTPUT);
    pinMode(grid_output, OUTPUT);
    pinMode(charger_output, OUTPUT);
    pinMode(export_output, OUTPUT);

    pinMode(charging_LED, OUTPUT);
    pinMode(loadshedding_LED, OUTPUT);
    pinMode(grid_LED, OUTPUT);
    pinMode(backup_LED, OUTPUT);
    pinMode(export_LED, OUTPUT);

    pinMode(output_V, INPUT);
    pinMode(output_I, INPUT);

    pinMode(PV_V, INPUT);
    pinMode(PV_I, INPUT);

    digitalWrite(charging_LED, HIGH);
    digitalWrite(loadshedding_LED, HIGH);
    digitalWrite(grid_LED, HIGH);
    digitalWrite(backup_LED, HIGH);
    digitalWrite(export_LED, HIGH);

    pinMode(2, INPUT);
    pinMode(3, INPUT);
    
    full_shutdown();
    
}

void loop() {
    
    v_out = ((analogRead(output_V) * 5) / 1024.0) * 5; 
    i_out = ((analogRead(output_I) * 5.0 / 1024.0) - 2.5) / 0.100;
    p_out = v_out * i_out;


    pv_v_out = ((analogRead(PV_V) * 5) / 1024.0) * 5; 
    pv_i_out = ((analogRead(PV_I) * 5.0 / 1024.0) - 2.5) / 0.100;
    pv_p_out = pv_v_out * pv_i_out;

    grid_v = pzem.voltage();
    grid_i = pzem.current();
    grid_p = pzem.power();
    grid_e = pzem.energy();
    grid_f = pzem.frequency();
    grid_pf = pzem.pf();

    if(isnan(grid_v)) {
        grid_v = 0;
    }

    if(isnan(grid_i)) {
        grid_i = 0;
    }

    if(isnan(grid_p)) {
        grid_p = 0;
    }

    if(isnan(grid_e)) {
        grid_e = 0;
    }

    if(isnan(grid_f)) {
        grid_f = 0;
    }

    if(isnan(grid_pf)) {
        grid_pf = 0;
    }
    
    transmit = "";
    
    transmit += "outv=";
    transmit += String(v_out, DEC);
    transmit += "&";
    
    transmit += "outi=";
    transmit += String(i_out, DEC);
    transmit += "&";
    
    transmit += "pvoutv=";
    transmit += String(pv_v_out, DEC);
    transmit += "&";
    
    transmit += "pvouti=";
    transmit += String(pv_i_out, DEC);
    transmit += "&";

    transmit += "acv=";
    transmit += String(grid_v, DEC);
    transmit += "&";

    transmit += "aci=";
    transmit += String(grid_i, DEC);
    transmit += "&";

    transmit += "acp=";
    transmit += String(grid_p, DEC);
    transmit += "&";

    transmit += "ace=";
    transmit += String(grid_e, DEC);
    transmit += "&";

    transmit += "acf=";
    transmit += String(grid_f, DEC);
    transmit += "&";

    transmit += "acpf=";
    transmit += String(grid_pf, DEC);
    
    //Serial.write(transmit);
    Serial1.println(transmit);
    
    delay(1000);

    //Override using switch
    if(digitalRead(2) == HIGH) {
        Serial.println("Switch ON");
        c = 1;
        prevc = 1;
    }
    else if(digitalRead(3) == HIGH) {
        Serial.println("Switch OFF");
        c = 2;
        prevc = 2;
    }

    //l = 0 means load shedding
    //l = 1 means grid power is available
    
    if(grid_v > 100) {
        l = 1;
    }
    else{
        l = 0;
    }
    
    if(prevl != l) {
        
        c = prevc;
        prevl = l;
        
        if(l == 0) {
            digitalWrite(loadshedding_LED, LOW);
        }
        if(l == 1) {
            digitalWrite(loadshedding_LED, HIGH);
        }
    }
    
    
    if(c == 1) {
        c = 0;
        digitalWrite(charging_LED, LOW);
        if(l == 0) {
            digitalWrite(grid_LED, HIGH);
            digitalWrite(backup_LED, LOW);
            backup_mode();
            //digitalWrite(export_LED, LOW);
            //export_mode();
        }
        else {
            digitalWrite(backup_LED, HIGH);
            digitalWrite(export_LED, HIGH);
            digitalWrite(grid_LED, LOW);
            grid_mode();
        }
    }
    if(c == 2) {
        c = 0;
        digitalWrite(charging_LED, HIGH);
        digitalWrite(grid_LED, HIGH);
        digitalWrite(backup_LED, HIGH);
        digitalWrite(export_LED, HIGH);
        full_shutdown();
    }
}

void switchON() {

    if(millis() - lastTrigger > debounce) {
        lastTrigger = millis();
        switchTrig = !switchTrig;

        if(switchTrig) {
            Serial.println("Switch ON");
            c = 1;
            prevc = 1;
        }
        else {
            Serial.println("Switch OFF");
            c = 2;
            prevc = 2;
        }
    }
}
void switchOFF() {

    if(millis() - lastTrigger > debounce) {
        lastTrigger = millis();
        Serial.println("Switch OFF");
        c = 2;
        prevc = 2;
    }
}

void full_shutdown() {

    Serial.println("Shutdown");
    
    charger_output_OFF();
    delay(100);

    grid_output_OFF();
    delay(100);

    inverter_output_OFF();
    delay(100);
    
    inverter_input_OFF();
    delay(100);

    export_OFF();

    Serial.println("Shutdown Complete");
}

void backup_mode() {

    Serial.println("Backup");
    
    grid_output_OFF();
    delay(1000);

    charger_output_ON();
    delay(1000);

    inverter_output_ON();
    delay(1000);

    inverter_input_ON();

    Serial.println("Backup ON");
    
}

void grid_mode() {

    Serial.println("Grid");
    
    inverter_output_OFF();
    delay(1000);
    
    inverter_input_OFF();
    delay(1000);

    charger_output_ON();
    delay(1000);

    grid_output_ON();

    Serial.println("Grid ON");
}

void export_mode() {

    Serial.println("Export");
    
    grid_output_OFF();
    delay(1000);

    charger_output_OFF();
    delay(1000);

    inverter_output_OFF();
    delay(1000);

    inverter_input_ON();
    delay(1000);

    export_ON();

    Serial.println("Export ON");

}

void export_ON() {
    digitalWrite(export_output, LOW);
}

void export_OFF() {
    digitalWrite(export_output, HIGH);
}

void inverter_input_ON() {
    digitalWrite(inv_input, LOW);
}
void inverter_input_OFF() {
    digitalWrite(inv_input, HIGH);
}

void inverter_output_ON() {
    digitalWrite(inv_output, LOW);
}
void inverter_output_OFF() {
    digitalWrite(inv_output, HIGH);
}

void grid_output_ON() {
    digitalWrite(grid_output, LOW);
}
void grid_output_OFF() {
    digitalWrite(grid_output, HIGH);
}

void charger_output_ON() {
    digitalWrite(charger_output, LOW);
}
void charger_output_OFF() {
    digitalWrite(charger_output, HIGH);
}
