     <div class="card-body">
    <div class="form-group">
        @csrf
        <label class="form-label">Address Line 1</label><span class="text-danger">*</span>
        <input type="text" name="address_line_1" class="form-control" placeholder="House No.,Building name" value="{{ old('address_line_1',$address->address_line_1)}}">
        @if ($errors->has('address_line_1'))
            <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
        @endif
    </div>
    <div class="form-group">
        <input type="hidden" name="addressId" value="{{ $address->id }}">
        <label class="form-label">Address Line 2</label><span class="text-danger">*</span>
        <input type="text" name="address_line_2" placeholder="Road name,area,colony" class="form-control" value="{{old('address_line_2',$address->address_line_2)}}">
        @if ($errors->has('address_line_2'))
            <span class="text-danger">{{ $errors->first('address_line_2') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label class="form-label">Address Line 3</label>
        <input type="text" name="address_line_3" placeholder="Landmark" class="form-control" value="{{old('address_line_3',$address->address_line_3)}}">
        @if ($errors->has('address_line_3'))
            <span class="text-danger">{{ $errors->first('address_line_3') }}</span>
        @endif
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label class="form-label">Country</label><span class="text-danger">*</span>
            <select class="form-control country-dropdown" name="country_id" id="country">
                @if( isset($countries) &&  count($countries))
                    @foreach($countries as $country)
                        <option value="{{$country->id}}" {{ $address->country->id == $country->id ? 'selected' : ''  }}>{{ $country->name }}</option>
                    @endforeach
                @endif
            </select>
            @if ($errors->has('country_id'))
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label class="form-label">State</label><span class="text-danger">*</span>
            <!--state append from ajax request on country change-->
            <input type="hidden" id="user_selected_state_id" value="{{ $address->state->id }}">
            <select class="form-control state-dropdown" name="state_id" id="state">
                <!--options dynamic-->
            </select>
            @if ( $errors->has('state_id') )
                <span class="text-danger">{{ $errors->first('state_id') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label class="form-label">City</label><span class="text-danger">*</span>
            <!--city append from ajax request on state change-->
            <input type="hidden" id="user_selected_city_id" value="{{ $address->city->id }}">
            <select class="form-control city-dropdown" name="city_id" id="city">
                <!--options dynamic-->
            </select>
            @if ($errors->has('city_id'))
                <span class="text-danger">{{ $errors->first('city_id') }}</span>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label class="form-label">Pincode</label><span class="text-danger">*</span>
            <input type="text" name="post_code" class="form-control" value="{{old('post_code',$address->post_code)}}">
            @if ($errors->has('post_code'))
                <span class="text-danger">{{ $errors->first('post_code') }}</span>
            @endif
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#country').trigger('change')
        $('#state').trigger('change')
        //$('#state').val('{{ $address->state->id }}').trigger('change.select2')
        $("#country").on('change',function (){
            let countryId = $(this).val();
            let state = $("#state");
            if(countryId){
                $.ajax({
                    url: getStatesByCountry,
                    dataType: 'Json',
                    data: {'countryId':countryId},
                    success: function(response) {
                        if(response.data){
                            // Append states
                            state.empty();
                            $.each(response.data.states, function(key, stateObj) {
                                if('{{ $address->state->id }}' == stateObj.id) {
                                    var selected = 'selected="selected"';
                                } else{
                                    var selected = '';
                                }
                                state.append('<option value="'+ stateObj.id +'" '+selected+'>'+ stateObj.name +'</option>');
                            });
                        }
                    },
                    error:function (jqXHR){
                        state.empty();
                        console.error(jqXHR.responseJSON.message);
                    }
                });
            }
            state.empty();
        });

        /**
         * On State change
         */
        $("#state").on('change',function (){
            let stateId = $(this).val();
            let city = $("#city");
            if(stateId){
                $.ajax({
                    url: getCitiesByState,
                    dataType: 'Json',
                    data: {'stateId': stateId },
                    success: function(response) {
                        if(response.data){
                            // Append states
                            city.empty();
                            $.each(response.data.cities, function(key, cityObj) {
                                if('{{ $address->city->id }}' == cityObj.id) {
                                    var selected = 'selected="selected"';
                                } else{
                                    var selected = '';
                                }
                                city.append('<option value="'+ cityObj.id +'" '+selected+'>'+ cityObj.name +'</option>');
                            });
                        }
                    },
                    error:function (jqXHR){
                        city.empty();
                        console.error(jqXHR.responseJSON.message);
                    }
                });
            }
            city.empty();
        });
    })
</script>
