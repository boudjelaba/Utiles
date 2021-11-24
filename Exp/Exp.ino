#define entreeAnalogique 1  // Entrée analogique
int led = 8;                // La LED est branchée à la broche 8
const int L1 = 2;           // Broche 2 de la carte se nomme maintenant : L1


void setup() {
  Serial.begin(9600) ;      // Initialisation de la connexion série avec le moniteur
  pinMode(led , OUTPUT) ;   // Configure la broche 8 de la carte Arduino en sortie
  pinMode(L1, OUTPUT);      // L1 est une broche de sortie

}

void loop() {
  int valeurLue = analogRead(entreeAnalogique);       // Lecture de la valeur numérique (0-1023)
  float tensionLue = map(valeurLue, 0, 1023, 0, 5);   // Conversion de la valeur lue en une tension en Volts
  Serial.print(”Tension : ”) ;  // Afficher le mot Tension
  Serial.print(tensionLue) ;    // Afficher la valeur de tensionLue
  Serial.println(”Volts”) ;     // Afficher le mot Volts, retour à la ligne

  
  digitalWrite(led, HIGH);  // Met la sortie au niveau logique HIGH, c.à.d à 5V
  delay (2000) ;            // Pause de 2s
  digitalWrite(led, LOW);   // Met la sortie au niveau logique LOW (Eteint la LED)
  delay (2000) ;            // Pause de 2s
  delayMicroseconds(10);    // Pause de 2µs

  digitalWrite(L1, HIGH);   // Allumer L1 
  delay 21000) ;            // Pause de 2s 
  digitalWrite(L1, LOW);    // Eteindre L1 
  delay (2000) ;            // Pause de 2s

  int etatL1 = digitalRead(L1) ; // Lecture de l'état de de L1

  Serial.println( millis()); // Affiche la valeur du temps puis retour à la ligne
}
