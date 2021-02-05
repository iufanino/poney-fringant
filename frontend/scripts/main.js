/*function SubmitForm() {
    let rechercher
    document.querySelector('#form-recherche').addEventListener('submit', (ev) => {
        ev.preventDefault()
        rechercher(document.querySelector('#search').value)
    })
}

// Paramétrage de notre appli front 
const URL = 'http://back.poney-fringant.local:9595/';

// Une fois la page HTML chargée, 
// on veut surcharger le submit du formulaire
// pour le faire en AJAX
inscriptionAJAX();

function inscriptionAJAX() {
    document.querySelector('.form-inscription').addEventListener('submit', (ev) => {
        const form = document.querySelector('.form-inscription'); 
        // On ne veut pas que le navigateur fasse le post lui même et quitte la page
        ev.preventDefault();

        // On fabrique notre "form data", les champs de form à envoyer :
        const data = new URLSearchParams();
        for (const pair of new FormData(form)) {
            data.append(pair[0], pair[1]);
        }

        fetch(URL + 'inscription.php', {
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(data => console.log('INSCRIPTION REUSSIE', data))
            .catch(error => console.error('INSCRIPTION ECHOUEE', error))
    })
}*/