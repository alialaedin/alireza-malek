{{--
<script src="{{ asset('assets/custom/sweetalert.min.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>
<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>
<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/plugins/vertical-scroll/vertical-scroll.js') }}"></script>
<script src="{{ asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/time-picker/toggles.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js') }}"></script>
{{--
<script src="{{ asset('assets/plugins/notify/js/jquery.growl.js') }}"></script> --}}
<script src="{{ asset('assets/PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
<script src="{{ asset('assets/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/sortable-js/sortable.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.js')}}"></script>
{{--
<script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script> --}}
{{--
<script src="{{ asset('assets/plugins/peitychart/peitychart.init.js')}}"></script> --}}
{{--
<script src="{{ asset('assets/plugins/apexchart/apexcharts.js')}}"></script> --}}
<script src="{{ asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}"></script>
{{--
<script src="{{ asset('assets/plugins/chart/chart.bundle.js')}}"></script> --}}
{{--
<script src="{{ asset('assets/plugins/chart/utils.js')}}"></script> --}}
{{--
<script src="{{ asset('assets/plugins/chart.min/chart.min.js')}}"></script> --}}
{{--
<script src="{{ asset('assets/plugins/chart.min/rounded-barchart.js')}}"></script> --}}
{{--
<script src="{{ asset('assets/js/chart.js')}}"></script> --}}
{{--
<script src="{{ asset('assets/js/index1.js') }}"></script> --}}
<script src="{{ asset('assets/js/custom.js') }}"></script>
{{--
<script src="{{ asset('assets/tree-select/comboTreePlugin.js') }}"></script> --}}
<script src="{{ asset('assets/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/custom/custom.js') }}"></script>

<script>
  $(".select2").select2();
  $(".multi-select2").select2({
    tags: true
  });
  $(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });
</script>


<script>
  class CustomSelect {
    constructor(selector, placeholder) {
      this.selector = selector;
      this.placeholder = placeholder;

      this.initSelect2();
    }

    initSelect2() {
      $(this.selector).select2({
        placeholder: this.placeholder,
        allowClear: true,
        dir: 'rtl',
        language: {
          noResults: () => {
            return "موردی یافت نشد !";
          }
        }
      });
    }
  }  
</script>