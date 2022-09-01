# Arduino :

```c
// Declaration des variables

int code_resistance = 0;
int code_condoA3 = 0;
int code_condoA5 = 0;

float tension_resistance = 0;
float tension_condoA3 = 0;
float tension_condoA5 = 0; 

unsigned long MS;

void setup() {

pinMode(A1,INPUT); // Tension aux bornes de la résistance R = 220 Ohm
pinMode(A3, INPUT); // Tension aux bornes du condensateur A3 relié à la R = 5 kOhm;
pinMode(A5, INPUT); // Tension aux bornes du condensateur A5 relié à la R = 10 kOhm;

pinMode(2, OUTPUT); // Sortie de 5V aux bornes du circuit  R = 10 kOhm /  C = 100 µF
pinMode(7, OUTPUT); // Sortie de 5V aux bornes du circuit  R = 5 kOhm / C = 100 µF
pinMode(12, OUTPUT); // Sortie de 5V aux bornes du circuit interrupteur et R = 220 Ohm.

digitalWrite(2,LOW); // Pas de Tension 5V aux bornes du circuit  R = 10 kOhm /  C = 100 µF
digitalWrite(7,LOW); // Pas de Tension 5V aux bornes du circuit  R =  5 kOhm / C = 100 µF
digitalWrite(12,HIGH);  // Tension 5 V appliquée au circuit interrupteur et R = 220 Ohm.

Serial.begin(9600);
Serial.println("temps  (ms),              tension  CONDO  A3  (en V),         tension CONDO  A5  (en  V) ");


}
void loop() {

code_resistance=analogRead(A1);
code_condoA3=analogRead(A3);
code_condoA5=analogRead(A5);

tension_resistance=(code_resistance*5.0)/1023;
tension_condoA3=(code_condoA3*5.0)/1023;
tension_condoA5=(code_condoA5*5.0)/1023;

MS = millis();

if (tension_resistance>0.1) {

  digitalWrite(2,HIGH); // Mise sous tension du circuit R = 10 kOhm /  C = 100 µF
  digitalWrite(7,HIGH); // Mise sous tension du circuit R =  5 kOhm /  C = 100 µF

  Serial.print(MS);
  Serial.print("               ,               ");

  Serial.print(tension_condoA3);
  Serial.print("               ,               ");
  
  Serial.print(tension_condoA5);
  Serial.println();

  delay(20);
   
}
}
```

