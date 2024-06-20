<body style="padding: 2rem; margin: 0; font-family: 'Arial'; color: #000; display:flex; justify-content:center; align-items:center;">

    <div style="text-align:left; font-size: 1.5rem; background: rgba(255, 255, 255, 0.1); border: 1px solid #fff; cursor: default; border-radius: 1rem; backdrop-filter: blur(8px); padding: 2rem;">

        <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 1rem;">Bonjour <span style="color: #3498db;">{{ $prenom }} {{ $nom }}</span>,</h1>

        <p>Ce mail vous est transmis dans le cadre d'un projet de la <span style="font-weight: bold; color: #3498db;">SAE 501</span> du parcours Développement web. L'objectif ce de projet est de développer une application de <span style="font-weight: bold; color: #3498db;">gestion et de suivi de la présence des étudiants</span> aux activités pédagogiques. Afin de pouvoir commencer à tester un premier prototype, <span style="font-weight: bold; color: #3498db;">un compte a été créé pour chaque étudiant de BUT MMI 3ème année</span> avec les identifiants ci-dessous.</p>

        <p>Vous avez été ajouté à la liste des <span style="font-weight: bold; color: #3498db;">{{ $promo }}</span> dans le parcours <span style="font-weight: bold; color: #3498db;">{{ $parcours }}</span> et dans le groupe <span style="font-weight: bold; color: #3498db;">{{ $group }}</span></p>

        <p>Voici votre identifiant : <span style="font-weight: bold; color: #3498db;">Adresse mail unistra</span></p>

        <p>Voici votre mot de passe : <span style="font-weight: bold; color: #3498db;">{{ $password }}</span></p>

        <a href="https://gestscol.mydevosux.fr/profile/edit" target="_blank" style="padding: 0.5rem 1rem; background: #3498db; border-radius: 1rem; text-decoration: none; color: #000;">Changer mon mot de passe</a>

    </div>
</body>
