<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($category->id)) ? route('admin.categories.update',['alias'=>$category->alias]) : route('admin.categories.store'),'class'=>'contact-form','method'=>'POST']) !!}

        <ul>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Заголовок:</span>
                    <br />
                    <span class="sublabel">Заголовок пункта</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('title',isset($category->title) ? $category->title  : old('title'), ['placeholder'=>'Введите название катигории']) !!}
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Alias:</span>
                    <br />
                    <span class="sublabel">Заголовок alias</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('alias',isset($category->alias) ? $category->alias  : old('alias'), ['placeholder'=>'Введите alias катигории']) !!}
                </div>
            </li>


            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Родительский пункт меню:</span>
                    <br />
                    <span class="sublabel">Родитель:</span><br />
                </label>
                <div class="input-prepend">
                    {!! Form::select('parent', $categories, isset($category->alias) ? $category->category_id: null) !!}
                </div>

            </li>
        </ul>




            </ul>



        </div>

        <br />

        @if(isset($category->id))
            <input type="hidden" name="_method" value="PUT">

        @endif
        <ul>
            <li class="submit-button">
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
            </li>
        </ul>







        {!! Form::close() !!}


    </div>
</div>

<script>

    jQuery(function($) {

        $('#accordion').accordion({

            activate: function(e, obj) {
                obj.newPanel.prev().find('input[type=radio]').attr('checked','checked');
            }

        });

        var active = 0;
        $('#accordion input[type=radio]').each(function(ind,it) {

            if($(this).prop('checked')) {
                active = ind;
            }

        });

        $('#accordion').accordion('option','active', active);

    })

</script>