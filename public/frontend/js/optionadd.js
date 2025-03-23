// let menu = document.getElementById("menu");
// let Generale = document.getElementById("Generale");
// let Specialiste = document.getElementById("Specialiste");
// let maternite = document.getElementById("maternite");
// let laboratoire = document.getElementById("laboratoire");
// let pharmacie = document.getElementById("pharmacie");

// menu.addEventListener("change", function () {
//     if (menu.value === "Generale") {
//         Generale.style.display = "block";
//         Specialiste.style.display = "none";
//         maternite.style.display = "none";
//         laboratoire.style.display = "none";
//         pharmacie.style.display = "none";
//     } else if (menu.value === "Specialiste") {
//         Generale.style.display = "none";
//         Specialiste.style.display = "block";
//         maternite.style.display = "none";
//         laboratoire.style.display = "none";
//         pharmacie.style.display = "none";
//     } else if (menu.value === "maternite") {
//         Generale.style.display = "none";
//         Specialiste.style.display = "none";
//         maternite.style.display = "block";
//         laboratoire.style.display = "none";
//         pharmacie.style.display = "none";
//     } else if (menu.value === "laboratoire") {
//         Generale.style.display = "none";
//         Specialiste.style.display = "none";
//         maternite.style.display = "none";
//         laboratoire.style.display = "block";
//         pharmacie.style.display = "none";
//     } else if (menu.value === "pharmacie") {
//         Generale.style.display = "none";
//         Specialiste.style.display = "none";
//         maternite.style.display = "none";
//         laboratoire.style.display = "none";
//         pharmacie.style.display = "block";
//     }

//     const form = document.getElementById("reservation-form");
//     form.addEventListener("submit", function (event) {
//         event.preventDefault();
//         const role = document.getElementById("role").value;
//         const departement = document.getElementById("departement").value;

//         console.log(`role : ${role}
// departement : ${departement}
// `);
//     });
// });
// document.getElementById("departement").addEventListener("change", function () {
//     var departement = this.value;
//     var roleSelect = document.getElementById("role");

//     roleSelect.innerHTML = "";


//     if (departement === 'Medecine Gerale') {
//         roleSelect.innerHTML = '<option value = " Medecin Generaliste">Medecin Generaliste </option>';
//     } else if (departement === 'Medecine Specialisee') {
//         roleSelect.innerHTML = '<option value = "Ophtamologue">Ophtamologue</option><option value="Cardiologue">Cardiologue</option><option value="Cardiologue">Cardiologue</option><option value="Gynecologue">Gynecologue</option><option value="Cardiologue">Cardiologue</option><option value="Chirurgien">Chirurgien</option><option value="Neurologue">Neurologue </option><option value="Pediatre">Pédiatre</option><option value="Obstetricien">Obstétricien</option><option value="Urologue">Urologue</option><option value="Dentiste">Dentiste</option>';
//     } else if (departement === 'Maternite') {
//         roleSelect.innerHTML = '<option value = "Sage Femme">Sage-Femme</option>';
//     } else if (departement ==='Laboratoire') {
//         roleSelect.innerHTML = '<option value = "Laborantin">Technicien de Laboratoire</option>';
//     } else if (departement === 'Caisse') {
//         roleSelect.innerHTML = '<option value = "Caisse">Caisse-Phcie</option>';
//     }

// });


document.getElementById("departement").addEventListener("change", function () {
    var departement = this.value;
    var roleSelect = document.getElementById("role");

    roleSelect.innerHTML = "";
    roleSelect.style.display = 'none';

    var roles = {
        'Medecine Generalisée' : [
            { value: 'Medecin Generaliste', text:'Medecin Generaliste'}
        ],
        'Admin' : [
            { value : 'Admin', text: 'Admin'}
        ],
        'Medecine Specialisée' : [
            { value: 'Ophtamologue', text:'Ophtamologue'},
            { value: 'Cardiologue', text:'Cardiologue'},
            { value: 'Gynecologue', text:'Gynecologue'},
            { value: 'Chirurgien', text:'Chirurgien'},
            { value: 'Neurologue', text:'Neurologue'},
            { value: 'Pediatre', text:'Pédiatre'},
            { value: 'Obstetricien', text:'Obstétricien'},
            { value: 'Urologue', text:'Urologue'},
            { value: 'Dentiste', text:'Dentiste'},
            ],
        'Caisse' :[
            { value: 'Caisse', text: 'Caisse/Phcie'},
        ],
        'Maternite': [
            { value: 'Sage Femme', text: 'Sage-Femme'},
        ],
        'Laboratoire' : [
            { value: 'Laborantin', text: 'Technicien Laboratoire'},
        ],
    };

    if (roles[departement]) {
        roles[departement].forEach(function (role) {
            var option = document.createElement("option");
            option.value = role.value;
            option.text = role.text;
            roleSelect.appendChild(option);
    });
    roleSelect.style.display = 'block';
    }
});

function updateCities() {
    const departments = {
        Alibori: [
            "Kandi",
            "Malanville",
            "Banikoara",
            "Gogounou",
            "Ségbana",
            "Karimama",
        ],
        Atacora: [
            "Natitingou",
            "Boukoumbé",
            "Tanguiéta",
            "Toucountouna",
            "Kouandé",
            "Péhunco",
            "Cobly",
            "Matéri",
        ],
        Atlantique: [
            "Ouidah",
            "Allada",
            "Abomey-Calavi",
            "Tori-Bossito",
            "Kpomassè",
            "Zè",
            "Toffo",
        ],
        Borgou: [
            "Parakou",
            "N’Dali",
            "Bembèrèkè",
            "Tchaourou",
            "Kalalé",
            "Sinendé",
            "Pèrèrè",
            "Nikki",
        ],
        Collines: [
            "Dassa-Zoumè",
            "Savalou",
            "Glazoué",
            "Bantè",
            "Ouèssè",
            "Savè",
        ],
        Couffo: [
            "Aplahoué",
            "Djakotomey",
            "Dogbo",
            "Klouékanmè",
            "Lalo",
            "Toviklin",
        ],
        Donga: ["Djougou", "Bassila", "Copargo", "Ouaké"],
        Littoral: ["Cotonou"],
        Mono: ["Lokossa", "Athiémé", "Bopa", "Comè", "Grand-Popo", "Houéyogbé"],
        Ouémé: [
            "Porto-Novo",
            "Adjarra",
            "Avrankou",
            "Akpro-Missérété",
            "Adjohoun",
            "Dangbo",
            "Sèmè-Podji",
            "Bonou",
        ],
        Plateau: ["Pobè", "Kétou", "Ifangni", "Adja-Ouèrè", "Sakété"],
        Zou: [
            "Abomey",
            "Bohicon",
            "Djidja",
            "Zogbodomey",
            "Agbangnizoun",
            "Covè",
            "Ouinhi",
            "Za-Kpota",
            "Zagnanado",
        ],
    };

    const departmentSelect = document.getElementById("departement");
    const citySelect = document.getElementById("villes");

    const selectedDepartment = departmentSelect.value;
    const cities = departments[selectedDepartment] || [];

    // Clear previous cities
    citySelect.innerHTML = "";

    // Populate the cities dropdown
    cities.forEach(function (villes) {
        const option = document.createElement("option");
        option.value = villes;
        option.text = villes;
        citySelect.add(option);
    });
}

