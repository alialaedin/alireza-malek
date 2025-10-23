<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

  <!-- Meta data -->
  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta
    content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard."
    name="description">
  <meta content="Spruko Technologies Private Limited" name="author">
  <meta name="keywords"
    content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard" />

  <title> احراز هویت </title>
  <link href="{{asset('assets/font/font.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/images/brand/favicon.ico')}}" rel="icon" type="image/x-icon" />
  <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css-rtl/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css-rtl/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css-rtl/dark.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css-rtl/animated.cs')}}s" rel="stylesheet" />
  <link href="{{asset('assets/css-rtl/icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/select2/select2.min.cs')}}s" rel="stylesheet" />
  <link href="{{asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />
</head>

<body>

  <div id="app" class="page login-bg">
    <div class="page-single">
      <div class="container">
        <div class="row">
          <div class="col mx-auto">
            <div class="row justify-content-center">
              <div class="col-md-7 col-lg-5">

                <div v-if="showMobileCard" class="card">
                  <div class="p-4 pt-6 text-center">
                    <p class="mb-2 fs-24">احراز هویت</p>
                  </div>
                  <form class="card-body pt-1" id="login">
                    <div class="form-group">
                      <input class="form-control" v-model="mobile" placeholder="شماره همراه خود را وارد کنید"
                        type="text">
                    </div>
                    <div class="submit">
                      <button type="button" class="btn btn-primary btn-block" :disabled="isSendTokenDisabled"
                        @click="sendMobileToReceiveToken">دریافت
                        کد ورود</button>
                    </div>
                  </form>
                </div>

                <div v-if="showTokenCard" class="card">
                  <div class="p-4 pt-6 text-center">
                    <p class="mb-2 fs-24">احراز هویت</p>
                  </div>
                  <form id="authenticate-form" class="card-body pt-1"
                    action="{{ route('employee.registration.authenticate', $employmentForm) }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input id="smsToken" class="form-control" v-model="smsToken" name="sms_token"
                        placeholder="کد احراز هویت را وارد کنید" type="text" maxlength="5">
                      <input hidden name="mobile" :value="mobile">
                    </div>
                    <div class="submit">
                      <button type="button" :disabled="isSubmitBtnDisabled" @click="authenticate"
                        class="btn btn-primary btn-block">ثبت</button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.full.min.js')}}"></script>
  <script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/vue/vue3/vue.global.prod.js') }}"></script>
  <script src="{{ asset('assets/sweetalert2/sweetalert2.js') }}"></script>

  <script>
    const { createApp } = Vue;

    createApp({
      data() {
        return {
          csrfToken: @json(csrf_token()),
          mobile: '',
          smsToken: '',

          showMobileCard: true,
          showTokenCard: false,

          isSendTokenDisabled: false,
          isSubmitBtnDisabled: false,
        }
      },
      methods: {
        showValidationError(errors) {

          const list = document.createElement('ul');
          list.className = 'list-group';

          for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
              const errorsArray = errors[key];
              errorsArray.forEach((errorMessage) => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                listItem.textContent = errorMessage;
                list.appendChild(listItem);
              });
            }
          }

          Swal.fire({
            title: "<b>خطا های زیر رخ داده است</b>",
            html: list.outerHTML,
            icon: "error",
            confirmButtonText: "بستن",
          });
        },
        popup(type, title, message) {
          Swal.fire({
            title: title,
            text: message,
            icon: type,
            confirmButtonText: "بستن",
          });
        },
        async sendMobileToReceiveToken() {

          const iranianMobileRegex = /^(?:\+98|0)?9\d{9}$/;
          const isValide = iranianMobileRegex.test(this.mobile);

          if (!isValide) {
            this.popup('error', 'خطای اعتبار سنجی', 'شماره همراه به درستی وارد نشده است');
            return;
          }

          try {

            this.isSendTokenDisabled = true;

            const url = @json(route('employee.registration.send-authentication-token', $employmentForm));
            const formData = new FormData();

            formData.append('_token', this.csrfToken);
            formData.append('mobile', this.mobile);

            const options = {
              method: 'POST',
              body: formData,
              accept: 'application/json'
            };

            const response = await fetch(url, options);
            const result = await response.json();

            if (!response.ok && response.status == 422) {
              this.showValidationError(result.errors);
            }

            if (response.ok && response.status == 200) {
              this.showMobileCard = false;
              this.showTokenCard = true;
            }

          } catch (error) {
            console.error('error:', error);
          }

        },
        authenticate() {
          this.isSubmitBtnDisabled = true;
          document.getElementById('authenticate-form').submit();
        }
      }
    }).mount("#app");

  </script>

</body>

</html>