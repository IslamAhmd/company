/**
 * Theme: Appzia Admin
 * Datatable
 */

! function(t) {
    "use strict";
    var a = function() {
        this.$dataTableButtons = t("#datatable-buttons")
    };
    a.prototype.createDataTableButtons = function() {
        0 !== this.$dataTableButtons.length && this.$dataTableButtons.DataTable({
            dom: "Bfrtip",
            buttons: [{
                extend: "copy",
                className: "btn-success"
            }, {
                extend: "csv"
            }, {
                extend: "excel"
            }, {
                extend: "pdf"
            }, {
                extend: "print"
            }],
            responsive: !0
        })
    }, a.prototype.init = function() {
        t("#datatable").dataTable(), t("#datatable-keytable").DataTable({
            keys: !0
        }),
            t("#datatable-responsive").DataTable({
        "language" : {
            "decimal":        "",
            "emptyTable":     "لا توجد بيانات فى الجدول",
            "info":           "عرض _START_ لــ _END_ من _TOTAL_ عناصر",
            "infoEmpty":      "عرض 0 لــ 0 من 0 عناصر",
            "infoFiltered":   "(معروض  _MAX_ من كل العناصر)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "عرض _MENU_ عناصر",
            "loadingRecords": "جارى التحميل...",
            "processing":     "جارى المعالجة...",
            "search":         "بحث:",
            "zeroRecords":    "لا توجد نتائج بحث مطابقة",
            "paginate": {
            "first":      "الأولى",
                "last":       "الأخيرة",
                "next":       "التالية",
                "previous":   "السابقة"
        },
            "aria": {
            "sortAscending":  ": أضغط لترتيب العناصر تصاعديا",
                "sortDescending": ": إضغط لترتيب العناصر تنازليا"
        }
        }

            }),
            t("#datatable-scroller").DataTable({
            ajax: "assets/plugins/datatables/json/scroller-demo.json",
            deferRender: !0,
            scrollY: 380,
            scrollCollapse: !0,
            scroller: !0
        });
        t("#datatable-fixed-header").DataTable({
            fixedHeader: !0
        });
        this.createDataTableButtons()
    }, t.DataTable = new a, t.DataTable.Constructor = a
}(window.jQuery),
    function(t) {
        "use strict";
        t.DataTable.init()
    }(window.jQuery);