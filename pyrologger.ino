// This #include statement was automatically added by the Particle IDE.
#include <SparkTime.h>

// This #include statement was automatically added by the Particle IDE.
#include <Adafruit_LEDBackpack_RK.h>

// This #include statement was automatically added by the Particle IDE.
#include <Adafruit_MAX31855.h>

#include "math.h"

Adafruit_7segment matrix = Adafruit_7segment();
UDP UDPClient;
SparkTime rtc;

unsigned long currentTime;
unsigned long lastTime = 0UL;
String timeStr;
int colon = false;


// initialize the publish counting loop
int publishInt = 0;
// how long to delay the update of the pyrometer readout on the LCD
int delayms = 500;
// how many seconds to wait before publishing pyro data to the seb service
int publishSecs = 30;
// initialize the cumulative temperature reading
double cumuTemp = 0;
// initialize the averge temperature reading
double avgTemp = 0;
// initialize the library with the numbers of the interface pins
//These are the pins that the pyrometer backpack are pinned from
int thermoCLK = A3;
int thermoCS = A2;
int thermoDO = A4;
// Initialize the Thermocouple
Adafruit_MAX31855 thermocouple(thermoCLK, thermoCS, thermoDO);

void setup() {
  matrix.begin(0x70);
  matrix.setBrightness(15);
  // fetch the current time from the SparkTime lib.
  // The intent of this is to display the current time to the LCD display.
  // in the current itteration it is not in use.
  rtc.begin(&UDPClient, "north-america.pool.ntp.org");
  rtc.setTimeZone(-6); // gmt offset update for your timezone.
  // TODO: implement Google Maps API to determine local timezone https://docs.particle.io/tutorials/integrations/google-maps/
}

void loop() {
    
    currentTime = rtc.now();
    int min = rtc.minute(currentTime);  
    int hour = rtc.hour(currentTime);
    int sec = rtc.second(currentTime);
//  matrix.print(hour * 100 + min, DEC);
//  colon = ! colon;
//  matrix.drawColon(colon);

    double c = thermocouple.readCelsius();
    double f = thermocouple.readFarenheit();
    //Add the temp to the cumulative temp
    cumuTemp += f;
    publishInt++;
    // if it's time to publish, go for it!
    if (publishInt > (1000/delayms)*publishSecs){
        avgTemp = cumuTemp / publishInt;
        Particle.publish("t", String::format("%.2f",avgTemp), NO_ACK);  // make sure to convert to const char * or String
        publishInt = 0;
        cumuTemp = 0;
    }
    
    // Check to make sure the pyroreading is a valid number to display, if not, show 0 on the LCD
    if (isnan(f)) 
    {
        matrix.print(0);
    } 
    else 
    {
        matrix.print(f);
    }
    matrix.writeDisplay();
    // Wait a tic to loop again.
    delay(delayms);
}
