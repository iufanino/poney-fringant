/*const backURL = 'backend/';

connexionAJAX();

function connexionAJAX() {
    console.log('coucou');
    document.querySelector('.form-connexion').addEventListener('submit', (ev) => {
        ev.preventDefault();
        const form = document.querySelector('.form-connexion'); 
       

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
                console.log(data);
            if(data.status === 'ok') {
                //document.querySelector('.statusok.message').classList.add('visible');
                //document.querySelector('.statuserror.message').classList.remove('visible');
                //document.querySelector('.statusok.message').innerText = data.description
                setTimeout(() => {
                    window.location = 'profil.html';
                }, 200);
            } /*else {
                document.querySelector('.statuserror.message').classList.add('visible');
                document.querySelector('.statusok.message').classList.remove('visible');
                document.querySelector('.statuserror.message').innerText = data.description
            }*/
    /*    } )
        .catch(error => {
            console.error('Connexion échouée', error)
            //document.querySelector('.statuserror.message').classList.add('visible');
            //document.querySelector('.statusok.message').classList.remove('visible');
        })
    })
}*/