function addRequest(type,idUser,date){
    const textRequest = `type=${type}&idUser=${idUser}&date=${date}`;
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            console.log(request.responseText);//Réponse à afficher
        }
    };
    request.open('POST', '../../setRequests.php'); //path from home directory
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(textRequest);
}