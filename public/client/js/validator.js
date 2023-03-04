function Validator(options) {
    var  selectorRules = {}; //save rules of a selector

    // function validate
    // show error message to client view
    //return true when form have error message
    function validate (options, rule) {
        var errorMessage;
        // get rule of each selector
        var rules = selectorRules[rule.selector];
        for (let i = 0; i < rules.length; i++) {
            // handle type element of form
            switch ($(rule.selector).attr("type")) {
                case "radio":
                    errorMessage = rules[i]($(rule.selector+":checked").val());
                    break;
                case "checkbox":
                    errorMessage = rules[i]($(rule.selector+":checked").val());
                    break;
                default:
                    errorMessage = rules[i]($(rule.selector).val());
            }
            if(errorMessage) break;
        }
        if(errorMessage) {
            $(rule.selector).addClass('is-invalid');
            // go to class parent of this field
            //if not exist error message to show message
            if($(rule.selector).parent().find(options.errorSelector).length === 0) { 
                $(rule.selector).parent().append('<div class="form-error"> <span> <i class="fa fa-exclamation-circle"></i></span><span class="error_message">' + errorMessage + '</span></div>')
            }
        } else {
            $(rule.selector).removeClass('is-invalid');
            $(rule.selector).parent().find(options.errorSelector).remove();
        }
        return !errorMessage;
    }

    var formElement = $(options.form);
    if (formElement) {
        $(options.form).on('submit', function(e) {
            e.preventDefault();
            var isFormValid = true;
            // Loop each rule, listen event and do rulee when form have error 
            options.rules.forEach(function (rule) {
                var isValid = validate(options, rule); //do validate
                if(!isValid) { //
                    isFormValid = false;
                }
            });
            //when form haven't error. After that. Do submit form
            if(isFormValid) {
                //get data of form
                if(typeof options.onSubmit === 'function') { //when form is submited
                    var enableInputs = $(options.form).serializeArray(); //get all value of form
                    
                    // console.log(enableInputs);
                    var formData = {}; //all input of form
                    // convert array to object
                    for(let i in enableInputs) {
                        // if object has two same key... merge two value = array of this to same key
                        //eg: samekey => [value1, value2]
                        if(formData.hasOwnProperty(enableInputs[i].name)) {
                            if(!Array.isArray(formData[enableInputs[i-1].name])) {                     
                                formData[enableInputs[i-1].name] = [enableInputs[i-1].value];
                            }
                            formData[enableInputs[i-1].name].push(enableInputs[i].value);
                            break;
                        }
                        formData[enableInputs[i].name] =  enableInputs[i].value;
                    }
                    ///get formData
                    // if(form.has('avatar')) {
                    //     // var avatar = form.getAll('avatar')[0].name
                    //     var avatar = form.getAll('avatar')[0];
                    //     formData['avatar'] = avatar;
                    // }
                    // console.log(avatar);
                    
                    // if(form.has('sub_avatar[]')) {
                    //     var subAvatar = form.getAll('sub_avatar[]')
                    //     for(let i in subAvatar) {
                    //         if(!Array.isArray(formData['sub_avatar'])) {
                    //             formData['sub_avatar'] = [subAvatar[i]];
                    //         } 
                    //         else {
                    //             formData['sub_avatar'].push(subAvatar[i])
                    //         }
                    //     }
                    // }
                    // const formTest = new FormData();
                    // var test = $('#avatar')[0];
                    // formTest.append('avatar', test.files[0])
                    // console.log(test);
                    
                    // options.onSubmit(options.form);
                    // get file in form
                    options.onSubmit(formData);
                }
            }
        })

        // Loop each rule and listen event 
        options.rules.forEach(function (rule) {
            // field can have many rules
            // save rules:  array[selector] : function check()
            if(Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.check);
            }
            else {
                selectorRules[rule.selector] = [rule.check];
            }

            var inputElement = $(options.form).find(rule.selector);
            if (inputElement) {
                $(rule.selector).on('blur', function() {
                    validate(options, rule); //action validate
                })
                // delete error when user typing something
                $(rule.selector).on('input', function() {
                    $(rule.selector).removeClass('is-invalid');
                    $(rule.selector).parent().find(options.errorSelector).remove();
                })
            }
        });
    }
}

// Handle action when user use form
// 1. If input have error ==> return message error
// 2. else not have error ==> return undefined
// -----params
// selector: eg. #name, #email,
// check function: return message when user typed error
Validator.isRequired = function(selector) {
    return {
        selector: selector,
        check: function (value) {
            switch ($(selector).attr("type")) {
                case "radio":
                case "checkbox":
                    console.log(value);
                    return $.trim(value) ? undefined : "The " + $(selector).attr("name") + " field is required";
                    // return $.trim(value) ? undefined : "The " + $(selector).attr("name") + " field is required";
                default:
                    return $.trim(value) ? undefined : "The " + $(selector).attr("name") + " field is required";
            }
            
        }
    };
}

Validator.minLength = function(selector, minLength = 10) {
    return {
        selector: selector,
        check: function (value) {
            return value.length >= minLength ? undefined : "The " + $(selector).attr("name") + " must be at least " + minLength + " characters";
        }
    };
}


