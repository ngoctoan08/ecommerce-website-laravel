
// function create product
function createUnit(data) {
    const unitUrl = 'http://127.0.0.1:8000/admin/unit/';
    var conversion_unit = data.conversion_unit;
    // Body API
    var options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            'Accept': 'application/json',
          },
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    }
    // Fetch API 
    fetch(unitUrl, options)
    .then((response) => response.json())
    .then((data) => {
        if(data.errors) {
            alertError(data.message);
            var dataErrors = data.errors;
            for (const key in dataErrors) {
                if(dataErrors.hasOwnProperty(key)) {
                    var value = dataErrors[key];
                    //do something with value;
                    appendColumnError(key, value);
                }
            }
        } else {
            alertSuccess(data.message);
            hideModal('#modalUnit');
            // append data
            appendDataOption('#list_conversion_unit', conversion_unit)
        }
    })
}


// function delete product