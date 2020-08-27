<?php
  include_once('./../init.php');
  include_once PATH . DS . 'template' .DS .'admin-session.php';
  include_once PATH . DS . 'template' .DS . 'crud' . DS . 'list.php';
?>
<style>
  
  tr:hover .row-actions {
    position: static;
  }

  .row-actions {
    color: #ddd;
    font-size: 13px;
    padding: 2px 0 0;
    position: relative;
    left: -9999em;
  }
  .custom-select {
    margin-right: 5px;
    padding: 7px 12px;
    float: left;
    width: 200px;
  }
  .btn-outline-secondary {
    border-color: #ced4da;
  }
  .no-wrap{
    white-space: nowrap;
  }
  caption {
    caption-side: top;
  }
  .statusContainer {
    display: inline-block;
    width: 60px;
    text-align: center;
  }
  .cust_status.btn{
    border:1px solid #ced4da;
  }
  .customersListing .float-left {
    margin-bottom: 10px;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h3>Clientes</h3>
      <?php echo $message; ?>
    </div>
    <div class="col-lg-12">      
      <div class="ibox float-e-margins">
        <div class="search-from" style="float: left;width: 100%;margin-bottom: 14px;">
          <form  class="form-inline" method="get" style="float: right;">  
            <div class="input-group"> 
              <input type="text" placeholder="Buscar" name="search" class="form-control input-lg IDS-searchTopText" value="<?php echo $search; ?>">
               <span class="input-group-append">
                <div class="input-group-btn">
                  <button class="btn btn-outline-secondary" type="submit">
                    <span class="fa fa-search"></span>
                  </button>
                </div> 
              </span>
            </div> 
            <input type="hidden" name="usuaria" value="<?php echo $_REQUEST['usuaria']; ?>">      
            <input type="hidden" name="contraseña" value="<?php echo $_REQUEST['contraseña']; ?>">            
            <input type="hidden" name="page" value="<?php echo $_REQUEST['contraseña']; ?>">            
          </form>                        
        </div>  
      </div>
    </div>

    <div class="col-lg-12"> 
      <form  class="customersListing" method="post">
        <div class="row">
          <div class="col-lg-12">
            <div class="float-left" > 
              <select class="btn dropdown-toggle btn-light custom-select" dropdown-toggle name="bulkAction">
                <option value="">Acción masiva</option>
                <option value="deleted">Eliminar</option>
              </select>
              <input class="btn btn-primary" type="submit" name="action" value="Acción">
            </div> 
            <!-- CSV -->
            <div class="float-right" >
              <button type="submit" name="csv" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Descarga CSV</button>
            </div>  
          </div>
         
          <div class="col-lg-12">
            <div class="table-responsive"> 
              <table class="table table-striped no-wrap">
                <caption>Clientes</caption>
                <thead>
                  <tr>
                    <th><input type="checkbox" class="checkAll"></th>
                    <?php foreach ($fieldInfo as $dbname => $label) { ?>
                       <th scope="col"><?php echo $label; ?></th>
                    <?php } ?>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                    if(empty($result['record'])){
                      echo '<tr><td><h3 class="list-group-item-heading">No Customer Record.</h3><td></tr>';
                    }
                    foreach ($result['record'] as $row) { 
                  ?>
                    <tr>
                      <td><input type="checkbox" class="checkItem" name="users[]" value="<?php echo $row['id']; ?>"></td>

                      <?php foreach ($fieldInfo as $dbname => $label) { ?>
                        <?php 
 
                          // $row['front_photo_id_card']   = ( $row['front_photo_id_card']);
                          // $row['photo_reverse_id_card'] = (URL.'images/upload/'. $row['photo_reverse_id_card']);
                          // $row['crop_photo']            = (URL.'images/upload/'. $row['crop_photo']);

                          switch ( $dbname ) {
                            case 'front_photo_id_card':
                            case 'photo_reverse_id_card':
                            case 'crop_photo':
                              $link  = URL.'images/upload/'. $row[$dbname];
                              $value = "<a href='{$link}' target='_blank'>View</a>";
                              # code...
                            break;
                            case 'approved':
                            case 'sent':
                            case 'received':
                              $fieldValue = '<select class="cust_status btn" name="'.$dbname.'" target="'.$row['id'].'">';
                                $fieldValue .= '<option value="">'.$label.'</option>';
                                foreach (["true","false"] as $ovalue) {
                                  $check       = ($row[ $dbname ] == $ovalue) ? 'checked="checked"': "" ;
                                  $fieldValue .= '<option value="'.$ovalue.'" '.$check.' >'.$ovalue.'</option>';
                                }
                              $fieldValue .= '</select><div class="statusContainer"><i class="fa fa-check responseStatus" aria-hidden="true"></i></div>';
                              $value = $fieldValue;                           
                            break;
                            
                            default:
                              $value = $row[ $dbname ];
                            break;
                          }

                        ?>
                        <td scope="col"><?php echo $value; ?></td>
                      <?php } ?>
                      <td><?php 

                        $getParam       = $_GET; 
                        $getParam['id'] = $row['id'];
                        $viewURL        = URL."template/view.php?" .  http_build_query( $getParam ) ;

                        $getParam           = $_GET; 
                        $getParam['userID'] = $row['id'];
                        $getParam['task']   = 'delete';

                        $deleteURL = "?" . http_build_query( $getParam );
                        ?>
                        <!--
                        <div class="row-actions">
                          <span class="view"><a href="<?php //echo $viewURL;?>">Ver</a> | </span>                       
                          <span class="delete"><a class="deleteCnt" href="<?php //echo $deleteURL;?>">Eliminar</a></span>
                        </div>
                        -->
                        <a href="<?php echo $viewURL;?>" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
                        <!-- <a href="<?php// echo $deleteURL;?>" class="btn btn-danger" ><i class="fa fa-trash"></i></a> -->
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </form>

    </div>
    <div class="col-lg-12 text-center">
      <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">    
        <ul class="pagination justify-content-center" style="margin:20px 0">
         <?php

          // $requestName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

          $getParam = $_GET;
          
          for($j=1; $j <= $result['totalpages']; $j++){ 

            $getParam['page'] = $j;

            $className = "";
            $link      = "?" . http_build_query( $getParam );

            if($j == $result['currentPage']){
              $className = "active";
              $link      = "#";
            }

          ?>
          <li class="page-item <?php echo $className; ?>">
            <a class="page-link" href="<?php echo $link; ?>"><?php echo $j; ?></a>
          </li>
          <?php } 
          ?>
        </ul> 
      </div>

    </div> 

  </div>
</div>

<?php
  getFooter();
?>