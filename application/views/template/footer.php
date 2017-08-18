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
  jQuery(document).ready(function(){
    "use strict";
    Core.init();
    Demo.init();
    $('.footable').footable();
  });
  </script>
  <?php } else if($this->session->css_js == 'formulario'){ ?>
    <script src="<?php echo base_url('assets/js/plugins/fileupload/fileupload.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/holder/holder.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/utility/utility.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/arqcentral.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/nicedit/nicEdit.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/tinymce/jquery.tinymce.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js'); ?>"></script>
    <script>tinymce.init({ selector:'textarea#textoEditor',branding: false,language:'pt_BR',plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'template paste textcolor colorpicker textpattern imagetools toc'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview | fontselect fontsizeselect forecolor backcolor',
    fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
    image_advtab: true,
    templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
    ],
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'
    ] });</script>
    <script src="<?php echo base_url('assets/js/plugins/cropper/cropper.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/imagezoom/jquery.elevatezoom.min.js');?>"></script>
    <script src="<?PHP echo base_url('assets/js/edicaoImagens.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/cropperConfig.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery/jquery_ui/jquery-ui.min_date.js'); ?>"></script>
    <script>
    // datePicker para sobrepor default que não funciona em Firefox e IE
    $( "input[name='dataExpiracao']" ).datepicker({
      dateFormat: "dd/mm/yy",
      dayNames: [ "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo" ],
      dayNamesMin: [ "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom" ],
      monthNames: [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
      prevText: "Anterior",
      nextText: "Próximo"
    });
    </script>

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
      <script type="text/javascript">
      jQuery(document).ready(function(){
        CanvasBG.init({
          Loc: {
            x: window.innerWidth / 5,
            y: window.innerHeight / 10
          }
        });
      });
      </script>
      <?php } else { ?>

        <script src="<?php echo base_url('assets/js/utility/utility.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/arqcentral.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
        <script type="text/javascript">
        jQuery(document).ready(function(){
          "use strict";
          Core.init();
          Demo.init();
        });
        </script>
        <?php } ?>
        <script type="text/javascript">
        jQuery(document).ready(function(){
          $(window).on('load', function() {
            $('#preloader').addClass('zoomOut');
          });                    
        });
        </script>

      </body>
      </html>
