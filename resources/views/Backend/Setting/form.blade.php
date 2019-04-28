<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Company Name:</strong>
    @if(isset($data))
    {{ Form::hidden('setting_translations_id_'.$locale, $data->setting_translations_id) }}
    @endif
    <?php
    if(isset($data)&&$data->company_name){

      $company_name=$data->company_name;
    }else{
      $company_name=null;
    }
    ?>
    {!! Form::text('company_name_'.$locale, $company_name , array('placeholder' => 'Company Name','class' => 'form-control')) !!}
  </div>
</div>
<?php
if(isset($data)&&$data->email){
  $email=$data->email;
}else{
  $email=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Email:</strong>
    {!! Form::text('email_'.$locale, $email, array('placeholder' => 'Email','class' => 'form-control')) !!}
  </div>
</div>
<?php
if(isset($data)&&$data->lat){
  $lat=$data->lat;
}else{
  $lat=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>latitude:</strong>
    {!! Form::text('lat_'.$locale, $lat, array('placeholder' => 'Latitude','class' => 'form-control')) !!}
  </div>
</div>
<?php
if(isset($data)&&$data->long){
  $long=$data->long;
}else{
  $long=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>longitude:</strong>
    {!! Form::text('long_'.$locale, $long, array('placeholder' => 'Longitude','class' => 'form-control')) !!}
  </div>
</div>
<?php
if(isset($data)&&$data->address){
  $address=$data->address;
}else{
  $address=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Address:</strong>
    {!! Form::text('address_'.$locale, $address, array('placeholder' => 'Address','class' => 'form-control')) !!}
  </div>
</div>
<?php
if(isset($data)&&$data->tel){
  $tel=$data->tel;
}else{
  $tel=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Telephone:</strong>
    {!! Form::text('tel_'.$locale, $tel, array('placeholder' => 'Telephone','class' => 'form-control')) !!}
  </div>
</div>
<?php
if(isset($data)&&$data->tel2){
  $tel=$data->tel2;
}else{
  $tel=null;
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Telephone2:</strong>
    {!! Form::text('tel2_'.$locale, $tel, array('placeholder' => 'Telephone2','class' => 'form-control')) !!}
  </div>
</div>

@if (isset($data) && $data->logo)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <img src="{{url('/Uploads/setting/logo/'.$locale.'/'. $data->logo)}}" alt="" class="img-thumbnail img_view" />
  </div>
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Company Logo :</strong>
    {!! Form::file('logo_'.$locale, null, array('placeholder' => 'Logo','class' => 'form-control')) !!}
  </div>
</div>
@if (isset($data) && $data->fav)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <img src="{{url('/Uploads/setting/fav/'.$locale.'/'. $data->fav)}}" alt="" class="img-thumbnail img_view" />
  </div>
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Fav Icon :</strong>
    {!! Form::file('fav_'.$locale, null, array('placeholder' => 'Fav Icon','class' => 'form-control')) !!}
  </div>
</div>
@if (isset($data) && $data->pin)
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <img src="{{url('/Uploads/setting/pin/'.$locale.'/'. $data->pin)}}" alt="" class="img-thumbnail img_view" />
  </div>
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Pin Icon :</strong>
    {!! Form::file('pin_'.$locale, null, array('placeholder' => 'Pin Icon','class' => 'form-control')) !!}
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
    <strong> Theme :</strong>
    <select class="form-control selectpicker"  name="active_theme_<?php echo $locale ?>"  data-live-search="true">
        <option value="monolit"  @if(isset($data)&&$data->active_theme) @if('monolit' == $data->active_theme) selected="selected" @endif @endif>monolit</option>
        <option value="theside"  @if(isset($data)&&$data->active_theme) @if('theside' == $data->active_theme) selected="selected" @endif @endif>theside</option>
    </select>
  </div>
</div>
