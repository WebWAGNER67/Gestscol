const button_trombinoscope = document.querySelector('#button_trombinoscope');
const trombinoscope_list = document.querySelector('#trombinoscope_list');
const trombi_value = document.querySelector('#value');
const value_trombi = document.querySelector('#value_trombi');

const li = document.querySelectorAll('#trombinoscope_list li');


const classes = [
    {
        title: 'BUT MMI 1ère année',
        value: 'MMI1',
    },
    {
        title: 'BUT MMI 2ème année',
        value: 'MMI2',
    },
    {
        title: 'BUT MMI 3ème année',
        value: 'MMI3',
    },
    {
        title: 'BUT GEII 1ère année',
        value: 'GEII1',
    },
    {
        title: 'BUT GEII 2ème année',
        value: 'GEII2',
    },
    {
        title: 'BUT GEII 3ème année',
        value: 'GEII3',
    },
    {
        title: 'BUT QLIO 1ère année',
        value: 'QLIO1',
    },
    {
        title: 'BUT QLIO 2ème année',
        value: 'QLIO2',
    },
    {
        title: 'BUT QLIO 3ème année',
        value: 'QLIO3',
    }
];

let trombinoscope_actif = "";

const trombi_users = document.querySelectorAll('#users');
const trombi_list_users = document.querySelector('#trombi_list_users');
const trombinoscope_actif_texte = document.querySelector('#trombinoscope_actif_texte');

if (button_trombinoscope) {

    li.forEach(element => {
        element.addEventListener('click', (event) => {
            li.forEach(element => {
                element.classList.remove('active');
            });
            element.classList.add('active');
            value_trombi.innerHTML = element.querySelector('#value').innerHTML;
            trombinoscope_actif = element.querySelector('#value').innerHTML;
            button_trombinoscope.value = element.querySelector('.value').id;
            trombinoscope_list.classList.toggle('hidden');
            trombinoscope_list.classList.toggle('block');
            trombi_list_users.classList.add('hidden');
            trombi_list_users.classList.remove('block');
        });
    });

    button_trombinoscope.addEventListener('click', (event) => {
        trombinoscope_list.classList.toggle('hidden');
        trombinoscope_list.classList.toggle('block');
    });
}

if (trombi_users) {
    // pour tous les users du trombi si je clique dessus j'ai un label checkbox qui est caché et qui se coche automatiquement j'aimerais que quand c'est coché le user soit entouré d'un cadre rouge
    trombi_users.forEach(element => {
        element.addEventListener('click', (event) => {
            element.classList.toggle('border-red-500');
        });
    });
    const afficher_trombi_button = document.querySelector('#afficher_trombi_button');

    afficher_trombi_button.addEventListener('click', (event) => {
        trombinoscope_actif_texte.innerHTML = trombinoscope_actif;
        trombi_list_users.classList.toggle('hidden');
        trombi_list_users.classList.toggle('block');
    });

}

