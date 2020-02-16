require([
'jquery',
'custom_script',
'jquery/ui',
'mage/url'], function($,$cjs,ui,url){

  jQuery(document).ready(function(){

    jQuery('body').on('click','.admin__control-select',function(){
    var input_name = jQuery(this).attr('name');
    var base_url = window.location.origin;
    // stackoverflow.com
    var pathname = window.location.pathname;
    var new_str = pathname.split("codelegacy_color/index/")[0];
    var basePath = base_url + new_str;
    // var pathArray = window.location.pathname.split( '/' );

    if(input_name == "type"){

      if(jQuery(this).val() == ""){
        jQuery(this).css('border-color','red');
      } else {
          jQuery(this).css('border-color','#adadad');
          var body = $('body').loader();
          body.loader('show');
          var product_id = $(this).val();
          var values = jQuery('.admin__control-multiselect').val();
          var linkUrl = url.build('codelegacy_color/index/test');
          // console.log(linkUrl);
          $.ajax({
            type:'POST',
            url:basePath+"codelegacy_color/index/test",
            data:{
              'pid':product_id,
              'values':values
            },
            success:function(data){
              jQuery('.admin__control-multiselect').empty();
              $.each(data,function(index, obj){
                jQuery('.admin__control-multiselect').append(
                  '<option data-title="'+obj+'" value="'+obj+'">'+obj+'</option>'
                )
              })
              body.loader('hide');
               // location.reload();
            }
          })
        }
      }
    })
  })
});
