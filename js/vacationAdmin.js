function vacationEditForm(id) {
    const vacation = document.getElementById(id);
    vacation.childNodes.forEach(function (element) {
        if (element.localName == 'td') {
            element.childNodes.forEach(function (element) {
                if (element.localName == 'input' && element.type == 'hidden' && element.id !== 'idVac' && element.id !== 'updateVac') {
                    element.type = 'text';
                }
                else if (element.id == "updateVac" && element.type=='hidden') {
                    element.type = 'button';
                }
                else if(element.id=='updateVac' && element.type=='button'){
                    element.type = 'hidden';
                }
                else if (element.localName == 'input' && element.type == 'text') {
                    element.type = 'hidden';
                }
                else if (element.localName == "div" && element.innerHTML == "Modifier") {
                    element.innerHTML = "Annuler";
                }
                else if (element.localName == "div" && element.innerHTML == "Annuler") {
                    element.innerHTML = "Modifier";
                }
            })
        }
    });
}

function validationUpdate(id) {
    const form = document.getElementById('form' + id);

    let idVac=form[0];
    let labelVac=form[1];
    let nameVac=form[2];
    let colorVac=form[3];
    let applicationVac=form[4];

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            console.log(request.responseText);
        }
    };
    request.open('POST', '../php/ajax/updateVacations.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(`idVac=${idVac}&labelVac=${labelVac}&nameVac=${nameVac}&colorVac=${colorVac}&applicationVac=${applicationVac}`);

    vacationEditForm(id);
}