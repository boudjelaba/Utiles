# Utiles :

**script complet et automatisé** à utiliser juste après une installation de Raspberry Pi OS pour transformer le Raspberry Pi en un **serveur LAMP avec phpMyAdmin prêt à l’emploi**, incluant :

* Apache
* PHP
* MariaDB (avec création d’un utilisateur sécurisé)
* phpMyAdmin
* Test PHP ↔ MariaDB
* Configuration de base

---

## Comment utiliser ce script

### 1. Créer un fichier script sur le Raspberry Pi :

```bash
nano setup-lamp.sh
```

### 2. Coller le script suivant dans le fichier :

```bash
#!/bin/bash

# =========================
# Paramètres à configurer
# =========================
DB_NAME="db_ciel"
DB_USER="user_ciel"
DB_PASS="salle_215"

echo "==== Mise à jour du système ===="
sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y

echo "==== Installation d'Apache ===="
sudo apt install apache2 -y
sudo systemctl enable apache2

echo "==== Installation de PHP ===="
sudo apt install php libapache2-mod-php php-mysql php-cli php-xml php-curl php-zip php-mbstring -y
sudo systemctl restart apache2

echo "==== Installation de MariaDB ===="
sudo apt install mariadb-server -y
sudo systemctl enable mariadb

echo "==== Sécurisation de MariaDB ===="
sudo mysql -e "DELETE FROM mysql.user WHERE User='';"
sudo mysql -e "DROP DATABASE IF EXISTS test;"
sudo mysql -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';"
sudo mysql -e "FLUSH PRIVILEGES;"

echo "==== Création base + utilisateur MariaDB ===="
sudo mariadb <<EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF

echo "==== Création table test ===="
sudo mariadb $DB_NAME <<EOF
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);
INSERT IGNORE INTO utilisateurs (nom, email) VALUES
('Charles Carnus', 'charles@carnus.fr'),
('NomA PrénomA', 'prenoma@carnus.fr'),
('NomB PrénomB', 'prenomb@carnus.fr');
EOF

echo "==== Création fichier de test PHP ===="
cat <<PHP | sudo tee /var/www/html/testdb.php > /dev/null
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

\$conn = new mysqli("localhost", "$DB_USER", "$DB_PASS", "$DB_NAME");

if (\$conn->connect_error) {
    die("Erreur de connexion : " . \$conn->connect_error);
}

\$result = \$conn->query("SELECT nom, email FROM utilisateurs");
if (\$result->num_rows > 0) {
    echo "<h2>Utilisateurs :</h2><ul>";
    while (\$row = \$result->fetch_assoc()) {
        echo "<li><strong>" . \$row["nom"] . "</strong> - " . \$row["email"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucun utilisateur trouvé.";
}
\$conn->close();
?>
PHP

echo "==== Installation de phpMyAdmin ===="
sudo apt install phpmyadmin -y
sudo phpenmod mbstring
sudo systemctl restart apache2

echo "==== Installation terminée ===="
echo "Accède à : http://$(hostname -I | awk '{print $1}')/testdb.php"
echo "Et à phpMyAdmin : http://$(hostname -I | awk '{print $1}')/phpmyadmin"
```

### 3. Enregistrer et quitter

* Appuie sur `CTRL + O` pour enregistrer
* Puis `CTRL + X` pour quitter

### 4. Rendre le script exécutable :

```bash
chmod +x setup-lamp.sh
```

### 5. Lancer l’installation :

```bash
./setup-lamp.sh
```

> L’installation prendra quelques minutes. À la fin, il affichera les liens d’accès pour `testdb.php` et `phpMyAdmin`.

---

## Notes post-installation

* Supprimer le fichier `testdb.php` une fois qu'on a vérifié que ça fonctionne :

  ```bash
  sudo rm /var/www/html/testdb.php
  ```

* Modifier les variables au début du script (`DB_NAME`, `DB_USER`, `DB_PASS`) si on veut personnaliser l’environnement.

---
