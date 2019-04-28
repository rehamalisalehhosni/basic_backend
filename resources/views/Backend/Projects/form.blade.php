@if(isset($data))
{{ Form::hidden('projects_translations_id_'.$locale, $data->projects_translations_id) }}
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
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Video:</strong>
    <?php
    if(isset($data)&&$data->video){
      $video=$data->video;
    }else{
      $video=null;
    }
    ?>
    {!! Form::text('video_'.$locale, $video , array('placeholder' => 'Video','class' => 'form-control')) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Client:</strong>
    <?php
    if(isset($data)&&$data->clients){
      $clients=$data->clients;
    }else{
      $clients=null;
    }
    ?>
    {!! Form::text('clients_'.$locale, $clients , array('placeholder' => 'Client','class' => 'form-control')) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Status:</strong>
    <?php
    if(isset($data)&&$data->status){
      $status=$data->status;
    }else{
      $status=null;
    }
    ?>
    {!! Form::text('status_'.$locale, $status , array('placeholder' => 'Status','class' => 'form-control')) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Location:</strong>
    <?php
    if(isset($data)&&$data->location){
      $location=$data->location;
    }else{
      $location=null;
    }
    ?>
    {!! Form::text('location_'.$locale, $location , array('placeholder' => 'Location','class' => 'form-control')) !!}
  </div>
</div>

@if (isset($data) && $data->main_image)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <img src="{{url('/Uploads/projects/'.$locale.'/'.$data->main_image)}}" alt="" class="img-thumbnail img_view" />
  </div>
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong> Main Image :</strong>
    {!! Form::file('main_image_'.$locale, null, array('placeholder' => 'Image','class' => 'form-control')) !!}
  </div>
</div>
@if (isset($data) && $data->ProjectsImages)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    @foreach($data->ProjectsImages as  $image)
    <div class="imgsProjects lis" id="{{$image->projects_images_id}}" >
      <i class="fa fa-trash-o" aria-hidden="true"></i>
      <img src="{{url('/Uploads/projects/project_images/'. $image->image)}}" alt="" class="img-thumbnail img_view" />
    </div>
    @endforeach
  </div>
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>  Images :</strong>
    {!! Form::file('images_'.$locale.'[]',  ['multiple' => 'multiple'], array('placeholder' => 'images','class' => 'form-control')) !!}
  </div>
</div>
@if (isset($data) && $data->ProjectsPlans)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    @foreach($data->ProjectsPlans as  $image)
    <div class="imgsPlan lis" id="{{$image->projects_plans_id}}" >
      <i class="fa fa-trash-o" aria-hidden="true"></i>
      <img src="{{url('/Uploads/projects/projects_plans/'. $image->image)}}" alt="" class="img-thumbnail img_view" />
    </div>
    @endforeach
  </div>
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>  Plans :</strong>
    {!! Form::file('plans_'.$locale.'[]',  ['multiple' => 'multiple'], array('placeholder' => 'images','class' => 'form-control')) !!}
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
if(isset($data)&&$data->presentation){
  $presentation=$data->presentation;
}else{
  $presentation=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Presentation:</strong>
    {!! Form::textarea('presentation_'.$locale, $presentation, array('placeholder' => 'Description','class' => 'form-control tinymce','style'=>'height:100px')) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <?php
    if(isset($data)&&$data->publish){
      $publish="checked";
    }else{
      $publish=null;
    }
    ?>

    <strong>Publish:</strong>
    {!! Form::checkbox('publish_'.$locale, 1,null, array('checked'=>$publish)) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <?php
    if(isset($data)&&$data->show_home){
      $show_home="checked";
    }else{
      $show_home=null;
    }
    ?>
    <strong>show Home:</strong>
    {!! Form::checkbox('show_home_'.$locale, 1 ,null, array('checked'=>$show_home)) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <?php
    if(isset($data)&&$data->gallary){
      $gallary="checked";
    }else{
      $gallary=null;
    }
    ?>
    <strong>show Gallary:</strong>
    {!! Form::checkbox('gallary_'.$locale, 1 ,null, array('checked'=>$gallary)) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
  <?php
  if(isset($data)&&$data->projects_category_id){
    $projects_category_id=$data->projects_category_id;
  }else{
    $projects_category_id=null;
  }
  ?>
  <strong> Projects Category :</strong>
  {!! Form::select('projects_category_id_'.$locale, $projectsCategory,$projects_category_id,['class' => 'form-control']) !!}
</div>
</div>
