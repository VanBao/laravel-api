"use strict";

jQuery(document).ready(function () {
    window.datatable = $('.kt-datatable').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: KTDB_URL,
                    method: typeof KTDB_METHOD !== 'undefined' ? KTDB_METHOD : 'GET',
                    // sample custom headers
                    // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                    map: function (raw) {
                        // sample data mapping
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
            onEnter: true,
        },

        // columns definition
        columns: KTDB_COLUMNS,
        translate: {
            records: {
                processing: 'Loading ...'
            }
        }
    });
});
