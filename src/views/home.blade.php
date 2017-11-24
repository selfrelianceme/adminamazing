@extends('adminamazing::teamplate')

@section('pageTitle', 'Панель управления')
@push('display')
    <a href="{{route('AdminBlocks')}}"><button type="button" class="btn btn-info btn-md">Редактировать блоки</button></a>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @if(count($blocks) > 0)
                <div class="grid-stack" data-gs-width="12" data-gs-height="12" data-gs-animate="yes">
                    @foreach($blocks as $block)
                        <div class="grid-stack-item" data-id="{{$block->id}}" data-gs-x="{{$block->posX}}" data-gs-y="{{$block->posY}}" data-gs-width="{{$block->width}}" data-gs-height="{{$block->height}}" data-gs-no-resize="yes" data-gs-no-move="yes" style="padding-left: 5px; padding-right: 5px;">
                            <div class="col-12 grid-stack-item-content">{!!\Blocks::get($block->view)!!}</div>
                        </div>
                    @endforeach
                </div>
            @else
            <div class="card card-block">
                <div class="alert text-center">
                    <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> На данный момент отсутствуют блоки, <a href="{{route('AdminBlocks')}}"><i class="fa fa-map-marker" aria-hidden="true"></i> добавить</a>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('vendor/adminamazing/assets/plugins/jqueryui/jquery-ui.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script src="{{ asset('vendor/adminamazing/assets/plugins/gridstack/lodash.js') }}"></script>
        <script src="{{ asset('vendor/adminamazing/assets/plugins/gridstack/gridstack.js') }}"></script>
        <script src="{{ asset('vendor/adminamazing/assets/plugins/gridstack/gridstack.jQueryUI.js') }}"></script>
        <script type="text/javascript">
        $(function() {
            $('.grid-stack').gridstack({
                width: 12,
                alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
                resizable: {
                    handles: 'e, se, s, sw, w'
                }
            });
        });
        </script>
    @endpush
@endsection