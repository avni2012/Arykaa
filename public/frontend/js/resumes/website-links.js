function WebsiteSocialLinkJS(website_social_index, template_id) {
  if(template_id == 22){
    $("#WebsiteSocialLinks_Text>td").addClass('border-botm');
  }
  var linksCount = $('#WebsiteSocialLinks_new>tr>td').length;
  if(linksCount >= 0){
    $(".website-links-section").show();
  }
}

function DeleteWebsiteSocialLink(p_id,input){
  if(template_id == 22){
    $("#WebsiteSocialLinks_Text>td").removeClass('border-botm');
  }
  if(template_id != 17){
    var linksCount = $('#WebsiteSocialLinks_new td').length;
    if(linksCount <= 1){
      $(".website-links-section").hide();
    }
  }else{
    var linksCount = $('#WebsiteSocialLinks_new>tr').length;
    if(linksCount <= 1){
      $(".website-links-section").hide();
    }
  }
  $("#WebsiteSocialLinkForm_"+input).remove();
  $("#WebsiteSocialLinksData_"+input).remove();
  $("#EducationAddMore_section_"+input).remove();
  ajaxWebsiteLinksDelete(p_id);
}
var set_link_label = '';
function WebsiteSocialLabel(obj,id){
  clearTimeout(time);
     time = setTimeout(function() {
  var website_social_label = $(obj).val();
  set_link_label = website_social_label;
  $("#WebsiteSocialLabel_"+id).html(website_social_label);
  if(website_social_label != ''){
    $("#website_social_link_section_title_"+id).html(website_social_label);
  }else{
    $("#website_social_link_section_title_"+id).html("Not Specified");
  }
  ajaxWebsiteSocialLinkSave();
     }, 2000);
}
function WebsiteSocialLinks(obj,id){
  clearTimeout(time);
     time = setTimeout(function() {
  var website_social_link = $(obj).val(); 
  var website_social_label = $("#WebsiteSocialLabel_"+id).val();
  $("#WebsiteSocialLink_"+id).html(website_social_link);
  $('#WebsiteSocialLabel_'+id).each(function(){
    this.innerHTML = '<a href="' + website_social_link + '">' + set_link_label + '</a>';
  })
  ajaxWebsiteSocialLinkSave();
     }, 2000);
}