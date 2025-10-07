@props([
  'action',
  'inputs'
])

<x-card title="جستجوی پیشرفته">
  <form action="{{ $action }}" method="GET" autocomplete="off">

    <div class="row">

      @foreach(array_filter($inputs, fn ($arr) => $arr['type'] != 'hidden') as $name => $options)
        <div class="col-xl-3">
          <fieldset class="form-group">

            @switch($options['type'])
              @case('text')
              @case('email')
              @case('number')
                <input
                  id="{{ $name }}"
                  name="{{ $name }}"
                  type="{{ $options['type'] }}"
                  class="form-control fs-12"
                  placeholder="{{ $options['placeholder'] }}"
                  value="{{ request($name) }}"
                  autocomplete="off"
                />
                @break

              @case('select')
                <select id="{{ $name }}" name="{{ $name }}" class="form-control fs-12">
                  <option value="" class="text-muted">{{ $options['placeholder'] }}</option>
                  @foreach ($options['options'] as $value => $label)
                    <option value="{{ $value }}" @selected(request($name) == $value)>
                      {{ $label }}
                    </option>
                  @endforeach
                </select>
                @break

              @case('date')
                <input
                  id="{{ $name }}-show"
                  type="text"
                  class="form-control fc-datepicker fs-12"
                  placeholder="{{ $options['placeholder'] }}"
                  autocomplete="off"
                />
                <input
                  id="{{ $name }}-hide"
                  name="{{ $name }}"
                  type="hidden"
                  value="{{ request($name) }}"
                />
                @break

              @default
                {{-- fallback input --}}
                <input
                  id="{{ $name }}"
                  name="{{ $name }}"
                  type="text"
                  class="form-control fs-12"
                  placeholder="{{ $options['placeholder'] ?? '' }}"
                  value="{{ request($name) }}"
                  autocomplete="off"
                />
            @endswitch
          </fieldset>
        </div>
      @endforeach

      @foreach (array_filter($inputs, fn ($arr) => $arr['type'] == 'hidden') as $name => $options)
        <input name="{{ $name }}" value="{{ $options['value'] }}" hidden />
      @endforeach

      {{ $slot }}

    </div>

    <div class="row justify-content-center mt-4" style="gap: 8px">
      <button class="btn btn-sm btn-info disableable" type="submit">جستجو و فیلتر</button>
      <button class="btn btn-sm btn-danger" type="button"
              onclick="window.location.href = window.location.origin + window.location.pathname">ریست فرم
      </button>
    </div>

  </form>
</x-card>

@push('filter-form-scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      @foreach($inputs as $input => $options)
      @if($options['type'] === 'select')
      new CustomSelect('#{{ $input }}', @json($options['placeholder']));
      @elseif($options['type'] === 'date')
      $('#{{ $input }}-show').MdPersianDateTimePicker({
        targetDateSelector: '#{{ $input }}-hide',
        targetTextSelector: '#{{ $input }}-show',
        englishNumber: false,
        toDate: true,
        dateFormat: 'yyyy-MM-dd',
        textFormat: 'yyyy-MM-dd',
        groupId: 'rangeSelector1',
      });
      @endif
      @endforeach
    });
  </script>
@endpush
