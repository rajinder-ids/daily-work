      <div class="team-condition">
        <div class="title">
          <h2>Términos y condiciones</h2>
          <p>Revisa las bases legales de nuestra promoción.</p>
        </div>
      </div>
      <div class="row">
        <div class="col s12 center-align">
          <button class="btn black m_btn_custom btn-large" type="button"><a class="modal-trigger" href="http://impalasrl.com/eligeturegalo/proyecto.pdf">Ver bases legales</a></button></a>
        </div>
      </div>


      <!-- Modal Structure -->
      <div id="modal1" class="modal custom-model">
        <div class="modal-footer">
          <a href="#!" class="modal-close t  btn-flat">Cerrar <b>x</b></a>
        </div>
        <div class="modal-content ">
          <h4>Numero de imei en celulares:</h4>
          <p>Encuentra el numero de imei de tu producto <br> en el TAG de la caja de tu producto</p>
          <h5>*Imagen referencial TAG</h5>
        </div>
        
      </div>

      <div class="footer">
        <div class="row valign-wrapper v_block">
          <div class="col s12 m2">
            <img src="<?php echo URL; ?>images/auto.png" width="120">
          </div>
          <div class="col s12 m2">
            <img src="<?php echo URL; ?>images/att.png" width="120">
          </div>
          <div class="col s12 m3">
            <img src="<?php echo URL; ?>images/sumsungplus.png" width="220">
          </div>
          <div class="col s12 m5 right-align">
            <div class="footer-col">
             <img src="<?php echo URL; ?>images/logo.png">
              <h5>customer service </br> servicio al client</h5>
              <h3>800-10-7260</h3>
              <h4> Servicio Remoto <br> chat-on-line 24/7</h4>
              <a href="www.samsung.com/cl/support">www.samsung.com/cl/support</a>
            </div>
          </div>
        </div>
        <div class="row valign-wrapper-">
          <div class="col s12 l1">
            
          </div>
          <div class="col s12">
            <img class="responsive-img-" style="margin-top:25px;max-width: 50px;width: 100%;" src="<?php echo URL; ?>images/logo_footer_new.jpg">
            <p>Promoción válida del 26 de agosto al 15 de septiembre de 2020 mediante Resolución LP-097-20.</p>
          <!--
            <p>Promoción válida del 26 de agosto al 15 de septiembre de 2020 mediante Resolución LP-097-20. Participan todos los clientes que compren Samsung Galaxy Note20/Note20 ultra con Holograma de garantía oficial en Bolivia (Homologados) del 26 de agosto al 9 de septiembre de 2020. Válido para registros efectuados del 26 de agosto al 9 de septiembre de 2020. Válido para los departamentos de La Paz, Cochabamba, Santa Cruz, Tarija, Oruro, Chuquisaca, Potosí, Pando y Beni. Podrás elegir tu regalo de acuerdo a las condiciones estipuladas en el proyecto. Conoce más en <a href="http://www.samsungplus.com.bo/eligeturegalo" target="_blank"> www.samsungplus.com.bo/eligeturegalo</a>. web: <a href="http://www.samsungplus.com.bo/eligeturegalo" target="_blank">www.samsungplus.com.bo/eligeturegalo</a></p>
          -->
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
  <!-- Mainly scripts -->
  <script src="<?php echo URL; ?>js/jquery-3.1.1.min.js"></script>
  <script src="<?php echo URL; ?>js/jquery.validate.js"></script>
  <script src="<?php echo URL; ?>js/materialize.min.js"></script>
  <script src="<?php echo URL; ?>js/custom.js"></script>
   <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
      });

      // Or with jQuery

      jQuery(document).ready(function(){
        jQuery('.modal').modal();
      });
   </script>

</html>