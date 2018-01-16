<!-- Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
Confidencial e proprietário
Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017 -->

</div>
<script src="<?php echo base_url('assets/js/jquery/jquery-1.11.3.min.js'); ?>"></script>
<?php if($this->session->css_js == 'tabela'){ ?>
  <script src="<?php echo base_url('assets/js/jquery/jquery_ui/jquery-ui.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/footable/js/footable.all.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/footable/js/footable.filter.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/utility/utility.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/arqcentral.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
  <script type="text/javascript">
  jQuery(document).ready(function(){"use strict";Core.init();Demo.init();$('.footable').footable();});
  </script>
<?php } else if($this->session->css_js == 'formulario'){ ?>
  <script src="<?php echo base_url('assets/js/plugins/fileupload/fileupload.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/holder/holder.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/utility/utility.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/arqcentral.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/tinymce/jquery.tinymce.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/tinymce/init.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/cropper/cropper.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/imagezoom/jquery.elevatezoom.min.js');?>"></script>  
  <script src="<?php echo base_url('assets/js/cropperConfig.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/jquery/jquery_ui/jquery-ui.min_date.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/jquery/jquery_ui/init.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/pacoteOperacoes.js'); ?>"></script>
  <script type="text/javascript">
  jQuery(document).ready(function(){
    "use strict";
    Core.init();
    Demo.init();
    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
  });
  </script>
  <script src="<?php echo base_url('assets/js/opcoesMidias.js'); ?>"></script>
<?php } else if($this->session->css_js == 'entrar'){ ?>
  <script src="<?php echo base_url('assets/js/plugins/canvasbg/canvasbg.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/utility/utility.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/arqcentral.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/pages/allcp_forms-elements.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/canvasBG.js'); ?>"></script>
<?php } else { ?>
  <script src="<?php echo base_url('assets/js/utility/utility.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/arqcentral.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
  <script type="text/javascript">jQuery(document).ready(function(){"use strict";Core.init();Demo.init();});
  </script>
<?php } ?>
<script src="<?php echo base_url('assets/js/cropperReload.js'); ?>"></script>
</body>
</html>
