@foreach($categories->down as $category)
    <tr>
        <td class="align-left">{!! Html::link(route('adminDown',['alias'=>$categories->alias,'down'=>$category->alias]),$categories->title.' / '.$category->title) !!}</td>
        <td>{{$category->alias}}</td>
        <td>{{route('down',['categories'=>$categories->alias,'down'=>$category->alias])}}</td>
        <td>
            {!! Form::open(['url' => route('adminDown',['categories'=>$categories->alias,'down'=>$category->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
            {{ method_field('DELETE') }}
            {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach