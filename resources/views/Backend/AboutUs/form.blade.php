<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Title:</strong>
    @if(isset($data))
    {{ Form::hidden('aboutus_translations_id_'.$locale, $data->aboutus_translations_id) }}
    @endif
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
@if (isset($data) && $data->image)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <img src="{{url('/Uploads/aboutus/image/'.$locale.'/'. $data->image)}}" alt="" class="img-thumbnail img_view" />
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
if(isset($data)&&$data->video){
  $video=$data->video;
}else{
  $video=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group ">
    <strong>Video:</strong>
    {!! Form::text('video_'.$locale, $video, array('placeholder' => 'Video','class' => 'form-control  ')) !!}
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
