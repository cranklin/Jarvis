#include <SPI.h>
#include <Ethernet.h>

int ledPin = 2;

// Enter a MAC address and IP address for your controller below.
// The IP address will be dependent on your local network:
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192,168,1, 177);

// Initialize the Ethernet server library
// with the IP address and port you want to use 
// (port 80 is default for HTTP):
EthernetServer server(80);

void setup()
{
  pinMode(ledPin, OUTPUT);
  // start the Ethernet connection and the server:
  Ethernet.begin(mac, ip);
  server.begin();
}

void loop()
{
  String readstring = "";
  // listen for incoming clients
  EthernetClient client = server.available();
  if (client) {
    // an http request ends with a blank line
    boolean currentLineIsBlank = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        readstring += c;
        if (c == '\n' && currentLineIsBlank && readstring.indexOf("dev=garage")>0){
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();
          if (readstring.indexOf("cmd=open")>0){
            client.print("opened garage");
          }
          else{
            client.print("closed garage");
          }
          readstring = "";
          break;
        }
        else if (c == '\n' && currentLineIsBlank && readstring.indexOf("dev=tv")>0){
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();
          if (readstring.indexOf("cmd=on")>0){
            client.print("turned on tv");
          }
          else{
            client.print("turned off tv");
          }
          readstring = "";
          break;
        }
        else if (c == '\n' && currentLineIsBlank && readstring.indexOf("dev=light")>0){
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();
          if (readstring.indexOf("cmd=on")>0){
            switchlight(1);
            client.print("turned on light");
          }
          else{
            switchlight(0);
            client.print("turned off light");
          }
          readstring = "";
          break;
        }
        else if (c == '\n' && currentLineIsBlank && readstring.indexOf("dev=temperature")>0){
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();
          client.print(gettemperature());
          client.print(" degrees fahrenheit");
          
          readstring = "";
          break;
        }
        else if (c == '\n' && currentLineIsBlank) {
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();

          // output the value of each analog input pin
          for (int analogChannel = 0; analogChannel < 6; analogChannel++) {
            client.print("analog input ");
            client.print(analogChannel);
            client.print(" is ");
            client.print(analogRead(analogChannel));
            client.println("<br />");
          }
          readstring = "";
          break;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        } 
        else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
    }
    // give the web browser time to receive the data
    delay(1);
    // close the connection:
    client.stop();
  }
}

int switchlight(int onoroff){
  if(onoroff==1){
    digitalWrite(ledPin, HIGH);
  }
  else{
    digitalWrite(ledPin, LOW);
  }
  return onoroff;
}

float gettemperature(void){
  float temperature = analogRead(0) * .004882814;
  temperature = (((temperature - .5) * 100) * 1.8) + 32;
  return temperature;
}
