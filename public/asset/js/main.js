/**
 * Check number is numeric or not
 * @param n
 * @returns {boolean}
 */
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

/**
 * Get Input Value from form
 * @param id
 * @returns {*}
 */
function getInputValue(id) {
    return document.getElementById(id).value;
}

/**
 * Check email is valid not not
 * @param email
 * @returns {boolean}
 */
function validateMail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};

/**
 * Validation input fields
 */
function doValidation() {
    let amount = getInputValue('amount');
    let buyer = getInputValue('buyer');
    let receipt_id = getInputValue('receipt_id');
    let buyer_email = getInputValue('buyer_email');
    let note = getInputValue('note');
    let city = getInputValue('city');
    let phone = getInputValue('phone');

    let errors = [];

    if (amount == '' || buyer == '' || receipt_id == '' || buyer_email == '' || note == '' || city == '' || phone == '') {

        errors.push('No field should be empty except entry_at');
    }

    if (isNumeric(amount) === false) {

        errors.push('Amount should be integer value');
    }

    const pattern = new RegExp("[a-z0-9]");
    if (pattern.test(buyer) == false) {
        errors.push('You should not put special character');
    } else if (buyer.length > 20) {
        errors.push('Buyer should contain more than 20 characters');
    }

    const receiptPattern = new RegExp("[a-zA-Z]");
    if (receiptPattern.test(receipt_id) == false) {
        errors.push('Receipt id should contain only text');
    }

    if (validateMail(buyer_email) == false) {

        errors.push('Buyer mail is not valid');
    }

    if (note.length > 30) {
        errors.push('Text Should not contain more than 30 characters');
    }

    const cityPattern = new RegExp("[a-zA-Z]");
    if (cityPattern.test(city) == false) {
        errors.push('City input value is not valid');
    }

    const entryBy = new RegExp("[0-9]");
    if (entryBy.test(city) == false) {
        errors.push('Entry by value should contain only number');
    }

    const phonePattern = new RegExp("[0-9]");
    if (phonePattern.test(phone) == false) {
        errors.push('Phone number should contain only numbers');
    } else {
        $('#phone').val('80' + phone);

    }


    let errorData = '';
    errors.forEach(function (item, index) {
        errorData += '<p class="alert alert-warning">' + item + "</p>";
    });

    $('#error-message').html(errorData);
    setTimeout(function () {
        $('.message').slideUp();
    }, 2000);

    formSubmission($('#form-data').serialize());

}

function addMoreitems() {

    $(function () {
        $('#addMoreItem').click(function () {
            var data = '<input type="text" name="items[]" class="form-control item-data" placeholder="Items"><br>';
            $(this).parent().append(data);
        });
    });
}

function formSubmission(formData) {

    $(document).ready(function () {

        const url = $('#app_url').val() + 'home/ajax_submision';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: formData, // serializes form input
            success: function (data) {
                console.log(data.status);
                if (data.status == 'success') {
                    $('#error-message').html('<p class="alert alert-success">Data Inserted succesful</p>');
                } else {
                    $('#error-message').html(data.message);
                }
            }, error: function (e) {
                //console.log(e);
            }
        });

    });

}

addMoreitems();

document.getElementById("submitBtn") //trigger submit
    .addEventListener("click", doValidation);

