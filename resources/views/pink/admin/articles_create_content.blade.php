<div id="content-page" class="content group">
				            <div class="hentry group">

{!! Form::open(['url' => (isset($article->id)) ? route('admin.articles.update',['articles'=>$article->id]) : route('admin.articles.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul>
		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Название:</span>
				<br />
				<span class="sublabel">Заголовок товара</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
			{!! Form::text('title',isset($article->title) ? $article->title  : old('title'), ['placeholder'=>'Введите название товара']) !!}
			 </div>
		 </li>

		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Количество:</span>
				<br />
				<span class="sublabel">Количество товара</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
				{!! Form::text('count',isset($article->count) ? $article->count  : old('title'), ['placeholder'=>'Введите название товара']) !!}
			</div>
		</li>

		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Цена:</span>
				<br />
				<span class="sublabel">Цена товара</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
				{!! Form::text('price',isset($article->price) ? $article->price  : old('title'), ['placeholder'=>'Введите название товара']) !!}
			</div>
		</li>
		 

		 
		 <li class="textarea-field">
			<label for="message-contact-us">
				 <span class="label">Краткое описание:</span>
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
			{!! Form::textarea('desc', isset($article->desc) ? $article->desc  : old('desc'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст товара']) !!}
			</div>
			<div class="msg-error"></div>
		</li>
		
		<li class="textarea-field">
			<label for="message-contact-us">
				 <span class="label">Описание:</span>
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
			{!! Form::textarea('text', isset($article->text) ? $article->text  : old('text'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'Введите текст товара']) !!}
			</div>
			<div class="msg-error"></div>
		</li>
		
		@if(isset($article->img->path))
			<li class="textarea-field">
				
				<label>
					 <span class="label">Изображения материала:</span>
				</label>
				
				{{ Html::image($article->img->path,'',['style'=>'width:400px']) }}
				{!! Form::hidden('old_image',$article->img->path) !!}
			
				</li>
		@endif
		
		
		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Изображение:</span>
				<br />
				<span class="sublabel">Изображение материала</span><br />
			</label>
			<div class="input-prepend">
				{!! Form::file('img', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
			 </div>
			 
		</li>
		
		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Категория:</span>
				<br />
				<span class="sublabel">Категория товара</span><br />
			</label>


			<div class="input-prepend">
				{!! Form::select('category_id', $categories,isset($article->id) ? ($article->categories()->first()->id)  : '') !!}
			 </div>
			 
		</li>	 
		
		@if(isset($article->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
    
    
    
    
{!! Form::close() !!}

 <script>
	CKEDITOR.replace( 'editor' );
	CKEDITOR.replace( 'editor2' );
</script>
</div>
</div>