@yield('footer')
<script src="/js/app.js"></script>
<script src="/vendor/dropzone/dropzone.js"></script>
<script src="/vendor/bootstrap-select/js/bootstrap-select.js"></script>

<script>
Dropzone.autoDiscover = false;

$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

</script>

@yield('js')
