@if(isset($data))
{{ Form::hidden('projects_category_translations_id_'.$locale, $data->projects_category_translations_id) }}
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
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong> Main Category :</strong>
    <select class="form-control selectpicker"  name="parent_<?php echo $locale ?>"  data-live-search="true">
      <option value="0"  @if(isset($data)&&$data->projects_category_id) @if(0 == $data->projects_category_id) selected="selected" @endif @endif>Main Category</option>
      @foreach($projectsCategory as $it)
      @if($it->locale==$locale)
        <option value="{{$it->projects_category_id}}" @if(isset($data)&&$data->projects_category_id) @if($data->parent == $it->projects_category_id) selected="selected" @endif @endif>{{$it->title}}</option>
      @endif
      @endforeach
    </select>
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong> Theme :</strong>
    <select class="form-control selectpicker"  name="theme_<?php echo $locale ?>"  data-live-search="true">
      <option value="0"  @if(isset($data)&&$data->theme) @if(0 == $data->theme) selected="selected" @endif @endif>theme</option>
        <option value="1" @if(isset($data)&&$data->theme) @if($data->theme == 1) selected="selected" @endif @endif>Theme for urban Design Category</option>
        <option value="2" @if(isset($data)&&$data->theme) @if($data->theme == 2) selected="selected" @endif @endif>Theme for master planning Category</option>
        <option value="3" @if(isset($data)&&$data->theme) @if($data->theme == 3) selected="selected" @endif @endif>Theme for Architecture Category</option>
    </select>
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
