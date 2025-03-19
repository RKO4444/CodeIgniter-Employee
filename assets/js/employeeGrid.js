$(document).ready(function() {

    $("#employeeGrid").jqGrid({
        url: BASE_URL + "employee/getEmployees",
        datatype: "json",
        mtype: "GET",
        colModel: [
            { label: 'ID', name: 'id', key: true, width: 50, sortable: true },
            { label: 'First Name', name: 'first_name', width: 90, sortable: true },
            { label: 'Last Name', name: 'last_name', width: 80, sortable: true },
            { label: 'Email', name: 'email', width: 200, sortable: true },
            { label: 'Phone', name: 'phone', width: 100 },
            { label: 'Department', name: 'department', width: 80 },
            { label: 'State', name: 'state', width: 100, sortable: true },
            { label: 'City', name: 'city', width: 100, sortable: true },
            { label: 'DOB', name: 'dob', width: 80, formatter: 'date' },
            {
                label: 'Profile Photo',
                name: 'profile_photo',
                width: 100,
                search: false,
                sortable: false,
                formatter: function(cellValue) {
                    let imageUrl = cellValue ? `${BASE_URL}uploads/${cellValue}` : `${BASE_URL}assets/default-profile.jpg`;
                    return `<img src="${imageUrl}" width="100" height="100" class="rounded-circle border" style="margin-left: 8px;">`;
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
                            <a href="${BASE_URL}employee/edit/${rowObject.id}" class="btn btn-warning btn-sm" style="margin-right: 15px;"><i class="fas fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" onclick="confirmDelete(${rowObject.id});" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
