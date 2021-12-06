const strongPassword = function () {
    return {
        validate: function (input) {
            const value = input.value;
            if (value === '') {
                return {
                    valid: true,
                };
            }

            // Check the password strength
            if (value.length < 6) {
                return {
                    valid: false,
                    message: 'The password must be more than 6 characters long',
                };
            }

            // The password does not contain any uppercase character
            if (value === value.toLowerCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one upper case character',
                };
            }

            // The password does not contain any uppercase character
            if (value === value.toUpperCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one lower case character',
                };
            }

            // The password does not contain any digit
            if (value.search(/[0-9]/) < 0) {
                return {
                    valid: false,
                    message: 'The password must contain at least one digit',
                };
            }

            return {
                valid: true,
            };
        },
    };
};