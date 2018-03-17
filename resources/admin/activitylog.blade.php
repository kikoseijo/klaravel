@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card([
            'title' => 'Activity logs (all)',
            'reload_btn' => true
        ])
            @component('klaravel::ui.tables.actions-menu', [
                'model_name' => 'kLogs',
                'hide_add_menu' => true,
            ])
                <li class="nav-item active mr-3">
                    <a href="{{ route('kLogs.index') }}" data-toggle="tooltip" class="nav-link text-primary" title="Clear all filters and reload">
                        <i class="far fa-eraser mr-1"></i>
                    </a>
                </li>

                @component('klaravel::ui.dropdown', [
                    'title' => '<i class="far fa-filter mr-1"></i> '. (request()->filled('tag') != ''
                                        ? model_title(request('tag'))
                                        : 'Filter by Type'),
                    'class' => '  mr-3'
                 ])
                    @foreach ($logsTags as $logsTag)
                        @php($selected = request('tag') == $logsTag ? ' active': '')
                        <a href="{{ route('kLogs.index') }}?tag={{$logsTag}}" class="dropdown-item{{ $selected}}">
                            {{$logsTag}}
                        </a>
                    @endforeach

                @endcomponent

                @component('klaravel::ui.dropdown', [
                    'title' => '<i class="far fa-filter mr-1"></i> '. (request()->filled('subject')
                                        ? model_title(request('subject'))
                                        : 'Filter by subject'),
                    'class' => '  mr-3'
                 ])
                    @foreach ($logSubjects as $logSubject)
                        @php($selected = request('subject') == $logSubject ? ' active': '')
                        <a href="{{ route('kLogs.index') }}?subject={{$logSubject}}" class="dropdown-item{{ $selected}}">
                            {{$logSubject or '-'}}
                        </a>
                    @endforeach
                @endcomponent

                <li class="nav-item active mr-3">
                    <a href="#mass-delete" onclick="massDeleteHandler()" data-toggle="tooltip" class="nav-link text-primary" title="Open mass purge dialog">
                        <i class="far fa-trash-alt mr-1" aria-hidden="true"></i> Mass purge
                    </a>
                </li>
            @endcomponent

            <nav class="text-center align-middle mt-4">
                {!! $logItems->render() !!}
            </nav>
            <div class="table-responsive my-4">
                @includeIf('klaravel::admin.activitylog-table', ['iLogs' => $logItems])
            </div>
        @endcard
    </div>
@endsection


@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function massDeleteHandler(){
            swal("A wild Pikachu appeared! What do you want to do?", {
              buttons: {
                cancel: "Run away!",
                catch: {
                  text: "Throw Pokéball!",
                  value: "catch",
                },
                defeat: true,
              },
            })
            .then((value) => {
              switch (value) {

                case "defeat":
                  swal("Pikachu fainted! You gained 500 XP!");
                  break;

                case "catch":
                  swal("Gotcha!", "Pikachu was caught!", "success");
                  break;

                default:
                  swal("Got away safely!");
              }
            });
        }
    </script>
@endpush
