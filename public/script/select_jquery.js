function getLevel(level) {
    $.ajax({
        type: "GET",
        url: "subject/" + level,
        success: function (data) {
            $('#term').empty();
            $.each(data, function (index, items) {
                $('#term').append('<option value="' + items.term + '">' + items.term + '</option>');

            });
        }
    });
}
;



function getValue(level, term) {
    $.ajax({
        type: "GET",
        url: "subject/" + level + "/" + term,
        success: function (data) {
            $('#subject').empty();
            $.each(data, function (index, items) {
                $('#subject').append('<option value="' + items.subjectcode + '">' + items.subjectcodes + '</option>');

            });
        }
    });
}
;



function getCourse() {
    $.ajax({
        type: "GET",
        url: "/get/list/grades",
        success: function (data) {
            $('#course').empty();
            $.each(data, function (index, mdl_course) {
                $('#course').append('<option value="' + mdl_course.fullname + '">' + mdl_course.fullname + '</option>');

            });
        }
    });
}
;
