<form action="javascript:void(0)" method="post" id="info-form">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="guild_name" placeholder="{{ __('guild name') }}"
            value="{{ $data->guild_name }}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="fullname" placeholder="{{ __('fullname') }}"
            value="{{ $data->fullname }}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="national_id" placeholder="{{ __('national id') }}"
            value="{{ $data->national_id }}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="catagory" placeholder="{{ __('catagory') }}"
            value="{{ $data->catagory }}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="city"
                placeholder="{{ __('city') }}"
                value="{{ $data->city_id }}"
                disabled>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="guild_number"
                placeholder="{{ __('guild number') }}"
                value="{{ $data->guild_number }}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="tel" placeholder="{{ __('phone') }}"
            value="{{ $data->tel }}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="mobile" placeholder="{{ __('mobile') }}"
            value="{{ $data->mobile }}">
        </div>
        <div class="input-group mb-3">
            <textarea type="text" class="form-control" name="address" placeholder="{{ __('address') }}"
            value="{{ $data->address }}"></textarea>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="price" placeholder="{{ __('price') }}"
            value="{{ $data->price }}">
        </div>
        <div class="input-group mb-3">
            <button class="btn btn-success" onclick="edit_info()">{{ __('Edit') }}</button>
        </div>
    </div>

</form>

<hr>
<form action="javascript:void(0)" method="post" id="fin-form" class="row">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div class="col-sm-4">
        {{__('fin validation')}}
    </div>
    <div class="col-sm-4">
        <p>{{__('price payment file')}}</p>
        @if ($data->price_payment_file)
            <img src="{{ url($data->price_payment_file) }}" alt="" width="200">
        @else
            <p style="color: red">
            هنوز آپلود نشده است
            </p>
        @endif
    </div>
    <div class="col-sm-4">
        {{__('fin validation')}}
        <select name="fin_validation" class="form-control" id="">
            <option value="0">{{__('declined')}}</option>
            <option value="1" @if($data->fin_validation) selected @endif>{{__('approved')}}</option>
        </select>
        <button class="btn btn-success" onclick="fin_validate()">{{ __('save') }}</button>
    </div>
</form>

<hr>
<form action="javascript:void(0)" method="post" id="nerkhnameh-form" enctype="multipart/form-data">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div class="row">
        <div class="col-sm-4">
            @if ($data->nerkhnameh_word_file)
                <a href="{{ url($data->nerkhnameh_word_file) }}">{{__('download word file')}}</a><br>
            @else
                <button class="btn btn-danger" onclick="create_nerkhnameh()">{{ __('create nerkhnameh') }}</button>
            @endif
            @if ($data->nerkhnameh_file)
                <a href="{{ url($data->nerkhnameh_file) }}">{{__('download pdf file')}}</a><br>
            @endif
        </div>
        <div class="col-sm-4">
            {{__('nerkhnameh pdf file upload')}}

            <input type="file" class="form-control col-sm-12" name="nerkhnameh_file" id="">
            <button class="btn btn-success" onclick="save_nerkhnameh()">{{ __('save') }}</button>

        </div>
    </div>
    <div class="input-group mb-3">
    </div>
</form>


<script>
    function edit_info(){
        var form = $('#info-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.edit') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }


    function fin_validate(){
        var form = $('#fin-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.edit') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }

    function create_nerkhnameh(){
        var form = $('#nerkhnameh-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.createNerkhnameh') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
                show_edit_modal("{{ $data->id }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }

    function save_nerkhnameh(){
        var form = $('#nerkhnameh-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.edit') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }
</script>
