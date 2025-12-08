// Icônes et descriptions météo
const descriptions = {
  0: "Clair ☀️",
  1: "Plutôt clair 🌤️",
  2: "Partiellement nuageux ⛅",
  3: "Très nuageux ☁️",
  45: "Brouillard 🌫️",
  48: "Brouillard givrant 🌫️❄️",
  51: "Bruine légère 🌦️",
  53: "Bruine 🌧️",
  55: "Bruine forte 🌧️",
  56: "Bruine verglaçante 🌨️❄️",
  57: "Bruine verglaçante forte ❄️💨",
  61: "Pluie légère 🌧️",
  63: "Pluie 🌧️",
  65: "Pluie forte 🌧️💦",
  66: "Pluie verglaçante ❄️🌧️",
  67: "Forte pluie verglaçante 💦❄️",
  71: "Neige légère ❄️",
  73: "Neige ❄️",
  75: "Neige forte ❄️💨",
  77: "Grésil ❄️",
  80: "Averses légères 🌦️",
  81: "Averses 🌧️",
  82: "Averses fortes 🌧️💨",
  85: "Averses de neige ❄️",
  86: "Fortes averses de neige ❄️💨",
  95: "Orages ⛈️",
  96: "Orages avec grêle ⛈️❄️",
  99: "Orages violents ⛈️❄️💨"
};
const icons = {
  0: "https://img.icons8.com/fluency/96/sun.png",
  1: "https://img.icons8.com/fluency/96/partly-cloudy-day.png",
  2: "https://img.icons8.com/fluency/96/clouds.png",
  3: "https://img.icons8.com/fluency/96/cloud.png",
  45: "https://img.icons8.com/fluency/96/fog-day.png",
  48: "https://img.icons8.com/fluency/96/fog-night.png",
  51: "https://img.icons8.com/fluency/96/drizzle.png",
  53: "https://img.icons8.com/fluency/96/heavy-drizzle.png",
  55: "https://img.icons8.com/fluency/96/very-heavy-drizzle.png",
  56: "https://img.icons8.com/fluency/96/freezing-drizzle.png",
  57: "https://img.icons8.com/fluency/96/heavy-freezing-drizzle.png",
  61: "https://img.icons8.com/fluency/96/rain.png",
  63: "https://img.icons8.com/fluency/96/heavy-rain.png",
  65: "https://img.icons8.com/fluency/96/very-heavy-rain.png",
  66: "https://img.icons8.com/fluency/96/freezing-rain.png",
  67: "https://img.icons8.com/fluency/96/heavy-freezing-rain.png",
  71: "https://img.icons8.com/fluency/96/snow.png",
  73: "https://img.icons8.com/fluency/96/heavy-snow.png",
  75: "https://img.icons8.com/fluency/96/very-heavy-snow.png",
  77: "https://img.icons8.com/fluency/96/snowflake.png",
  80: "https://img.icons8.com/fluency/96/lightning.png",
  81: "https://img.icons8.com/fluency/96/heavy-rain.png",
  82: "https://img.icons8.com/fluency/96/very-heavy-rain.png",
  85: "https://img.icons8.com/fluency/96/snow-showers.png",
  86: "https://img.icons8.com/fluency/96/heavy-snow-showers.png",
  95: "https://img.icons8.com/fluency/96/storm.png",
  96: "https://img.icons8.com/fluency/96/hail.png",
  99: "https://img.icons8.com/fluency/96/heavy-hail.png",
};

function getFallbackIcon(weathercode) {
  const canvas = document.createElement('canvas');
  canvas.width = 96;
  canvas.height = 96;
  const ctx = canvas.getContext('2d');
  ctx.fillStyle = '#3498db';
  ctx.fillRect(0, 0, 96, 96);
  ctx.font = 'bold 48px Arial';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillStyle = 'white';
  ctx.fillText(weathercode, 48, 48);
  return canvas.toDataURL();
}

// Retourne classe de fond selon météo et heure
function getWeatherClass(weathercode, hour) {
  const day = hour >= 6 && hour < 20;
  if ([0,1].includes(weathercode)) return day ? "weather-clear-day" : "weather-clear-night";
  if ([2,3,45,48].includes(weathercode)) return "weather-clouds";
  if ([51,61,63].includes(weathercode)) return "weather-rain";
  if ([71].includes(weathercode)) return "weather-snow";
  if ([95].includes(weathercode)) return "weather-storm";
  return "weather-clear-day";
}

// Formater l'heure locale d'une timezone
function formatLocalTime(timezone) {
  const now = new Date();
  return now.toLocaleTimeString('fr-FR', {
    hour: '2-digit',
    minute: '2-digit',
    timeZone: timezone
  });
}

// Affichage météo + prévisions
async function afficherMeteo(lat, lon, cityName="Ville") {
  const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true&daily=temperature_2m_max,temperature_2m_min,weathercode&timezone=auto&forecast_days=4`;
  try {
    document.getElementById("weather-description").textContent = "Chargement...";
    const res = await fetch(url);
    if (!res.ok) throw new Error("Erreur réseau");
    const data = await res.json();
    const meteo = data.current_weather;
    const hour = parseInt(meteo.time.split("T")[1].slice(0,2));
    const card = document.querySelector(".weather-card");
    card.className = "weather-card " + getWeatherClass(meteo.weathercode, hour);
    const localTime = formatLocalTime(data.timezone);
    document.getElementById("time").textContent = localTime;
    document.getElementById("city-name").textContent = cityName;
    document.getElementById("temp").textContent = meteo.temperature;
    document.getElementById("wind").textContent = meteo.windspeed + " km/h";
    // Prévisions 4 jours
    const daily = data.daily;
    const forecastEl = document.getElementById("forecast");
    forecastEl.innerHTML = "";
    for (let i = 0; i < Math.min(daily.time.length, 4); i++) {
      const day = new Date(daily.time[i]);
      const dayName = day.toLocaleDateString('fr-FR', { weekday: 'long' });
      const code = daily.weathercode[i];
      const iconUrl = icons[code] || getFallbackIcon(code);
      const max = Math.round(daily.temperature_2m_max[i]);
      const min = Math.round(daily.temperature_2m_min[i]);
      const dayDiv = document.createElement("div");
      dayDiv.className = "forecast-day";
      dayDiv.innerHTML = `
        <div>${dayName}</div>
        <img src="${iconUrl}" alt="Météo ${code}" onerror="this.src='${getFallbackIcon(code)}'">
        <div class="forecast-temp">${max}° / ${min}°</div>
      `;
      forecastEl.appendChild(dayDiv);
    }
    document.getElementById("weather-description").textContent = descriptions[meteo.weathercode] || "Indisponible";
    const currentCode = meteo.weathercode;
    document.getElementById("weather-icon").src = icons[currentCode] || getFallbackIcon(currentCode);
    afficherGraphique(daily);
  } catch (err) {
    console.error("Erreur météo :", err);
  }
}

// Recherche via Nom
async function rechercherVille(city) {
  const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(city)}`;
  const res = await fetch(url);
  const data = await res.json();
  if (data.length > 0) {
    const { lat, lon, display_name } = data[0];
    afficherMeteo(lat, lon, display_name);
  } else alert("Ville non trouvée !");
}

// Événement recherche
document.getElementById("search-btn").addEventListener("click", () => {
  const city = document.getElementById("city-input").value.trim();
  if (city) rechercherVille(city);
});

// Affichage par défaut
afficherMeteo(48.8566, 2.3522, "Paris");
