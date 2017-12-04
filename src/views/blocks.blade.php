@extends('adminamazing::teamplate')

@section('pageTitle', 'Редактирование блоков')
@section('content')
    <div class="row">   
        <div class="col-12">
            <div class="card">
                @if(count($availableBlocks) > 0)
                <form action="{{route('AdminBlocksAdd')}}" method="POST" class="form-horizontal">
                    <select class="form-control" name="selected_blocks[]" multiple size="{{ count($availableBlocks) }}">
                    @foreach($availableBlocks as $block)
                    <option value="{{$block}}">{{$block}}</option>
                    @endforeach
                    </select>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-success btn-block">Добавить блок</button>
                </form>
                @endif
                <div class="card-block">
                    <div class="grid-stack" data-gs-width="12" data-gs-animate="yes">
                        @foreach($blocks as $block)
                            @if(\Blocks::has($block->view))
                            <div class="grid-stack-item" data-id="{{$block->id}}" data-gs-x="{{$block->posX}}" data-gs-y="{{$block->posY}}" data-gs-width="{{$block->width}}" data-gs-height="{{$block->height}}" data-gs-no-resize="no">
                                <div class="col-12 grid-stack-item-content">
                                    <div style = "position: absolute; top: 0; right: 0; z-index: 1;">
                                        <form action="{{route('AdminBlockDelete', $block->id)}}" method="POST">
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-danger">
                                                <span class="fa fa-trash-o" aria-hidden="true"></span>
                                            </button>
                                            {{csrf_field()}}
                                        </form>
                                    </div>
                                    {!!\Blocks::get($block->view)!!}
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>       
    </div>

    @push('scripts')
        <script>var route = '{{ route('AdminBlocksUpdate') }}'</script>
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