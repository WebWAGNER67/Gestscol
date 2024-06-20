// MENU DE LA NAVBAR

// Sélectionnez tous les boutons de menu
const menuButtons = document.querySelector("#menu-button");
const menuMenu = document.querySelector("#menu");
const svgChevron = document.querySelector("#svg_chevron"); // Supposons que .svg-chevron soit une classe sur la flèche

// Ajoutez un gestionnaire d'événements à chaque bouton de menu
if (menuButtons) {
    menuButtons.addEventListener("click", (event) => {
        // Sélectionnez le bouton de menu cliqué
        menuButtons.classList.toggle("bg-black");
        menuButtons.classList.toggle("bg-opacity-20");

        // Sélectionnez la flèche associée au bouton cliqué

        // Basculez la classe 'hidden' pour afficher ou masquer le menu
        menuMenu.classList.toggle("hidden");
        menuMenu.classList.toggle("flex");

        // Ajoutez une rotation à la flèche
        svgChevron.classList.toggle("rotate-180");
    });
}

// afficher l'image sélectionnée lors de l'importation d'un fichier
const fileInput = document.querySelector("#input_file");
const previewImage = document.querySelector("#preview_image");

if (fileInput) {
    fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", (event) => {
            previewImage.src = event.target.result;
        });

        reader.readAsDataURL(file);
    });
}

const code_couleur = document.querySelector("#code_couleur");
const code_couleur_menu = document.querySelector("#code_couleur_menu");

if (code_couleur) {
    code_couleur.addEventListener("click", (event) => {
        if (code_couleur.innerHTML == "Afficher le code couleur") {
            code_couleur.innerHTML = "Masquer le code couleur";
        } else {
            code_couleur.innerHTML = "Afficher le code couleur";
        }
        code_couleur_menu.classList.toggle("hidden");
        code_couleur_menu.classList.toggle("grid");
    });
}

// PROFIL MENU

const profilButton = document.querySelector("#profil_button");
const profilMenu = document.querySelector("#profil_menu");
const profil_close = document.querySelector("#profil_close");

if (profilButton) {
    profilButton.addEventListener("click", (event) => {
        profilMenu.classList.toggle("hidden");
        profilMenu.classList.toggle("flex");
    });

    profil_close.addEventListener("click", (event) => {
        profilMenu.classList.toggle("hidden");
        profilMenu.classList.toggle("flex");
    });
}

// DARK MODE

const sunIcon = document.querySelector("#sun");
const moonIcon = document.querySelector("#moon");

const dark_svg = document.querySelectorAll("#dark_svg");
const light_svg = document.querySelectorAll("#light_svg");

const dark_logo = document.querySelector("#dark_logo");
const light_logo = document.querySelector("#light_logo");

const userTheme = localStorage.getItem("theme");
const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

console.log(userTheme);

const iconToggle = () => {
    moonIcon.classList.toggle("hidden");
    sunIcon.classList.toggle("hidden");
};

const themeCheck = () => {
    if (userTheme === "dark" || (!userTheme && systemTheme)) {
        document.documentElement.classList.add("dark");
        moonIcon.classList.add("hidden");
        if (window.innerWidth < 768) {
            light_svg.forEach((svg) => svg.classList.add("hidden"));
            dark_svg.forEach((svg) => svg.classList.remove("hidden"));
        }
        light_svg.forEach((svg) => svg.classList.add("hidden"));
        return;
    }
    sunIcon.classList.add("hidden");
    if (window.innerWidth < 768) {
        dark_svg.forEach((svg) => svg.classList.add("hidden"));
        light_svg.forEach((svg) => svg.classList.remove("hidden"));
    }
    dark_svg.forEach((svg) => svg.classList.add("hidden"));
};

const themeSwitch = () => {
    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme", "light");
        if (window.innerWidth < 768) {
            light_svg.forEach((svg) => svg.classList.remove("hidden"));
            dark_svg.forEach((svg) => svg.classList.add("hidden"));
        }
        console.log(localStorage.getItem("theme"));
        iconToggle();
        return;
    }
    document.documentElement.classList.add("dark");
    localStorage.setItem("theme", "dark");
    if (window.innerWidth < 768) {
        light_svg.forEach((svg) => svg.classList.add("hidden"));
        dark_svg.forEach((svg) => svg.classList.remove("hidden"));
    }
    console.log(localStorage.getItem("theme"));
    iconToggle();
};

sunIcon.addEventListener("click", themeSwitch);
moonIcon.addEventListener("click", themeSwitch);

themeCheck();

// MENU RESPONSIVE
const menu_open = document.querySelector("#menu_open");
const menu_close = document.querySelector("#menu_close");
const content = document.querySelector("#content");

const menu = document.querySelector("#menu_navbar");

if (menu_open) {
    menu_open.addEventListener("click", (event) => {
        menu.classList.remove("hidden");
        menu.classList.add("block");
        content.classList.add("hidden");
    });
    menu_close.addEventListener("click", (event) => {
        menu.classList.remove("block");
        menu.classList.add("hidden");
        content.classList.remove("hidden");
    });
}

// selectionne tous les elements qui ont pour id qui commence par "present_"
const presents = document.querySelectorAll('[id^="present_"]');

if (presents) {
    presents.forEach((present) => {
        present.addEventListener("click", (event) => {
            const id = present.id.split("_")[1];
            const label = document.querySelector('[for="present_' + id + '"]');
            // label.classList.toggle('bg-green-200');
            // label.classList.toggle('bg-red-200');
            // label.classList.toggle('text-green-950');
            // label.classList.toggle('text-red-950');
            // label.classList.toggle('ring-green-600');
            // label.classList.toggle('ring-red-600');
            // label.innerHTML = label.innerHTML == "Présent" ? "Absent" : "Présent";
            if (present.checked) {
                label.classList.add("bg-green-200");
                label.classList.add("text-green-950");
                label.classList.add("ring-green-600");
                label.classList.remove("bg-red-200");
                label.classList.remove("text-red-950");
                label.classList.remove("ring-red-600");
                label.innerHTML = "Présent";
            } else {
                label.classList.add("bg-red-200");
                label.classList.add("text-red-950");
                label.classList.add("ring-red-600");
                label.classList.remove("bg-green-200");
                label.classList.remove("text-green-950");
                label.classList.remove("ring-green-600");
                label.innerHTML = "Absent";
            }
            console.log(`${id} : ${present.checked}`);
        });
    });
}
