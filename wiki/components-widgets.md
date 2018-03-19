# Widgets

All this Widgets are based on Bootstrap4, additional configuration can be done by the use
of predefined classes, you can find more in the [official Bootstrap4 documentation](https://getbootstrap.com/docs/4.0/components/).

#### Alert

```
@component('klaravel::ui.alert', [
    'title' => 'Alert title',
    'type' => 'warning',
    'class' => 'my-3',
])
    This is my message for the alert
@endcomponent
```

#### Badge

```
@component('klaravel::ui.badge', ['type' => 'primary'])
    {{$marca->name}}
@endcomponent
```

#### Card

```
@card([
  'title' => 'Klaravel control center',
  'reload_btn' => true,
  'tabs' => ['en' => 'English', 'es' => 'Spanish'], // Yes you can trigger tabs.
  'style' => 'margin-top:62px;',
  'class' => 'mb-4'
  ])
    @include('back.users.multilingue-form')
@endcard
```

#### Figure

```
@component('klaravel::ui.figure', [
  'class' => 'my-5',
  'caption' => 'This is the media descripion.'
])
    {{$marca->name}}
@endcomponent
```

#### List group

```
@component('klaravel::ui.list-group', [
  'class' => 'my-5',
  'items' => ['item 1', 'item 2']
])
  <li class="list-group-item">Off array item</li>
@endcomponent
```

#### Carousel

```
@include('klaravel::ui.carousel', [
  'id' => 'myCarousel1',
  'class' => 'my-5',
  'controls' => true,
  'indicators' => true,
  'items' => [
    '<img class="d-block w-100" src="..." alt="First slide">',
    '<img class="d-block w-100" src="..." alt="First slide">',
    '<img class="d-block w-100" src="..." alt="First slide">',
  ]
])
```


#### Modal

```
@component('klaravel::ui.modal', [
    'title' => 'My modal title',
    'modalId' => 'myComponentModal',
    'size' => 'lg'
])
    @includeIf('parts.modal-with-form-body')
@endcomponent
```

And this could be the body of your modal on a separate file `parts/modal-with-form-body.blade.php`

```
{!! Former::open()->route('contact.submit')->id('my-modal-form') !!}
    <div class="modal-body">
        {!! Former::text('name')->required()->label('Your name')->placeholder('John Smith') !!}
    </div>
    <div class="modal-footer justify-content-center py-4">
        <button type="submit" class="btn btn-primary">Submit form</button>
    </div>
{!! Former::close() !!}
```


#### Tab

```
@component('klaravel::ui.tab', [
  'tabs' => [
    'settings' => 'Settings',
    'photos' => '<span class="text-primary"><i class="far fa-images mr-1"></i> Photos</span>'
  ]
])
    <div id="settings" class="tab-pane fade active show" role="tabpanel" aria-labelledby="settings-tab">
        {!! Former::open()
            ->route($model_name . '.update', $record->id  )
            ->populate( $record )
            ->open_for_files() !!}
            @include ('backend.'.$model_name.'.form', ['submitButtonText' => 'Update records'])
        {!! Former::close() !!}
    </div>
    <div class="tab-pane fade" id="fotos" role="tabpanel" aria-labelledby="fotos-tab">
        @include('backend.'.$model_name.'.media')
    </div>
@endcomponent
```

#### Card Deck (Media)

```

```
