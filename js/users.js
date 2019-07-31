function checkRegistration(form) // Vérifie seulement l'adresse mail et le mot de passe.
{
    if(form.reg_password.value !== "" && form.reg_password.value === form.reg_verifPassword.value) {
        if(form.reg_password.value.length < 6) {
            alert("Erreur: Le mot de passe doit contenir au moins six caractères");
            form.reg_password.focus();
            form.reg_password.className += " uk-form-danger uk-alert-danger";
            return false;
        }
        if(form.reg_password.value === form.reg_email.value) {
            alert("Erreur: Le mot de passe doit être différent de l'adresse mail");
            form.reg_password.focus();
            form.reg_password.className += " uk-form-danger uk-alert-danger";
            return false;
        }
        re = /[0-9]/;
        if(!re.test(form.reg_password.value)) {
            alert("Erreur: Le mot de passe doit contenir au moins un chiffre (0-9)");
            form.reg_password.focus();
            form.reg_password.className += " uk-form-danger uk-alert-danger";
            return false;
        }
        re = /[a-z]/;
        if(!re.test(form.reg_password.value)) {
            alert("Erreur : Le mot de passe doit contenir au moins un caractère minuscule");
            form.reg_password.focus();
            form.reg_password.className += " uk-form-danger uk-alert-danger";
            return false;
        }
        re = /[A-Z]/;
        if(!re.test(form.reg_password.value)) {
            alert("Erreur: Le mot de passe doit contenir au moins un caractère majuscule");
            form.reg_password.focus();
            form.reg_password.className += " uk-form-danger uk-alert-danger";
            return false;
        }
    } else {
        alert("Erreur: Vous devez remplir le mot de passe et sa vérification.");
        form.reg_password.focus();
        form.reg_password.className += " uk-form-danger uk-alert-danger";

        return false;
    }
    return true;
}

function checkConnection(form)
{
    // Password checking function
    if(form.con_password.value !== "") {
        if(form.con_password.value.length < 6) {
            form.con_password.focus();
            form.con_password.className += " uk-form-danger";
            let getAnswer = document.getElementById("getAnswer");
            getAnswer.className += " uk-text-danger uk-alert-danger";
            getAnswer.innerHTML = "Le mot de passe doit contenir au moins six caractères";
            return false;
        }
        re = /[0-9]/;
        if(!re.test(form.con_password.value)) {
            form.con_password.focus();
            form.con_password.className += " uk-form-danger";
            let getAnswer = document.getElementById("getAnswer");
            getAnswer.className += " uk-text-danger";
            getAnswer.innerHTML= "Le mot de passe doit contenir au moins un chiffre (0-9)";
            return false;
        }
        re = /[a-z]/;
        if(!re.test(form.con_password.value)) {
            form.con_password.focus();
            form.con_password.className += " uk-form-danger";
            let getAnswer = document.getElementById("getAnswer");
            getAnswer.className += " uk-text-danger uk-alert-danger";
            getAnswer.innerHTML= "Le mot de passe doit contenir au moins un caractère minuscule";

            return false;
        }
        re = /[A-Z]/;
        if(!re.test(form.con_password.value)) {
            form.con_password.focus();
            form.con_password.className += " uk-form-danger";
            let getAnswer = document.getElementById("getAnswer");
            getAnswer.className += " uk-text-danger uk-alert-danger";
            getAnswer.innerHTML= "Le mot de passe doit contenir au moins un caractère majuscule";
            return false;
        }
    } else {
        form.con_password.focus();
        form.con_password.className += " uk-form-danger";
        let getAnswer = document.getElementById("getAnswer");
        getAnswer.className += " uk-text-danger uk-alert-danger";
        getAnswer.innerHTML = "Vous devez remplir le mot de passe";
        return false;
    }
    return true;
}

function editFirstName(){
    let firstName = document.getElementById("pr_firstName");
    firstName.onclick = null;
    firstName.innerHTML += '<form><input type="text" id="pr_firstName"><br><button onclick="sendEdit(pr_firstName)">Envoyer</button></form>'
}
function editLastName(){
    let lastName = document.getElementById("pr_lastName");
    lastName.onclick = null;
    lastName.innerHTML += '<form><input type="text" id="pr_lastName"><br><button onclick="sendEdit(pr_lastName)">Envoyer</button></form>'
}
function editAddress(){
    let address = document.getElementById("pr_address");
    address.onclick = null;
    address.innerHTML += '<form><input type="text" id="pr_address"><br><button onclick="sendEdit(pr_address)">Envoyer</button></form>'
}
function editEmail(){
    let email = document.getElementById("pr_email");
    email.onclick = null;
    email.innerHTML += '<form><input type="email" id="pr_email"><br><button onclick="sendEdit(pr_email)">Envoyer</button></form>'
}
function editPostalCode(){
    let postalCode = document.getElementById("pr_postalCode");
    postalCode.onclick = null;
    postalCode.innerHTML += '<form><input type="text" id="pr_postalCode"><br><button onclick="sendEdit(pr_postalCode)">Envoyer</button></form>'
}
function editCity(){
    let city = document.getElementById("pr_city");
    city.onclick = null;
    city.innerHTML += '<form><input type="text" id="pr_city"><br><button onclick="sendEdit(pr_city)">Envoyer</button></form>'
}
function editBirthday(){
    let birthday = document.getElementById("pr_birthday");
    birthday.onclick = null;
    birthday.innerHTML += '<form><input type="date" id="pr_birthday"><br><button onclick="sendEdit(pr_birthday)">Envoyer</button></form>'
}
function editPhone(){
    let phone = document.getElementById("pr_phone");
    phone.onclick = null;
    phone.innerHTML += '<form action=""><input type="text"><br><button type="button" onclick="sendEdit(pr_phone)">Envoyer</button></form>'
}


function sendEdit(toEdit){
    let getChildren = toEdit.parentNode.parentNode.children;
    let origin = getChildren[0].innerText;
    let newVal = toEdit.value;
    let call = toEdit.id;
    let table = call.split("_");
    editUser(origin, newVal, table[1]);
}

function editUser(origin, newValue, column){
    let functionName = 'editUser';
    if(origin !== null && newValue !== null && column !== null) {
        let request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState === 4 && request.status === 200) {
                location.reload();
            }
        };
        request.open('POST', 'php/classes/User.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(`origin=${origin}&newValue=${newValue}&functionName=${functionName}&column=${column}`);

    }
    else {
        console.log('Une erreur est survenue.');
    }
}


function userEditForm(usr){
    /*
    Objectif :
        Génerer un formulaire qui récupère et modifies chaque information de l'utilisateur sur lequel on clique
        L'afficher de la manière la plus agréable possible pour l'utilisateur, sois en ajoutant une ligne dans le tableau qui irai juste en dessous
        Sois un générant le formulaire tout à droite.
     */

    // Création du tableau
    let idUser = usr.getAttribute("id");
    let userTable = document.createElement("tr");
    userTable.setAttribute('id', idUser + '_form');
    //////////////////////////////////////////////
    let firstName = document.createElement("td");
    let lastName = document.createElement("td");
    let username = document.createElement("td");
    let email = document.createElement("td");
    let phone = document.createElement("td");
    let submit = document.createElement("td");


    // Création du formulaire et des inputs
    let formElement = document.createElement('form');
    formElement.setAttribute('method','post');
    formElement.setAttribute('id', 'editUser');
    formElement.setAttribute('action','edit/editUser.php'); // TODO : Créer une méthode editUser

    let firstNameField = document.createElement('input');
    firstNameField.setAttribute('type','text');
    firstNameField.setAttribute('name','firstNameField');
    firstNameField.setAttribute('class', 'uk-input uk-grid-small uk-width-1-1');
    firstNameField.setAttribute('form', 'editUser');
    firstName.appendChild(firstNameField);

    let lastNameField = document.createElement('input');
    lastNameField.setAttribute('type','text');
    lastNameField.setAttribute('name','lastNameField');
    lastNameField.setAttribute('class', 'uk-input uk-grid-small uk-width-1-1');
    lastNameField.setAttribute('form', 'editUser');
    lastName.appendChild(lastNameField);

    let usernameField = document.createElement('input');
    usernameField.setAttribute('type','text');
    usernameField.setAttribute('name','usernameField');
    usernameField.setAttribute('class', 'uk-input uk-grid-small uk-width-1-1');
    usernameField.setAttribute('form', 'editUser');
    username.appendChild(usernameField);


    let emailField = document.createElement('input');
    emailField.setAttribute('type','text');
    emailField.setAttribute('name','emailField');
    emailField.setAttribute('class', 'uk-input uk-grid-small uk-width-1-1');
    emailField.setAttribute('form', 'editUser');
    email.appendChild(emailField);

    let phoneField = document.createElement('input');
    phoneField.setAttribute('type','text');
    phoneField.setAttribute('name','phoneField');
    phoneField.setAttribute('class', 'uk-input uk-grid-small uk-width-1-1');
    phoneField.setAttribute('form', 'editUser');
    phone.appendChild(phoneField);

    let submitField = document.createElement('input');
    submitField.setAttribute('class', 'uk-button uk-button-default');
    submitField.setAttribute('type', 'submit');
    submitField.setAttribute('form', 'editUser');
    submitField.innerHTML = "Submit";
    submit.appendChild(submitField);

    $( userTable ).insertAfter( usr );

    userTable.appendChild(formElement);
    userTable.appendChild(firstName);
    userTable.appendChild(lastName);
    userTable.appendChild(username);
    userTable.appendChild(email);
    userTable.appendChild(phone);
    userTable.appendChild(submit);


    usr.removeAttribute('onclick');
    usr.setAttribute('onclick', 'removeUserEditForm("' + usr.getAttribute("id") + '")');
}

function removeUserEditForm(user){
    let input = user + '_form'; // Récupération de l'id du tr
    let form = document.getElementById(input);
    form.parentNode.removeChild(form); // Retrait du formulaire associé à la denrée

    let origin = document.getElementById(user);
    origin.removeAttribute('onclick'); // Suppression du onclick
    origin.setAttribute('onclick', 'userEditForm(' + user + ')'); // Rajout de la fonction de création sur le onclick
}

function searchByUser(){
    let input = document.getElementById("searchByUser").value;
    let append = document.getElementById("getUsers");

    let request = new XMLHttpRequest();
    if (1) { // input > 0
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                if (request.responseText !== '0' || request.responseText.length > 0 || request.responseText != null) {
                    let users = JSON.parse(request.responseText);
                    console.log(users);
                        for (let user in users) {
                            append.innerHTML += "<option>" + users[user]["firstName"] + "</option>";
                        }
                }
                else {
                    append.innerHTML = "";
                }
            }
        };
        request.open('POST', '../php/ajax/searchByUser.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(`input=${input}`);
    }
    else {
        console.log('Vous avez fait quelque chose de mal.');
    }
}