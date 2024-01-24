jQuery(document).ready(function ($) {
    function getContactDetails(orderBy, sortOrder, searchQuery) {
        var ajax_url = my_ajax_obj.ajaxUrl;

        var data = {
            action: 'retrieve_contact_data',
            orderby: orderBy,
            order: sortOrder,
            search: searchQuery,
        };

        jQuery.ajax({
            url: ajax_url,
            type: 'GET',
            data: data,
            success: function (response) {
                if (response.success == true) {
                    var data = response.data.data;

                    var tableBody = jQuery('#table tbody');
                    tableBody.empty();

                    for (var i = 0; i < data.length; i++) {
                        var row = '<tr>';
                        row += '<td>' + escapeHtml(data[i].Name) + '</td>';
                        row += '<td>' + escapeHtml(data[i].Email) + '</td>';
                        row += '<td>' + escapeHtml(data[i].Subject)+ '</td>';
                        row += '<td>' + escapeHtml(data[i].Message) + '</td>';
                        row += '</tr>';
                        tableBody.append(row);
                    }
                } else {
                    console.log('Error fetching data.');
                }
            }
        });
    }

    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }

    $("#asc").click(function () {
        console.log("Sorting ASC");
        getContactDetails('Email', 'ASC', $("#searchInput").val());
    });

    
    $("#desc").click(function () {
        console.log("Sorting DESC");
        getContactDetails('Email', 'DESC', $("#searchInput").val());
    });
    $("#name_asc").click(function () {
        console.log("Sorting Name ASC");
        getContactDetails('Name', 'ASC', $("#searchInput").val());
    });

    
    $("#name_desc").click(function () {
        console.log("Sorting NAme DESC");
        getContactDetails('Name', 'DESC', $("#searchInput").val());
    });

    $("#searchButton").click(function () {
        console.log("Searching...");
        getContactDetails('', '', $("#searchInput").val());
    });

    getContactDetails('', '');
});
