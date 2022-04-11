    {{--         
        dateId
        dateLabel
        dateName
        dateDefaultValue (opcional)
        dateResourceValue
        
        timeId
        timeLabel
        timeName
        timeDefaultValue (opcional)
        timeResourceValue

        errorList
        errorDateField (opcional)
        errorTimeField (opcional)

    --}}


    @php 
        $dateDefaultValue = isset($dateDefaultValue) ? $dateDefaultValue : '';
        $dateSelectedValue = !isset($dateResourceValue) ? old( $dateName, $dateDefaultValue ) : old( $dateName , $dateResourceValue);

        $timeDefaultValue = isset($timeDefaultValue) ? $timeDefaultValue : '';
        $timeSelectedValue = !isset($timeResourceValue) ? old( $timeName, $timeDefaultValue ) : old( $timeName , $timeResourceValue);

        $errorDateField = isset($errorDateField) ? $errorDateField :  $dateName;
        $errorTimeField = isset($errorTimeField) ? $errorTimeField :  $timeName; 
    @endphp

    <div class="form-row">
        <div class="form-group col-6">
            <label for="{{$dateId}}">{{$dateLabel}}</label>
            <input class="form-control {{ $errors->has($errorDateField) ? 'is-invalid' : ''}}" id="{{$dateId}}" type="date" value="{{ $dateSelectedValue }}" name="{{$dateName}}">
            @if( $errors->has($errorDateField) )
                <div class="invalid-feedback">{{ $errors->first($errorDateField) }}</div>
            @endif
        </div>

        <div class="form-group col-6">
            <label for="{{$timeId}}">{{$timeLabel}}</label>
            <input class="form-control {{ $errors->has($errorTimeField) ? 'is-invalid' : ''}}" id="{{$timeId}}" type="time" step="1" value="{{ $timeSelectedValue }}" name="{{$timeName}}">
            @if( $errors->has($errorTimeField) )
                <div class="invalid-feedback">{{ $errors->first($errorTimeField) }}</div>
            @endif
        </div>
    </div>