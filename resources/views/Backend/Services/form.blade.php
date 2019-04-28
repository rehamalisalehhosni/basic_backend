@if(isset($data))
{{ Form::hidden('services_translations_id_'.$locale, $data->services_translations_id) }}
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Title:</strong>
    <?php
    if(isset($data)&&$data->title){
      $title=$data->title;
    }else{
      $title=null;
    }
    ?>
    {!! Form::text('title_'.$locale, $title , array('placeholder' => 'Title','class' => 'form-control')) !!}
  </div>
</div>

@if (isset($data) && $data->image)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <img src="{{url('/Uploads/services/'.$locale.'/'.$data->image)}}" alt="" class="img-thumbnail img_view" />
  </div>
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong> Image :</strong>
    {!! Form::file('image_'.$locale, null, array('placeholder' => 'Image','class' => 'form-control')) !!}
  </div>
</div>
<?php
if(isset($data)&&$data->description){
  $description=$data->description;
}else{
  $description=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Description:</strong>
    {!! Form::textarea('description_'.$locale, $description, array('placeholder' => 'Description','class' => 'form-control tinymce','style'=>'height:100px')) !!}
  </div>
</div>

<?php
if(isset($data)&&$data->sort){
  $sort=$data->sort;
}else{
  $sort=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group ">
    <strong>Sort:</strong>
    {!! Form::text('sort_'.$locale, $sort, array('placeholder' => 'Sort','class' => 'form-control  ')) !!}
  </div>
</div>
