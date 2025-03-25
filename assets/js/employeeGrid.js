$(document).ready(function() {

    $("#employeeGrid").jqGrid({
        url: BASE_URL + "employee/getEmployees",
        datatype: "json",
        mtype: "GET",
        colModel: [
            { label: 'ID', name: 'id', key: true, width: 50, sortable: true,search: false, },
            { label: 'First Name', name: 'first_name', width: 90, sortable: true },
            { label: 'Last Name', name: 'last_name', width: 80, sortable: true },
            { label: 'Email', name: 'email', width: 200, sortable: true },
            { label: 'Phone', name: 'phone', width: 100 },
            { label: 'Department', name: 'department', width: 80 },
            { label: 'State', name: 'state_name', width: 100, sortable: true },
            { label: 'City', name: 'city_name', width: 100, sortable: true },
            { label: 'DOB', name: 'dob', width: 80, formatter: 'date' },
            {
                label: 'Profile Photo',
                name: 'profile_photo',
                width: 80,
                search: false,
                sortable: false,
                formatter: function(cellValue) {
                    let imageUrl = cellValue ? `${BASE_URL}uploads/${cellValue}` : `${BASE_URL}assets/default-profile.jpg`;
                    return `<img src="${imageUrl}" width="80" height="80" class="rounded-circle border" style="margin-left: 8px;">`;
                }
            },
            {
                label: 'Actions',
                name: 'actions',
                width: 130,
                search: false,
                sortable: false,
                align: "center",
                formatter: function(cellValue, options, rowObject) {
                    return `
                        <div class="d-flex justify-content-center">
                            <a href="${BASE_URL}employee/edit/${rowObject.id}" class="btn btn-warning btn-sm" style="margin-right: 15px; color: white; "><i class="fas fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" onclick="confirmDelete(${rowObject.id});" style="color: white;" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                    `;
                }
            }
        ],
        viewrecords: true,
        height: "auto",
        autowidth: true,
        shrinkToFit: true,
        rowNum: 10,
        rowList: [10, 20, 30],
        pager: "#pager",
        sortname: "id",
        sortorder: "asc",
        searching: {
            defaultSearch: "cn"
        },
        search: true,
        jsonReader: {
            root: "data",
            page: "page",
            total: "total",
            records: "records",
            repeatitems: false
        },
        autowidth: true,
        shrinkToFit: true,
        multiselect: false,
        searchToolbar: true,
    });

    $("#employeeGrid").jqGrid('filterToolbar', {
        stringResult: true,
        searchOnEnter: false,
        defaultSearch: "cn"
    });
    $(window).on("resize", function() {
        $("#employeeGrid").setGridWidth($(".table-responsive").width());
    }).trigger("resize");
});

function confirmDelete(id) {
    $.jAlert({
        'title': 'Confirm Deletion',
        'content': 'Are you sure you want to delete this employee?',
        'theme': 'red',
        'btns': [
            {
                'text': 'Cancel',
                'closeAlert': true
            },
            {
                'text': 'Delete',
                'theme': 'black',
                'onClick': function(e, btn) {
                    window.location.href = BASE_URL + "employee/delete/" + id;
                }
            }
        ]
    });
}

function confirmBlogDelete(id) {
    $.jAlert({
        'title': 'Confirm Deletion',
        'content': 'Are you sure you want to delete this Blog?',
        'theme': 'red',
        'btns': [
            {
                'text': 'Cancel',
                'closeAlert': true
            },
            {
                'text': 'Delete',
                'theme': 'black',
                'onClick': function(e, btn) {
                    window.location.href = BASE_URL + "blogs/delete/" + id;
                }
            }
        ]
    });
}

$(document).ready(function () {
    $("#state").on("change",function () {
        var state_id = $(this).val();
        $("#city").html('<option value="">Loading...</option>');

        if (state_id) {
            $.ajax({
                url: BASE_URL + "location/getCities",
                type: "POST",
                data: { state_id: state_id },
                dataType: "json",
                success: function (data) {
                    var cityOptions = '<option value="">Select City</option>';
                    $.each(data, function (index, city) {
                        cityOptions += '<option value="' + city.id + '">' + city.city_name + '</option>';
                    });
                    $("#city").html(cityOptions);
                    const oldCity = $("#city").data('selected');
                    if (oldCity) {
                        $("#city").val(oldCity);
                    }
                }
            });
        } else {
            $("#city").html('<option value="">Select City</option>');
        }
    });
    $("#state").trigger("change");
});


$(document).ready(function () {
    $("input, select, textarea").on("input change", function () {
        const fieldName = $(this).attr("name");
        const errorElement = $("#error_" + fieldName);
        if (errorElement.length) {
            errorElement.text('').hide();
        }
    });
});


