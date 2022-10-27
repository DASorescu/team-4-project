const form = document.getElementById('creation-form');
const user_name = document.getElementById('first_name');
const user_surname = document.getElementById('last_name');
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
// todo specialization validation!!

form.addEventListener('submit', (e) => {
    let isValid = false;

    if (!isNaN(user_name.value) || user_name.value.length < 3 || user_name.value.length > 30) {
        alert('Inserire un nome valido.');
    } else if (!isNaN(user_surname.value) || user_surname.value.length < 3 || user_surname.value.length > 30) {
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