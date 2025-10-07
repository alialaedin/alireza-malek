@extends('employee::register-form-layouts.master')

@section('content')

<x-card title="اطلاعات شخصی">

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="first_name" text="نام" :is-required="true" />
        <x-input type="text"  v-model="employee.first_name" name="first_name" class="form-control-sm" required />
      </x-form-group>
    </x-col>
    
    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="last_name" text="نام خانوادگی" :is-required="true" />
        <x-input type="text" v-model="employee.last_name" name="last_name" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="father_name" text="نام پدر" :is-required="true" />
        <x-input type="text"  v-model="employee.father_name" name="father_name" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="birth_certificate_number" text="شماره شناسنامه" :is-required="true" />
        <x-input type="text"  v-model="employee.birth_certificate_number" name="birth_certificate_number" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="birth_certificate_serial_number" text="سریال شناسنامه" :is-required="true" />
        <x-input type="text"  v-model="employee.birth_certificate_serial_number" name="birth_certificate_serial_number" class="form-control-sm" required />
      </x-form-group>
    </x-col>

  </x-row>

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="birth_place" text="محل تولد" :is-required="true" />
        <x-input type="text" v-model="employee.birth_place" name="birth_place" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="birth_date" text="تاریخ تولد" :is-required="true" />
        <x-input type="text" name="birth_date" class="form-control-sm" required placeholder="برای انتخاب کلیک کنید" />
        <date-picker 
          v-model="employee.birth_date" 
          type="date" 
          format="YYYY-MM-DD"
          display-format="jYYYY/jM/jD"
          custom-input="#birth_date"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="national_code" text="کد ملی" :is-required="true" />
        <x-input type="text" v-model="employee.national_code" name="national_code" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="nationality" text="ملیت" :is-required="true" />
        <x-input type="text" v-model="employee.nationality" name="nationality" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="religion" text="مذهب" :is-required="true" />
        <x-input type="text" v-model="employee.religion" name="religion" class="form-control-sm" required />
      </x-form-group>
    </x-col>

  </x-row>

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="is_married" text="وضعیت تاهل" :is-required="true" />
        <multiselect
          dir="rtl"
          id="is_married"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.maritalStatusObj"
          label="label"
          placeholder="انتخاب وضعیت تاهل"
          track-by="name"
          :options="[{ name:'married', label: 'متاهل' }, { name:'single', label: 'مجرد' }]"
          required
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="spouse_job" text="شغل همسر" />
        <x-input type="text" v-model="employee.spouse_job" name="spouse_job" class="form-control-sm" />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="children_count" text="تعداد اولاد" />
        <x-input type="number" v-model="employee.children_count" name="children_count" class="form-control-sm" />
      </x-form-group>
    </x-col>

  </x-row>

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="telephone" text="تلفن ثابت" />
        <x-input type="text" v-model="employee.telephone" name="telephone" class="form-control-sm" />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="mobile" text="تلفن همراه" :is-required="true" />
        <x-input type="text" v-model="employee.mobile" name="mobile" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="postal_code" text="کد پستی" :is-required="true" />
        <x-input type="text" v-model="employee.postal_code" name="postal_code" class="form-control-sm" required />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="residence_status" text="وضعیت سکونت" :is-required="true" />
        <multiselect
          dir="rtl"
          id="residence_status"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.residenceStatusObj"
          label="label"
          placeholder="انتخاب وضعیت سکونت"
          track-by="name"
          :options="residenceStatuses"
          required
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="rent_amount" text="مبلغ اجاره (تومان)" />
        <x-input type="number" v-model="employee.rent_amount" name="rent_amount" class="form-control-sm" />
      </x-form-group>
    </x-col>

    <x-col>
      <x-form-group>
        <x-label for="address" text="آدرس محل سکونت" :is-required="true" />
        <x-textarea name="address" v-model="employee.address" class="form-control-sm" rows="2" required/>
      </x-form-group>
    </x-col> 

  </x-row>

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="military_status" text="وضعیت سربازی" />
        <multiselect
          dir="rtl"
          id="military_status"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.militaryStatusObj"
          label="label"
          placeholder="انتخاب وضعیت سربازی"
          track-by="name"
          :options="militaryStatuses"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="reason_for_exemption" text="علت معافیت" />
        <x-input type="text" v-model="employee.reason_for_exemption" name="reason_for_exemption" class="form-control-sm" />
      </x-form-group>
    </x-col>

  </x-row>

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="has_own_car" text="اتومبیل شخصی دارید ؟" />
        <multiselect
          dir="rtl"
          id="has_own_car"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.hasOwnCarObj"
          label="label"
          placeholder="انتخاب"
          :options="[{ label: 'بله', value: 1 }, { label: 'خیر', value: 0 }]"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="car_type" text="نوع تومبیل" />
        <multiselect
          dir="rtl"
          id="car_type"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.carTypeObj"
          label="label"
          placeholder="انتخاب نوع تومبیل"
          :options="carTypes"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="has_driver_license" text="گواهینامه اتومبیل دارید ؟" />
        <multiselect
          dir="rtl"
          id="has_driver_license"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.hasDriverLicenseObj"
          label="label"
          placeholder="انتخاب"
          :options="[{ label: 'بله', value: 1 }, { label: 'خیر', value: 0 }]"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="driver_license_type" text="نوع گواهینامه" />
        <multiselect
          dir="rtl"
          id="driver_license_type"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.driverLisenceTypeObj"
          label="label"
          placeholder="انتخاب نوع تومبیل"
          :options="driverLicenseTypes"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="driver_license_number" text="شماره گواهینامه" />
        <x-input type="text" v-model="employee.driver_license_number" name="driver_license_number" class="form-control-sm" />
      </x-form-group>
    </x-col>

  </x-row>

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="health_status" text="وضعیت سلامتی" />
        <multiselect
          dir="rtl"
          id="health_status"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.healthStatusObj"
          label="label"
          placeholder="انتخاب"
          :options="[{ label: 'سالم', value: 1 }, { label: 'بیمار', value: 0 }]"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="disease" text="بیماری" />
        <x-input type="text" v-model="employee.disease" name="disease" class="form-control-sm" />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="has_surgery" text="آیا تاکنون جراحی داشتید ؟" />
        <multiselect
          dir="rtl"
          id="has_surgery"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.hasSurgery"
          label="label"
          placeholder="انتخاب"
          :options="[{ label: 'بله', value: 1 }, { label: 'خیر', value: 0 }]"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="cause_of_surgery" text="علت جراحی" />
        <x-input type="text" v-model="employee.cause_of_surgery" name="cause_of_surgery" class="form-control-sm" />
      </x-form-group>
    </x-col>

  </x-row>

  <x-row>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="has_other_income" text="آیا درآمد دیگری دارید ؟" />
        <multiselect
          dir="rtl"
          id="has_other_income"
          class="custom-multiselect form-control-sm p-0"
          v-model="employee.hasOtherIncome"
          label="label"
          placeholder="انتخاب"
          :options="[{ label: 'بله', value: 1 }, { label: 'خیر', value: 0 }]"
        />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="other_income_source" text="منبع درآمد" />
        <x-input type="text" v-model="employee.other_income_source" name="other_income_source" class="form-control-sm" />
      </x-form-group>
    </x-col>

    <x-col xl="2" lg="3" md="4">
      <x-form-group>
        <x-label for="other_income_amount" text="مبلغ درآمد (تومان)" />
        <x-input type="number" v-model="employee.other_income_amount" name="other_income_amount" class="form-control-sm" />
      </x-form-group>
    </x-col>

  </x-row>

</x-card>

<x-card title="آخرین مدارک تحصیلی">

  <x-slot name="options">
    <button @click="addEducationCertificate" class="btn btn-sm btn-outline-primary px-3">
      <i class="fa fa-plus"></i>
    </button>
  </x-slot>

  <div v-if="educationCertificates.length" class="table-responsive">
    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
      <div class="row">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom text-center">
          <thead class="thead-light">
          <tr>
            <th>ردیف</th>
            <th>نام دبیرستان</th>
            <th>رشته تحصیلی</th>
            <th>مدرک تحصیلی</th>
            <th>سال اخذ مدرک</th>
            <th>محل اخذ مدرک</th>
            <th>عملیات</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="(certificate, index) in educationCertificates" :key="index">
              <td class="font-weight-bold">@{{ index + 1 }}</td>
              <td><x-input type="text" v-model="certificate.high_school_name" name="high_school_name" /></td>
              <td><x-input type="text" v-model="certificate.field_of_study" name="field_of_study" /></td>
              <td><x-input type="text" v-model="certificate.degree" name="degree" /></td>
              <td><x-input type="text" v-model="certificate.year_of_obtaining_degree" name="year_of_obtaining_degree" /></td>
              <td><x-input type="text" v-model="certificate.place_of_obtaining_degree" name="place_of_obtaining_degree" /></td>
              <td><button @click="removeEducationCertificate(index)" class="btn btn-outline-danger btn-sm">حذف</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-card>

<x-card title="تجربیات">

  <x-slot name="options">
    <button @click="addExperience" class="btn btn-sm btn-outline-primary px-3">
      <i class="fa fa-plus"></i>
    </button>
  </x-slot>

  <div v-if="experiences.length" class="table-responsive">
    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
      <div class="row">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom text-center">
          <thead class="thead-light">
          <tr>
            <th>ردیف</th>
            <th>نام محل کار</th>
            <th>سمت</th>
            <th>مدت کار</th>
            <th>حقوق اولیه (تومان)</th>
            <th>آخرین حقوق (تومان)</th>
            <th>علت ترک کار</th>
            <th>عملیات</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="(experience, index) in experiences" :key="index">
              <td class="font-weight-bold">@{{ index + 1 }}</td>
              <td><x-input type="text" v-model="experience.name_of_workplace" name="name_of_workplace" /></td>
              <td><x-input type="text" v-model="experience.post" name="post" /></td>
              <td><x-input type="text" v-model="experience.working_period" name="working_period" /></td>
              <td><x-input type="number" v-model="experience.basic_salary" name="basic_salary" /></td>
              <td><x-input type="number" v-model="experience.last_salary" name="last_salary" /></td>
              <td><x-input type="text" v-model="experience.reason_for_leaving" name="reason_for_leaving" /></td>
              <td><button @click="removeExperience(index)" class="btn btn-outline-danger btn-sm">حذف</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-card>

<x-card title="آشنایی به زبان های خارجه">

  <x-slot name="options">
    <button @click="addLanguage" class="btn btn-sm btn-outline-primary px-3">
      <i class="fa fa-plus"></i>
    </button>
  </x-slot>

  <div v-if="languages.length" class="table-responsive">
    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
      <div class="row">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom text-center">
          <thead class="thead-light">
          <tr>
            <th>ردیف</th>
            <th>نوع زبان خارجه</th>
            <th>مکالمه</th>
            <th>خواندن</th>
            <th>نوشتن</th>
            <th>عملیات</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="(language, index) in languages" :key="index">
              <td class="font-weight-bold">@{{ index + 1 }}</td>
              <td>
                <x-input type="text" v-model="language.language" name="language" />
              </td>
              <td>
                <select v-model="language.conversation" class="form-control">
                  <option value="" disabled>انتخاب سطح</option>
                  <option v-for="status in languageSkillsStatus" :value="status.name" v-text="status.label"></option>
                </select>
              </td>
              <td>
                <select v-model="language.reading" class="form-control">
                  <option value="" disabled>انتخاب سطح</option>
                  <option v-for="status in languageSkillsStatus" :value="status.name" v-text="status.label"></option>
                </select>
              </td>
              <td>
                <select v-model="language.writing" class="form-control">
                  <option value="" disabled>انتخاب سطح</option>
                  <option v-for="status in languageSkillsStatus" :value="status.name" v-text="status.label"></option>
                </select>
              </td>
              <td>
                <button @click="removeLanguage(index)" class="btn btn-outline-danger btn-sm">حذف</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-card>

<x-card title="معرفان">

  <x-slot name="options">
    <button @click="addReferencePerson" class="btn btn-sm btn-outline-primary px-3">
      <i class="fa fa-plus"></i>
    </button>
  </x-slot>

  <div v-if="referencePersons.length" class="table-responsive">
    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
      <div class="row">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom text-center">
          <thead class="thead-light">
          <tr>
            <th>ردیف</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>شغل</th>
            <th>آدرس</th>
            <th>موبایل</th>
            <th>تلفن</th>
            <th>عملیات</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="(referencePerson, index) in referencePersons" :key="index">
              <td class="font-weight-bold">@{{ index + 1 }}</td>
              <td><x-input type="text" v-model="referencePerson.first_name" name="first_name" /></td>
              <td><x-input type="text" v-model="referencePerson.last_name" name="last_name" /></td>
              <td><x-input type="text" v-model="referencePerson.job" name="job" /></td>
              <td><x-input type="text" v-model="referencePerson.address" name="address" /></td>
              <td><x-input type="text" v-model="referencePerson.mobile" name="mobile" /></td>
              <td><x-input type="text" v-model="referencePerson.telephone" name="telephone" /></td>
              <td><button @click="removeReferencePerson(index)" class="btn btn-outline-danger btn-sm">حذف</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-card>

<x-row>
  <x-col class="d-flex align-items-center justify-content-center" style="gap: 8px">
    <button @click="submit" class="btn btn-sm btn-primary" type="button">ثبت اطلاعات</button>
    <a class="btn btn-danger btn-sm" onclick="window.location.reload()">ریست فرم</a>
  </x-col>
</x-row>

<div style="margin-bottom: 200px"></div>

@endsection

@section('scripts')
    
<script>
  const { createApp } = Vue;

  createApp({
    components: {
      'multiselect': window['vue-multiselect'].default,
      'date-picker': Vue3PersianDatetimePicker,
    },
    data() {
      return {
        residenceStatuses: @json($residenceStatuses),
        militaryStatuses: @json($militaryStatuses),
        carTypes: @json($carTypes),
        driverLicenseTypes: @json($driverLicenseTypes),
        languageSkillsStatus: @json($languageSkillsStatus),
        employee: {
          first_name: '',
          last_name: '',
          father_name: '',
          birth_certificate_number: '',
          birth_certificate_serial_number: '',
          birth_date: '',
          birth_place: '',
          children_count: '',
          national_code: '',
          spouse_job: '',
          nationality: '',
          religion: '',
          telephone: '',
          mobile: '',
          postal_code: '',
          address: '',
          rent_amount: '',
          is_married: false,
          residence_status: '',
          military_status: '',
          reason_for_exemption: '',
          has_own_car: false,
          car_type: '',
          has_driver_license: false,
          driver_license_type: '',
          driver_license_number: '',
          health_status: false,
          disease: '',
          has_surgery: false,
          cause_of_surgery: '',
          has_other_income: false,
          other_income_source: '',
          other_income_amount: '',
          maritalStatusObj: [],
          residenceStatusObj: [],
          militaryStatusObj: [],
          hasOwnCarObj: [],
          carTypeObj: [],
          hasDriverLicenseObj: [],
          driverLisenceTypeObj: [],
          healthStatusObj: [],
          hasSurgery: [],
          hasOtherIncome: [],
        },
        educationCertificates: [],
        experiences: [],
        languages: [],
        referencePersons: [],
      }
    },
    watch: {
      'employee.maritalStatusObj'(newVal) {
        this.employee.is_married = newVal.name === 'single' ? false : true;
      },
      'employee.residenceStatusObj'(newVal) {
        this.employee.residence_status = newVal.name;
      },
      'employee.militaryStatusObj'(newVal) {
        this.employee.military_status = newVal.name;
      },
      'employee.hasOwnCarObj'(newVal) {
        this.employee.has_own_car = newVal.value ? true : false;
      },
      'employee.carTypeObj'(newVal) {
        this.employee.car_type = newVal.name;
      },
      'employee.hasDriverLicenseObj'(newVal) {
        this.employee.has_driver_license = newVal.value ? true : false;
      },
      'employee.driverLisenceTypeObj'(newVal) {
        this.employee.driver_license_type = newVal.name;
      },
      'employee.healthStatusObj'(newVal) {
        this.employee.health_status = newVal.value ? true : false;
      },
      'employee.hasSurgery'(newVal) {
        this.employee.has_surgery = newVal.value ? true : false;
      },
      'employee.hasOtherIncome'(newVal) {
        this.employee.has_other_income = newVal.value ? true : false;
      },
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
      
      addEducationCertificate() {
        this.educationCertificates.push({
          high_school_name: '',
          field_of_study: '',
          degree: '',
          year_of_obtaining_degree: '',
          place_of_obtaining_degree: ''
        });
      },
      removeEducationCertificate(index) {
        this.educationCertificates.splice(index, 1);
      },
      
      addExperience() {
        this.experiences.push({
          name_of_workplace: '',
          post: '',
          working_period: '',
          basic_salary: '',
          last_salary: '',
          reason_for_leaving: '',
        });
      },
      removeExperience(index) {
        this.experiences.splice(index, 1);
      },
      
      addLanguage() {
        this.languages.push({
          language: '',
          conversation: '',
          reading: '',
          writing: '',
        });
      },
      removeLanguage(index) {
        this.languages.splice(index, 1);
      },
      
      addReferencePerson() {
        this.referencePersons.push({
          first_name: '',
          last_name: '',
          job: '',
          address: '',
          mobile: '',
          telephone: '',
        });
      },
      removeReferencePerson(index) {
        this.referencePersons.splice(index, 1);
      },
      
      deleteKeys() {
        delete this.employee['maritalStatusObj'];
        delete this.employee['residenceStatusObj'];
        delete this.employee['militaryStatusObj'];
        delete this.employee['hasOwnCarObj'];
        delete this.employee['carTypeObj'];
        delete this.employee['hasDriverLicenseObj'];
        delete this.employee['driverLisenceTypeObj'];
        delete this.employee['healthStatusObj'];
        delete this.employee['hasSurgery'];
        delete this.employee['hasOtherIncome'];
      },
      setKeys() {
        this.employee['education_certificates'] = this.educationCertificates;
        this.employee['experiences'] = this.experiences;
        this.employee['languages'] = this.languages;
        this.employee['reference_persons'] = this.referencePersons;
      },

      async submit() {

        this.deleteKeys();
        this.setKeys();

        const url = @json(route('employee.registration.register', $employmentForm));
        const options = {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': @json(csrf_token())
          },
          body: JSON.stringify(this.employee)
        };

        const response = await fetch(url, options);
        const result = await response.json();

        if (!response.ok) {
          switch (response.status) {
            case 422:
              this.showValidationError(result.errors);
              break;
            case 404:
              this.popup('error', 'خطای 404', 'چنین چیزی وجود ندارد');
              break;
            case 409:
              this.popup('error', '', result.message);
              break;
            case 500:
              this.popup('error', 'خطای سرور', result.message);
              break;
            default: 
              this.popup('error', 'خطای نا شناخته');
              break;
          }
          return;
        }

        this.popup('success', result.message);
      }
    }
  }).mount('#main-content');

</script>

@endsection

@section('styles')

<style>
  label, input, textarea { 
    font-size: 12px !important; 
  }
</style>

@endsection