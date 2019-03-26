const input = $('#inputBudgetCode');

input.keyup(function() {
    $.ajax({
        type: "GET",
        url: "api/budget_codes.php",
        contentType: 'application/json',

        success: function (ids) {
            const response = $('#budget_code_response');
            if ((ids.includes(input.val()))) {
                response.text("Found");
                input.removeClass("form-control is-invalid");
                input.addClass("form-control is-valid");
                response.removeClass("invalid-feedback");
                response.addClass("valid-feedback");

                $.ajax({
                    type: "POST",
                    url: "api/budget_code.php",
                    contentType: 'application/json',
                    data: JSON.stringify(input.val()),

                    success: function (row) {
                        $('#budgetCodeName').text(row.firstName + " " + row.lastName);
                        $('#budgetCodeRoom').text(row.roomNo);
                        $('#budgetCodeNum').text(row.telephoneNo);
                        $('#budgetCodeEmail').text(row.email);
                    },
                    error: function (xhr, resp, text) {
                        console.log(text);
                    }
                });
            } else {
                response.text("Not Found!");
                input.removeClass("form-control is-valid");
                input.addClass("form-control is-invalid");
                response.removeClass("valid-feedback");
                response.addClass("invalid-feedback");

                $('#budgetCodeName').text("Unkown");
                $('#budgetCodeRoom').text("Unkown");
                $('#budgetCodeNum').text("Unkown");
                $('#budgetCodeEmail').text("Unkown");
            }
        },
        error: function (xhr, resp, text) {
        }
    });
});