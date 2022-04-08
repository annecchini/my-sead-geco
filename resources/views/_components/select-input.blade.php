{{-- 
    Variaveis utilizadas:
        $inputId
        $inputName
        $inputLabel
        $inputEmptyOption (opcional)
        $itemList
        $optionValueFunction (opcional)
        $optionNameFunction (opcional)
        $errorList
        $errorField (opcional)
        $resourceToUpdate (opcional, usado em edit)
    Observações sobre selectize:
        É necessário rodar um javascript para ativar o selectize. Ele não fica aqui por que o Jquery precisa ser carregado primeiro.
        O Jquery está em app.js que é carregado com a opção defer.
        Então criar resources/js o arquivo que também será carregado com defer em cada pagina.
--}}
@php $errorField = isset($errorField) ? $errorField :  $inputName; @endphp
<div class="form-group">
    <label for="{{$inputId}}">{{$inputLabel}}</label>
    <select id="{{$inputId}}"
        class="form-control {{ $errorList->has($errorField) ? 'is-invalid' : ''}}"
        name="{{$inputName}}">
        @if(isset($inputEmptyOption))<option value="">{{$inputEmptyOption}}</option>@endif
        @foreach ( $itemList as $item )
            @php $optionValue = isset($optionValueFunction) ? $optionValueFunction($item) : $item->id; @endphp
            @php $optionName = isset($optionNameFunction) ? $optionNameFunction($item) : $item->name; @endphp
            @php $selectedValue = !isset($resourceToUpdateValue) ? old( $inputName ) : old( $inputName , $resourceToUpdateValue); @endphp
            <option value="{{ $optionValue }}" {{ $selectedValue == $optionValue ? 'selected' : '' }}>
                {{$optionName}}
            </option>
        @endforeach
    </select>
    @if( $errorList->has($errorField) )
        <div class="invalid-feedback">{{ $errorList->first($errorField) }}</div>
    @endif
</div>

