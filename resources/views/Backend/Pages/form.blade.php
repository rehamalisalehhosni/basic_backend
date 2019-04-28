@if(isset($data))
{{ Form::hidden('pages_translations_id_'.$locale, $data->pages_translations_id) }}
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
    <img src="{{url('/Uploads/pages/'.$locale.'/'.$data->image)}}" alt="" class="img-thumbnail img_view" />
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
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong> Page :</strong>
    <select class="form-control selectpicker"  name="page_<?php echo $locale ?>"  data-live-search="true">
      <option value="Home Page"  @if(isset($data)&&$data->page) @if('Home Page' == $data->page) selected="selected" @endif @endif>Home Page</option>
        <option value="Contact us" @if(isset($data)&&$data->page) @if($data->page == 'Contact us') selected="selected" @endif @endif>Contact us</option>
        <option value="About Us" @if(isset($data)&&$data->page) @if($data->page == 'About Us') selected="selected" @endif @endif>About Us</option>
        <option value="Services" @if(isset($data)&&$data->page) @if($data->page == 'Services') selected="selected" @endif @endif>Services</option>
        <option value="Project" @if(isset($data)&&$data->page) @if($data->page == 'Project') selected="selected" @endif @endif>Project</option>
        <option value="Statistic" @if(isset($data)&&$data->page) @if($data->page == 'Statistic') selected="selected" @endif @endif>Statistic</option>
        <option value="Footer" @if(isset($data)&&$data->page) @if($data->page == 'Footer') selected="selected" @endif @endif>Footer</option>
        <option value="Project details" @if(isset($data)&&$data->page) @if($data->page == 'Project details') selected="selected" @endif @endif>Project details</option>
        <option value="404" @if(isset($data)&&$data->page) @if($data->page == '404') selected="selected" @endif @endif>404</option>
    </select>
  </div>
</div>

<?php
if(isset($data)&&$data->video){
  $sort=$data->video;
}else{
  $sort=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group ">
    <strong>Video:</strong>
    {!! Form::text('video_'.$locale, $sort, array('placeholder' => 'Video','class' => 'form-control  ')) !!}
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
