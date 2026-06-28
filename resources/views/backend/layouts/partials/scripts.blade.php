<script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('template/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('template/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('template/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('template/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('template/assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('template/assets/js/main.js') }}"></script>

<script src="{{ asset('template/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<!-- Page JS -->
<!-- Place this tag before closing body tag for github widget button. -->
{{-- <script async defer src="https://buttons.github.io/buttons.js') }}"></script> --}}

<!-- Vendors JS -->
{{-- <script src="{{ asset('template/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
{{-- <script src="{{ asset('template/assets/js/charts-apex.js') }}"></script> --}}
<script src="{{ asset('template/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

<!-- Datatables JS -->
<script src="{{ asset('template/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('template/assets/js/tables-datatables-advanced.js') }}"></script>
<script src="{{ asset('template/assets/js/tables-datatables-basic.js') }}"></script>

<script src="{{ asset('template/assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ asset('template/assets/js/forms-extras.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('template/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('template/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('template/assets/js/forms-selects.js') }}"></script>

<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeFormat = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12;

        hours = hours.toString().padStart(2, '0');

        document.getElementById('clock').innerHTML = `
      ${hours}:${minutes}:${seconds}&nbsp;${timeFormat}`;
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>

@stack('script')
