<!-- klaravel::ui.forms.radios -->
<div class="form-group">
  <label class="form-control-label">{!! $label !!}</label>
  <div>
    @foreach ($items as $itemKey => $itemLabel)
      <?php $iLabel = $itemLabel ??  $itemKey;?>
      <div class="form-check form-check-inline">
        <input class="form-check-input"
          {{ $itemKey == $value ? ' checked' : ''}}
          type="radio" name="{{ $name }}"
          id="check-{{ $name }}-{{ $loop->iteration }}"
          value="{{ $itemKey }}">
        <label class="form-check-label" for="check-{{ $name }}-{{ $loop->iteration }}">{{ $iLabel }}</label>
      </div>
    @endforeach
  </div>
</div>
