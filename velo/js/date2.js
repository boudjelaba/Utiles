const date1 = document.getElementById("date1");
const jour1 = document.getElementById("jour1");
const mois1 = document.getElementById("mois1");
const annee1 = document.getElementById("annee1");

const today1 = new Date();

const joursSem = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
const tousMois = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

date1.innerHTML = (today1.getDate()<10?"0":"") + today1.getDate();
jour1.innerHTML = joursSem[today1.getDay()];
mois1.innerHTML = tousMois[today1.getMonth()];
annee1.innerHTML = today1.getFullYear();