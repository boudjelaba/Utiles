# Arduino :

VS-Code Installer compilateur

___

https://www.youtube.com/watch?v=gyKTt5_K-ak

https://www.youtube.com/watch?v=y-i96kqT53A

https://winlibs.com/

https://www.youtube.com/watch?v=uFydSHo4LcM

https://www.youtube.com/watch?v=LamjAFnybo0


CodeBlocks Debug

___

https://www.youtube.com/watch?v=rVVKudK_kAU

https://www.youtube.com/watch?v=d-3aAMiynVI

https://www.youtube.com/watch?v=7WXupDjZIzo
___

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

```cpp
 #include <stdio.h>
#include <stdlib.h>
int main()
{
  /* Déclarations : Noms des fichiers et pointeurs de référence */
  char ANCIEN[]  = "Fichier_Exo1.txt";
  char NOUVEAU[] = "Fichier_Exo3.txt";
  FILE *INFILE, *OUTFILE;
  char NOM[30], PRENOM[30];
  int NUMERO;

  char NOM_NOUV[30], PRE_NOUV[30];
  int NUM_NOUV;
  /* Ouverture de l'ancien fichier en lecture */
  INFILE = fopen(ANCIEN, "r");
   if (!INFILE)
     {
      printf("\aERREUR: Impossible d'ouvrir le fichier: %s.\n", ANCIEN);
      exit(-1);
     }
  /* Ouverture du nouveau fichier en écriture */
  OUTFILE = fopen(NOUVEAU, "w");
   if (!OUTFILE)
     {
      printf("\aERREUR: Impossible d'ouvrir le fichier: %s.\n", NOUVEAU);
      exit(-1);
     }

  /* Saisie de l'enregistrement à ajouter */
  printf("Enregistrement à ajouter : \n");
  printf("Numéro : ");
  scanf("%d",&NUM_NOUV);     
  printf("Nom    : ");
  scanf("%s",NOM_NOUV);
  printf("Prénom : ");
  scanf("%s",PRE_NOUV);
  /* Copie des enregistrements de l'ancien fichier */
  while (!feof(INFILE))
    {
     fscanf (INFILE, "%d\t%s\t%s\n", &NUMERO, NOM, PRENOM);
     fprintf(OUTFILE, "%d\t%s\t%s\n", NUMERO, NOM, PRENOM);
    }
  /* Ecriture du nouvel enregistrement à la fin du fichier */
  fprintf(OUTFILE,"%d\t%s\t%s\n",NUM_NOUV,NOM_NOUV,PRE_NOUV);
  /* Fermeture des fichiers */
  fclose(OUTFILE);
  fclose(INFILE);
   return 0;
} 
```
