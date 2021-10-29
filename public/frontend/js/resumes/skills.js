function SkillsJS(skill_index,skill_name,template_id) {
    // Slider
    if(template_id == 22){
        $("#Skills_Text>td").addClass('border-botm');
      }
    var skillCount = $('#SkillDetails_new>tr').length;
    if(skillCount >= 0){
      $(".skill-section").show();
    }
  }

  function SkillRightSectionJs(skill_name = '', skill_add_more_count = ''){
    if(skill_name != null){
      clearTimeout(time);
     time = setTimeout(function() {
      var skillName = skill_name; 
      $("#skill_section_title_"+skill_add_more_count).html(skillName);
      $("#SkillName_"+skill_add_more_count).html(skillName);
      if(skillName != ''){
        if(template_id == 22){
          $("#skill_Level_"+skill_add_more_count).html('Experts');
        }else if(template_id == 17){
          var tokyo_skills_level = '<div class="active" id="1"></div><div class="active" id="2"></div><div class="active" id="3"></div><div class="active" id="4"></div><div class="active" id="5"></div>';
          $("#skill_Level_"+skill_add_more_count).html(tokyo_skills_level);
        }else{
          $("#show_bar_"+skill_add_more_count).append('<div style="width: 100%; height: 2px; background-color: black; border-radius: 50px;" class="skill-level-bar" id="show-skill-bar_' + skill_add_more_count + '"></div>');
        }
      }else{
        $("#show_bar_"+skill_add_more_count).empty();
        $("#skill_Level_"+skill_add_more_count).empty();
      }
        ajaxSkillsSave();
        }, 2000);
      }else{
        var skillName = '';
      }
  }

  function SkillName(obj,id){
    clearTimeout(time);
     time = setTimeout(function() {
    var skill = $(obj).val();
    var skill_id = id;
    if(skill != ''){
      $("#skill_section_title_"+id).html(skill);
    }else{
      $("#skill_section_title_"+id).html("Not Specified");
    }
    SkillRightSectionJs(skill,skill_id);
    ajaxSkillsSave(id);
     }, 2000);
  }

  function DeleteSkill(p_id,input,skill = ''){
    if(template_id == 22){
        $("#Skills_Text>td").removeClass('border-botm');
      }
    var skillCount = $('#SkillDetails_new>tr').length;
    if(skillCount <= 1){
      $(".skill-section").hide();
    }
    $("#SkillsForm_"+input).remove();
    $("#SkillData_"+input).remove();
    $("#SkillAddMore_section_"+input).remove();
    if(skill != ''){
      $("#ShowAutoSuggestSkills").append('<div class="chip skill-tag" id="' + skill + '"><a href="javascript:void(0);" id="AutoSkillName' + skill + '">' + skill + '</a><i class="fa fa-plus"></i></div>');
      $("#AutoSkillName"+skill).click(function(){
      mapSkill(skill);  
    });
    }else{
      $("#ShowAutoSuggestSkills").append('');
    }
    ajaxSkillDelete(p_id);
  }