<?php

  function dateFormat($string){
    $date = date_create($string);
    return date_format($date,"d/m/Y");

    return date("d/m/Y" , $string);
  }
 
  function fileUpload($fileName=[]){
    $fName = $fileName['name'];
    $fSize = $fileName['size'];
    $fTmp  = $fileName['tmp_name'];
    $fType = $fileName['type'];

    $getExt = explode('.', $fName);
    $fExt   = strtolower(end($getExt));

    #$fExt  = strtolower(end(explode('.',$fName)));
    if(in_array($fExt,["jpeg","jpg","png"])=== false){
      return ['status'=>false,
              'message'=>'extension not allowed, please choose a JPEG or PNG file'
            ];
    }

    // if($file_size > 2097152){
    //   return ['status'=>false,
    //           'message'=>'File size must be excately 2 MB'
    //         ];
    // }

    $fPhoto = md5(time() . $fName) . '.' . $fExt;

    move_uploaded_file($fTmp,PATH . DS .'images'.DS."upload".DS.$fPhoto);
    return ['status'=>true,'filename'=>$fPhoto];
  }

  function includeView($file, $extension = "php",$folderName="common-view"){
    include PATH . DS . $folderName . DS . $file . '.' . $extension;
  }

  function getHeader($folderName="common-view"){
    includeView('header','php',$folderName);
  }

  function export_csv($tableName) {
    global $db , $fieldInfo;
    $fields     = array_keys( $fieldInfo );
    $fieldsName = array_values( $fieldInfo );
    $string     = implode('` , `',$fields);
    $all        = $db->fetch("SELECT `{$string}` FROM `{$tableName}`");
    $tmpName    = tempnam(sys_get_temp_dir(), 'data');
    $file       = fopen($tmpName, 'w');

    fputcsv($file, $fieldsName);
    
    // output each row of the data

    foreach ($all as $row){
      $row['front_photo_id_card']   = !empty($row['front_photo_id_card'])?(URL.'images/upload/'.$row['front_photo_id_card']):'';
      $row['photo_reverse_id_card'] = !empty($row['photo_reverse_id_card'])?(URL.'images/upload/'.$row['photo_reverse_id_card']):'';
      $row['crop_photo']            = !empty($row['crop_photo']) ? (URL.'images/upload/'. $row['crop_photo']):'';
      $row['dob']                   = dateFormat($row['dob']);
      $row['date_purchase']         = dateFormat($row['date_purchase']);
      $row['updated_on']            = dateFormat($row['updated_on']);
      fputcsv($file, $row);
    }

    fclose($file);

    header('Content-Description: File Transfer');
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=TerminosCSV'.time().'.csv');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tmpName));

    if(empty($all)){
      ob_end_clean();
    }
    
    flush();
    readfile($tmpName);

    unlink($tmpName);
    
  }

function redirect($url) {
  ob_start();
  header('Location: '.$url);
  ob_end_flush();
  die();
}

function getFooter($folderName="common-view"){
 includeView('footer','php',$folderName);
}

function addField($param){
  
  $param = array_merge([
    "cClass"       => "", // Container Class
    "id"           => "",
    "name"         => "",
    "class"        => "",
    "type"         => "text",
    "value"        => "",
    "placeholder"  => "",
    "label"        => "",
    "attributes"   => "",
    "errorMessage" => "",
    "startHtml"    => "",
    "endHtml"      => "",
    "childClass"   => "",
    "html"         => "",
    "rowClass"     => "",
    "option"       => [],
    "labelDirection" => "top",
    "labelClass" => "",
    "validation" => []
  ], $param);

  extract($param);
  $forLabel = (empty($id)) ? $name : $id;
  $required = (empty($validation)) ? '' : '*';
  ?>
  <?php echo $startHtml; ?>
  <div class="row <?php echo $rowClass; ?>">
    <!-- <div class="<?php //echo $cClass;?>"> -->
    <?php
      switch($type){
        case 'text':
        case 'number':
        case 'email':
        case 'date':
        //case 'file':
        ?>
        <div class="input-field col s12">
          <label for="<?php echo $name ?>" ><?php echo $label .$required;?></label>
          <input 
            <?php echo $attributes; ?> 
            type="<?php echo $type ?>" 
            id="<?php echo $name ?>" 
            class="<?php echo $class ?>" 
            name="<?php echo $name; ?>" 
            <?php if(!empty( $placeholder )  || $type == 'date' ){ ?>
              placeholder="<?php echo $placeholder; ?>" 
            <?php } ?>
            value="<?php echo $value; ?>"
            >
        </div>
        <?php
        break;
        case 'file':
        ?>
          <div class="col s12 m3">
            <label for="<?php echo $forLabel; ?>" class="<?php echo $labelClass; ?>">
              <?php echo $label . $required; ?>  
            </label>
          </div> 
          <div class="col s12 m7">
            <div class="file-field input-field m_upload valign-wrapper center-align">
              <div class="btn">
                <span>Seleccionar Archivo</span>
                
              </div>
              <input <?php echo $attributes; ?> id="<?php echo $name; ?>" type="file"  name="<?php echo $name; ?>">
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>          
          </div>
          <div class="col s12 m2 trigger-upload">
            <span class="btn black m_btn disabled trigger-upload" for="<?php echo $name; ?>">subir</a>
          </div>                
        <?php
        break;
        case 'select':
        ?>
          <div class="input-field">
            <div class="col s12 m6 left-align"><label for="<?php echo $forLabel; ?>" class="<?php echo $labelClass; ?>"><?php echo $label.$required; ?></label></div>
            <div class="<?php echo $name; ?> col s12 m6">
              <select
                id="<?php echo $id ?>" 
                class="browser-default" 
                name="<?php echo $name; ?>" 
                rows="5">
                <?php foreach ($option as $fvalue => $label) { ?>
                  <option value="<?php echo $fvalue; ?>" <?php echo ($value == $fvalue) ? 'selected="selected"' : ''; ?> >
                    <?php echo $label; ?>
                  </option>
                <?php  } ?>
                ?>
              </select>
            </div>
          </div>
        <?php
        break;
        case 'checkbox':
          ?>
          <?php 
            foreach ($option as $chKey => $chValue) { 
              $checked = ($chValue == $value) ? 'checked="checked"' : '';
          ?>
              <p>
                <input 
                  <?php echo $checked; ?>
                  <?php echo $attributes; ?> 
                  type="<?php echo $type ?>" 
                  id="<?php echo $id ?>" 
                  class="form-control  <?php echo $class ?>"
                  name="<?php echo $name; ?>" 
                  placeholder="<?php echo $placeholder; ?>" 
                  value="<?php echo $chValue; ?>"/>
                <label class="col-form-label" for="<?php echo $id ?>"><?php echo $label; ?></label>
              </p>
          <?php  }           
        break;
        case 'radio':
          ?>

          <?php 
            $i=1;
            foreach ($option as $chValue) { 
              $checked = ($chValue == $value) ? 'checked="checked"' : '';
          ?>
          <p>
            <label>
              <input 
              <?php echo $checked; ?>
              <?php echo $attributes; ?> 
              type="<?php echo $type ?>" 
              id="<?php echo $id.'-'.$i; ?>" 
              class="form-control  <?php echo $class ?>" 
              name="<?php echo $name; ?>" 
              placeholder="<?php echo $placeholder; ?>" 
              value="<?php echo $chValue; ?>"/>
              <span><?php echo $chValue; ?></span>
            </label>
          </p>
          <?php $i++; }           
        break;        
      }

      echo $html; 
      if( !empty( $errorMessage ) ){
        echo '<p class="col-sm-12 IDS-blankFieldMessage text-danger">'.$errorMessage.'</p>';
      } 
    ?>
    <!-- </div> -->
  </div>
  <?php echo $endHtml; ?>
  <?php
}

function buttonField($array){
  foreach ($array as $key => $value) { ?>
    <button type="submit" class="btn btn-w-m m_btn_custom " id="insert" name="<?php echo $key; ?>" ><?php echo $value ?></button>
<?php
  }
} 
function image( $className = "" , $path){ ?>
  <img alt="image" class="<?php echo $className; ?>" src="<?php echo $path; ?>">
<?php }

function logoImage( $className = "IDS-sm-image" , $path = URL."images/logo/logo1.png" ){ ?>
  <div class="col-lg-2">
    <h5 class="IDS-logoImage">
      <a href="<?php echo URL; ?>index.php">
        <?php image($className , $path ); ?>
      </a>
    </h5>
  </div>
<?php }
 
function homePageButton($href= URL."index.php"){ ?>
  <a href="<?php echo $href;?>"><label class="btn IDS-btn btn-sm">Home</label></a>
<?php
}

function tagView($data){
    $tags = explode(',', $data);
    for($i=0; $i<count($tags); $i++){  ?>
    <a href="<?php echo URL; ?>contractclauses/tag.php?tag=<?php echo $tags[$i]; ?>" class="IDS-tagLink">
      <?php echo $tags[$i]; ?>
    </a>
<?php
    }
  }

function displayMessage($input , $msgStatus ){
  return '<div class="alert alert-'.$msgStatus.' alert-dismissable">'.$input.'</div>';
}

?>