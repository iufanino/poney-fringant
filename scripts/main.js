/*function SubmitForm() {
    let rechercher
    document.querySelector('#form-recherche').addEventListener('submit', (ev) => {
        ev.preventDefault()
        rechercher(document.querySelector('#search').value)
    })
}
*/
// Paramétrage de notre appli front 
const backURL = 'backend/';



//interets();
/*function interets() {
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
}*/