document.addEventListener('DOMContentLoaded', function () {
    loadRSS();
});

function loadRSS() {
    // var rssUrl = 'https://www.lemonde.fr/rss/une.xml';
    var rssUrl = 'https://www.lemonde.fr/rss/en_continu.xml';
    var feedContainer = document.getElementById('marqueeContainer');

    if (!feedContainer) {
        console.error('Le conteneur RSS est introuvable.');
        return;
    }

    fetch(`https://api.rss2json.com/v1/api.json?rss_url=${encodeURIComponent(rssUrl)}`)
        .then(response => response.json())
        .then(data => {
            var items = data.items;

            if (items.length > 0) {
                var ul = document.createElement('ul');

                items.forEach(item => {
                    var li = document.createElement('li');
                    var link = document.createElement('a');
                    link.textContent = item.title;
                    link.href = item.link;
                    li.appendChild(link);
                    ul.appendChild(li);
                });

                feedContainer.appendChild(ul);
            } else {
                feedContainer.textContent = 'Aucun article trouvé.';
            }
        })
        .catch(error => {
            console.error('Erreur de chargement du flux RSS', error);
        });
}
