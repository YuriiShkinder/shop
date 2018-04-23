@if($categories)
    <div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Добавленные категории</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Псевдоним</th>
                        <th>path</th>
                        <th>Дествие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="align-left">{!! Html::link(route('admin.categories.edit',['alias'=>$category->alias]),$category->title) !!}</td>
                            <td>{{$category->alias}}</td>
                            <td>{{route('categories.show',['alias'=>$category->alias])}}</td>
                            <td>
                                {!! Form::open(['url' => route('admin.categories.destroy',['articles'=>$category->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                {{ method_field('DELETE') }}
                                {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @if($category->down)
                            @include(env('THEME').'.admin.custom_category_item', array('categories' => $category,'paddingLeft' => '--'))

                        @endif
                    @endforeach



                    </tbody>
                </table>
            </div>

            {!! HTML::link(route('admin.categories.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-3']) !!}


        </div>
        <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>
@endif