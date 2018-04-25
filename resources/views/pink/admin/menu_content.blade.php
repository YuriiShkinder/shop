<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Пользователи</h3>


        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>

                <th>Name</th>
                <th>Link</th>

                <th>Удалить</th>
                </thead>
                @if($menus)

                    @include('pink'.'.admin.custom-menu-items', array('items' => $menus->roots(),'paddingLeft' => ''))


                @endif
            </table>
        </div>
        {!! HTML::link(route('admin.menus.create'),'Добавить  пункт',['class' => 'btn btn-the-salmon-dance-3']) !!}

    </div>
</div>


{{--@if($menus)--}}
    {{--<div id="content-page" class="content group">--}}
        {{--<div class="hentry group">--}}
            {{--<h2>Добавленные меню</h2>--}}
            {{--<div class="short-table white">--}}
                {{--<table style="width: 100%" cellspacing="0" cellpadding="0">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>id</th>--}}
                        {{--<th>Заголовок</th>--}}
                        {{--<th>parent_id</th>--}}
                        {{--<th>Дествие</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@foreach($menus as $menu)--}}
                        {{--<tr>--}}
                            {{--<td>{{$menu->id}}</td>--}}
                            {{--<td class="align-left">{!! Html::link(route('admin.menus.edit',['menu'=>$menu->id]),$menu->title) !!}</td>--}}
                            {{--<td>{{$menu->parent_id}}</td>--}}
                            {{--<td>--}}
                                {{--{!! Form::open(['url' => route('admin.menus.destroy',['munu'=>$menu->id]),'class'=>'form-horizontal','method'=>'POST']) !!}--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--{!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}--}}
                                {{--{!! Form::close() !!}--}}
                            {{--</td>--}}
                        {{--</tr>--}}

                    {{--@endforeach--}}

                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}

            {{--{!! HTML::link(route('admin.menus.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-3']) !!}--}}


        {{--</div>--}}
        {{--<!-- START COMMENTS -->--}}
        {{--<div id="comments">--}}
        {{--</div>--}}
        {{--<!-- END COMMENTS -->--}}
    {{--</div>--}}
{{--@endif--}}