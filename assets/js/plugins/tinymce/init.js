tinymce.init({ selector:'textarea#textoEditor',branding: false,language:'pt_BR',plugins: [
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
] });
