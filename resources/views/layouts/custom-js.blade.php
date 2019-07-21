@push('script')
<script>
    !function ($) {
    "use strict";

    var SweetAlert = function () {
    };
    //examples
    SweetAlert.prototype.init = function () {
        //Warning Message
        $('.sa-warning').click(function () {
            var that = $(this);
            swal({
                title: '{{trans('common.removeMsg')}}',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: '{{trans('common.yesDeleteIt')}}',
                closeOnConfirm: false
            }, function () {
                var Id = that.data('id');
                $('#id-' + Id).submit();
            });
        });
    },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.SweetAlert.init()
    }(window.jQuery);
    </script>
@endpush
