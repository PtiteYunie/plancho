/************************************************************************* USER CHECK : REGISTRATION *************************************************************************/

function checkRegistration(form)
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

/************************************************************************* USER CHECK : CONNECTION *************************************************************************/

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