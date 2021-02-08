/*function SubmitForm() {
    let rechercher
    document.querySelector('#form-recherche').addEventListener('submit', (ev) => {
        ev.preventDefault()
        rechercher(document.querySelector('#search').value)
    })
}*/

// Paramétrage de notre appli front 
const backURL = 'http://back.poney-fringant.local/';

// Une fois la page HTML chargée, 
// on veut surcharger le submit du formulaire
// pour le faire en AJAX
//inscriptionAJAX();

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

        fetch(backURL + 'inscription.php', {
            method: 'POST',
            credentials: 'include',
            body: data
        })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'ok') {
                    document.querySelector('.statusok.message').classList.add('visible');
                    document.querySelector('.statuserror.message').classList.remove('visible');
                    setTimeout(() => {
                        window.location = 'interets.html';
                    }, 200);
                } else {
                    document.querySelector('.statuserror.message').classList.add('visible');
                    document.querySelector('.statusok.message').classList.remove('visible');
                    document.querySelector('.statuserror.message').innerText = data.description

                    // On peut vérifier ici un ou plusieurs code d'erreur (1062 = clé dupliquée)
                    if (data.errorInfo[1] === 1062) {
                        document.querySelector('.statuserror.message').innerText = 'Ce pseudo, numéro ou mail est déjà utilisé';
                    }
                    else {
                        document.querySelector('.statuterror.message').innerText = 'Une erreur est survenue. Déso';
                    }
                }
            } )
            .catch(error => {
                console.error('Inscription échouée', error)
                document.querySelector('.statusok.message').classList.add('visible');
                document.querySelector('.statuserror.message').classList.remove('visible');
            })
    })
}

connexionAJAX();

function connexionAJAX() {
    document.querySelector('.form-connexion').addEventListener('submit', (ev) => {
        const form = document.querySelector('.form-connexion'); 
        ev.preventDefault();
console.log(ev)
        // On fabrique notre "form data", les champs de form à envoyer :
        const data = new URLSearchParams();
        for (const pair of new FormData(form)) {
            data.append(pair[0], pair[1]);
        }

        fetch(backURL + 'connexion.php', {
            method: 'POST',
            credentials: "include",
            body: data
        })

            .then(response => response.json())
            .then(data => {
            if(data.status === 'ok') {
                document.querySelector('.statusok.message').classList.add('visible');
                document.querySelector('.statuserror.message').classList.remove('visible');
                document.querySelector('.statusok.message').innerText = data.description
                setTimeout(() => {
                    window.location = 'profil.html';
                }, 200);
            } else {
                document.querySelector('.statuserror.message').classList.add('visible');
                document.querySelector('.statusok.message').classList.remove('visible');
                document.querySelector('.statuserror.message').innerText = data.description
            }
        } )
        .catch(error => {
            console.error('Connexion échouée', error)
            document.querySelector('.statuserror.message').classList.add('visible');
            document.querySelector('.statusok.message').classList.remove('visible');
        })
    })
}

//interets();
function interets() {
    document.querySelector('.from-checkbox').addEventListener('submit', (ev) => {
        // On ne veut pas que le navigateur fasse le post lui même et quitte la page
        ev.preventDefault();

        // On fabrique notre "form data", les champs de form à envoyer :
        const data = new URLSearchParams();
        for (const pair of new FormData(form)) {
            data.append(pair[0], pair[1]);
        }

        fetch(backURL + 'interets.php', {
            method: 'POST',
            credentials: 'include',
            body: data
        })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'ok') {
                    console.log('Mise à jour réussie', error)
                }
                else {
                    console.log('Mise à jour échouée', error)
                }
            })
            .catch(error => {
                console.error('Mise à jour échouée', error)
            })
    })
}