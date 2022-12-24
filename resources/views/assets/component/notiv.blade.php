<script>
    var isRtl = $('html').attr('data-textdirection') === 'rtl',
        typeSuccess = $('#type-success'),
        typeInfo = $('#type-info'),
        typeWarning = $('#type-warning'),
        typeError = $('#type-error'),
        positionTopLeft = $('#position-top-left'),
        positionTopCenter = $('#position-top-center'),
        positionTopRight = $('#position-top-right'),
        positionTopFull = $('#position-top-full'),
        positionBottomLeft = $('#position-bottom-left'),
        positionBottomCenter = $('#position-bottom-center'),
        positionBottomRight = $('#position-bottom-right'),
        positionBottomFull = $('#position-bottom-full'),
        progressBar = $('#progress-bar'),
        clearToastBtn = $('#clear-toast-btn'),
        fastDuration = $('#fast-duration'),
        slowDuration = $('#slow-duration'),
        toastrTimeout = $('#timeout'),
        toastrSticky = $('#sticky'),
        slideToast = $('#slide-toast'),
        fadeToast = $('#fade-toast'),
        clearToastObj;


</script>

@if(\Session::has('notiv'))
    @php
        $status = json_decode(\Session::get('notiv'));
    @endphp
<script>
    $(window).on('load', function() {
        toastr['{{$status->status}}']('{{$status->sub}}', '{{$status->header}}', {
            closeButton: true,
            tapToDismiss: false,
            positionClass: 'toast-bottom-left',
            progressBar: true,
            rtl: isRtl
        });
    })
</script>
@endif
