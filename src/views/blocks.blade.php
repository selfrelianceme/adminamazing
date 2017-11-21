@extends('adminamazing::teamplate')

@section('pageTitle', 'Редактирование блоков')
@section('content')
    <div class="row">   
        <div class="col-12">
            <div class="card">
                <form action="{{route('AdminBlocksAdd')}}" method="POST" class="form-horizontal">
                    <select class="form-control" name="selected_blocks[]" multiple size="{{ count(\Blocks::all()) }}">
                    @foreach(\Blocks::all() as $key => $block)
                    <option value="{{$key}}">{{$key}}</option>
                    @endforeach
                    </select>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-success btn-block">Добавить блок</button>
                </form>
                <div class="card-block">
                    <div class="grid-stack" data-gs-width="12" data-gs-animate="yes">
                        @foreach($blocks as $block)
                        <div class="grid-stack-item" data-id="{{$block->id}}" data-gs-x="{{$block->posX}}" data-gs-y="{{$block->posY}}" data-gs-width="3" data-gs-height="4" data-gs-no-resize="yes">
                            <div class="grid-stack-item-content">
                                <form action="{{route('AdminBlockDelete', $block->id)}}" method="POST">
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span> Удалить
                                    </button>
                                </form>
                                {!!\Blocks::get($block->view)!!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>       
    </div>

    @push('scripts')
        <script>var route = '{{ route('AdminBlockUpdate') }}'</script>
<!--         <script src="{{ asset('vendor/adminamazing/assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('vendor/adminamazing/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
        <script src="{{ asset('vendor/adminamazing/js/dashboard5.js') }}"></script> -->
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