registration__form.addEventListener('keyup', (event) => {
    let field = event.target.name;
    let fieldValue = event.target.value;

    if (field == 'name' || field == 'surname') {
        event.preventDefault();
        return false;
    }

    if (field === 'password' || field === 'confirmPassword') {
        fieldValue = {
            password: registration__password.value, 
            confirmPassword: registration__confirmPassword.value
        };
    }

    fieldChecker(fieldValue, field);
})

async function fieldChecker(fieldValue, fieldName) {
    let response = await fetch('/registration/checker', {
        method: 'POST',
        body: JSON.stringify({'fieldValue': fieldValue, 'fieldName': fieldName})
    });

    if (response.ok) {
        let json = await response.json();

        if (document.getElementsByClassName('registration__errors').length != 0) {
            document.getElementsByClassName('registration__errors')[0].remove();
        }
    
        if (typeof json == 'number') {
            return false;
        }

        let registration__errors = document.createElement('div');
        registration__errors.className = 'registration__errors';
        registration__errors.innerHTML = `<em><strong>${json[0]}</em></strong>`;
        registration__errors.style.color = 'red';
    
        document.getElementsByName(fieldName)[0].after(registration__errors);
    }
}