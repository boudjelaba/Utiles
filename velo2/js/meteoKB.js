async function getWeather() {
  try {

      const response = await axios.get('https://api.openweathermap.org/data/2.5/forecast', {
          params: {
              //q: 'Rodez',
              //lon: '2.48',
              //lat: '44.4',
              lon: '2.57',
              lat: '44.35',
              appid: '54a57bc234ad752a4f59e59cd372201d',
              units: 'metric',
              lang: 'fr'
          },
      });
      const currentTemperature2 = response.data.list[0].main.temp;
      const currentTemperature = currentTemperature2.toFixed(1); //++++
      // document.querySelector('.weather-temp').textContent = currentTemperature + 'ºC';//++++
      document.querySelector('.weather-temp .value').textContent = currentTemperature + 'ºC'; //+--------
      //document.querySelector('.weather-temp').textContent = Math.round(currentTemperature) + 'ºC';

      /*****************************************/
      //const sunrise_time = response.data.city.sunrise + response.data.city.timezone;
      //const sunset_time = response.data.city.sunset + response.data.city.timezone;

      const sunrise_time = new Date(response.data.city.sunrise*1000);
      const sunset_time = new Date(response.data.city.sunset*1000);

      //.toLocaleTimeString("en-US", { hour12: false, timeStyle: 'short' })
      //document.querySelector('.timezone').innerHTML = response.data.city.timezone;
      document.querySelector('.sunrise').innerHTML = sunrise_time.toLocaleTimeString("en-US", { hour12: false, timeStyle: 'short' });
      document.querySelector('.sunset').innerHTML = sunset_time.toLocaleTimeString("en-US", { hour12: false, timeStyle: 'short' });
      /*****************************************/

      const forecastData = response.data.list;
//const date-dayname = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
      const dailyForecast = {};
      forecastData.forEach((data) => {
          const day = new Date(data.dt * 1000).toLocaleDateString('fr-FR', { weekday: 'long' });
          if (!dailyForecast[day]) {
              dailyForecast[day] = {
                  minTemp: data.main.temp_min,
                  maxTemp: data.main.temp_max,
                  description: data.weather[0].description,
                  humidity: data.main.humidity,
                  windSpeed: data.wind.speed,
                  windDeg: data.wind.deg,//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
                  icon: data.weather[0].icon,


              };
          } else {
              dailyForecast[day].minTemp = Math.min(dailyForecast[day].minTemp, data.main.temp_min);
              dailyForecast[day].maxTemp = Math.max(dailyForecast[day].maxTemp, data.main.temp_max);
          }
      });

      document.querySelector('.date-dayname').textContent = new Date().toLocaleDateString('fr-FR', { weekday: 'long' });

      const date = new Date().toUTCString();
      const extractedDateTime = date.slice(5, 16);
      //document.querySelector('.date-day').textContent = extractedDateTime.toLocaleString('fr-FR');

      /*+++++++++++*/
      let date1 = new Date();

      let dateLocale = date1.toLocaleString('fr-FR',{year: 'numeric',
      	month: 'long',day: 'numeric'});
      document.querySelector('.date-day').innerHTML = dateLocale;
      /*+++++++++++*/

      const currentWeatherIconCode = dailyForecast[new Date().toLocaleDateString('fr-FR', { weekday: 'long' })].icon;
      const weatherIconElement = document.querySelector('.weather-icon .value');

      weatherIconElement.innerHTML = getWeatherIcon(currentWeatherIconCode);


      document.querySelector('.location').textContent = response.data.city.name;
      document.querySelector('.weather-desc .value').textContent = dailyForecast[new Date().toLocaleDateString('fr-FR', { weekday: 'long' })].description.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

      document.querySelector('.humidity .value').textContent = dailyForecast[new Date().toLocaleDateString('fr-FR', { weekday: 'long' })].humidity + ' %';
      document.querySelector('.wind .value').textContent = Math.round(dailyForecast[new Date().toLocaleDateString('fr-FR', { weekday: 'long' })].windSpeed*3.6) + ' km/h';

      /*+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+*/
      /*+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+*/
      function degToCompass(num) {
        var val = Math.floor((num / 22.5) + 0.5);
        var arr = ["↓ N", "NNE", "↙ NE", "ENE", "← E", "ESE", "↖ SE", "SSE", "↑ S", "SSO", "↗ SO", "OSO", "→ O", "ONO", "↘ NO", "NNO"];
        return arr[(val % 16)];
      }
      const xx = dailyForecast[new Date().toLocaleDateString('fr-FR', { weekday: 'long' })].windDeg;
      //let xx1 = Number(xx) ;
      let yy = degToCompass(xx);
      document.querySelector('.direction .value').textContent = yy;
      /*+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+*/
      /*+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+*/

      const dayElements = document.querySelectorAll('.day-name');
      const tempElements = document.querySelectorAll('.day-temp');
      const iconElements = document.querySelectorAll('.day-icon');

      dayElements.forEach((dayElement, index) => {
          const day = Object.keys(dailyForecast)[index];
          const data = dailyForecast[day];
          dayElement.textContent = day;
          tempElements[index].textContent = `${Math.round(data.minTemp)}º / ${Math.round(data.maxTemp)}º`;
          iconElements[index].innerHTML = getWeatherIcon(data.icon);
      });

  } catch (error) {
      console.error('Une erreur s\'est produite lors de la récupération des données :', error.message);
  }
}

function getWeatherIcon(iconCode) {
  const iconBaseUrl = 'https://openweathermap.org/img/wn/';
  const iconSize = '@2x.png';
  return `<img src="${iconBaseUrl}${iconCode}${iconSize}" alt="Weather Icon">`;
}

document.addEventListener("DOMContentLoaded", function () {
  getWeather();
  setInterval(getWeather, 900000);
});