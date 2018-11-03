<!-- klaravel::ui.modal -->
<?php $curModalId = isset($modalId) ? $modalId : 'modal-klara-'.rand(10000,1111222); ?>
<div class="modal fade" id="{{$curModalId}}" tabindex="-1" role="dialog" aria-labelledby="{{$curModalId}}Label" aria-hidden="true">
  <div class="modal-dialog modal-{{isset($size)?$size:'sm'}}" role="document">
    <div class="modal-content">
      <div class="modal-header">
          @isset($title)
              <h5 class="modal-title" id="{{$curModalId}}Label">{{$title}}</h5>
          @endisset
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{$slot ?? ''}}
    </div>
  </div>
</div>
