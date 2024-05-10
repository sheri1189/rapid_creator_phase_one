function CSVFileStatusChange(element, id, url) {
    $.ajax({
        url: url + "/" + id,
        method: "GET",
        success: function (response) {
            if (response.message.csv_file_status == 1) {
                $("#" + response.module + "_status_" + response.message.id).empty();
                $("#" + response.module + "_status_" + response.message.id).append("Active");
            } else {
                $("#" + response.module + "_status_" + response.message.id).empty();
                $("#" + response.module + "_status_" + response.message.id).append("In-Active");
            }
        }
    })
}
function FontFileStatusChange(id, url) {
    $.ajax({
        url: url + "/" + id,
        method: "GET",
        success: function (response) {
            if (response.message.font_file_status == 1) {
                $("#" + response.module + "_status_" + response.message.id).empty();
                $("#" + response.module + "_status_" + response.message.id).append("Active");
            } else {
                $("#" + response.module + "_status_" + response.message.id).empty();
                $("#" + response.module + "_status_" + response.message.id).append("In-Active");
            }
        }
    })
}
