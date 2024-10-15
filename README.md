# GPS :

```python
import time
import board
import busio
 
import adafruit_gps
 
import serial
uart = serial.Serial("/dev/ttyUSB0", baudrate=9600, timeout=10)
 
gps.send_command(b"PMTK314,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0")
 
 
gps.send_command(b"PMTK220,1000")
 
last_print = time.monotonic()
while True:
 
   gps.update()
 
   current = time.monotonic()
   if current - last_print >= 1.0:
       last_print = current
       if not gps.has_fix:
 
_fix:
 
           print("Waiting for fix...")
           continue
 
       print("=" * 40) 
       print(
           "Fix timestamp: {}/{}/{} {:02}:{:02}:{:02}".format(
               gps.timestamp_utc.tm_mon, 
               gps.timestamp_utc.tm_mday, 
               gps.timestamp_utc.tm_year, 
               gps.timestamp_utc.tm_hour,
               gps.timestamp_utc.tm_min,
               gps.timestamp_utc.tm_sec,
           )
       )
       print("Latitude: {0:.6f} degrees".format(gps.latitude))
       print("Longitude: {0:.6f} degrees".format(gps.longitude))
       print("Fix quality: {}".format(gps.fix_quality))
 
if gps.satellites is not None:
           print("# satellites: {}".format(gps.satellites))
       if gps.altitude_m is not None:
           print("Altitude: {} meters".format(gps.altitude_m))
       if gps.speed_knots is not None:
           print("Speed: {} knots".format(gps.speed_knots))
       if gps.track_angle_deg is not None:
           print("Track angle: {} degrees".format(gps.track_angle_deg))
       if gps.horizontal_dilution is not None:
           print("Horizontal dilution: {}".format(gps.horizontal_dilution))
       if gps.height_geoid is not None:
           print("Height geoid: {} meters".format(gps.height_geoid))

```



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



## Serveur 

```python
import socket
serveur = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
serveur.bind(('', 60000))  # Écoute sur le port 60000
serveur.listen(5)
while True:
    client, infosClient = serveur.accept()
    print("\t Client connecté. Adresse " + infosClient[0])
    requete = client.recv(255)  # Reçoit 255 octets (à changer pour recevoir plus de données)
    print(requete.decode("utf-8"))
    reponse = "Bonjour, je suis le serveur \n"
    client.send(reponse.encode("utf-8"))
    print("\t Connexion fermée")
    client.close()
serveur.close()
```

## Client

```python
import socket
adresseIP = "127.0.0.1" # Le poste local (local host)
port = 60000 # Se connecter sur le port 60000
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client.connect((adresseIP, port))
print("Client connecté au serveur \n")
client.send("Bonjour, je suis le client \n".encode("utf-8"))
reponse = client.recv(255)
print(reponse.decode("utf-8"))
print("Connexion fermée")
client.close()
```
