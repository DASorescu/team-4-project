const form = document.getElementById('edit-form');
const username = document.getElementById('username');
const first_name = document.getElementById('first_name');
const last_name = document.getElementById('last_name');
const address_choice = document.getElementById('address');
const specializations = document.querySelectorAll('.form-check-input');

function checkTheBox() {
    var flag = 0;
    for (var i = 0; i < specializations.length; i++) {
        console.log(specializations[i]);
        if (form["specs[]"][i].checked) {
            flag++;
        }
    }
    if (!flag) {

        return false;
    }
    return true;
}

form.addEventListener('submit', (e) => {
    let isValid = false;

    if (!isNaN(first_name.value) || first_name.value.length < 3 || first_name.value.length > 30) {
        alert('Inserire un nome valido.');
    } else if (!isNaN(username.value) || username.value.length < 3 || username.value.length > 30) {
        alert('Inserire un username valido.');
    } else if (!isNaN(last_name.value) || last_name.value.length < 3 || last_name.value.length > 30) {
        alert('Inserire un cognome valido.');
    } else if (!address_choice.value) {
        alert('Devi scegliere una citta');
    }
    else if (!checkTheBox()) {
        alert("Devi selezionare almeno una specializzazione");
    }
    else isValid = true;

    if (!isValid) e.preventDefault();
})