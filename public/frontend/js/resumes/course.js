var course_link_count = 0;
$(".add-course-form").click(function(){
  $("#AddCoursesForm").prop('disabled', true);
  $("#CourseSection").css('display','block');
  $("#CourseSectionDetails_Text").show();
  $.ajax({
      url: "get-course-form/" + course_link_count,
      dataType: 'html',
      data: {
        r_id: r_id
      },
      success: function (data, textStatus, jqXHR) { 
        var html = JSON.parse(data);
        $("#ShowCoursesForm").append(html.html);
        CourseJS(course_link_count);
        course_link_count++;
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
  });
});

function CourseJS(course_index) {
  if(template_id == 22){
        $("#CourseSectionDetails_Text>td").addClass('border-botm');
      }
  var courseCount = $('#CourseSectionDetails_new>tr').length;
    if(courseCount >= 0){
      $(".courses-section").show();
    }
  StartEndDates();
}

function DeleteCourse(p_id,input) {
    // body...
    var courseCount = $('#CourseSectionDetails_new>tr').length;
    if(courseCount <= 1){
      $(".courses-section").hide();
    }
    if(template_id == 22){
        $("#CourseSectionDetails_Text>td").removeClass('border-botm');
      }
    $('#CoursesForm_'+input).remove();
    $("#CourseAddMore_section_"+input).remove();
    ajaxCourseDelete(p_id);
  }
  var fix_course_title = '';
  function CourseTitle(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var course_title = $(obj).val();
    fix_course_title = course_title;
    $("#coursetitle_"+id).html(course_title);
    if(template_id != 21){
                  if(fix_institute_name != '' && fix_course_title != ''){
                    $("#coursetitle_"+id).html(course_title+', ');
                  }
                }
    if(course_title != ''){
      $("#course_section_title_"+id).html(course_title);
    }else{
      $("#course_section_title_"+id).html("Not Specified");
    }
    ajaxCourseSave(id);
      }, 2000);
  }

  var fix_institute_name = '';
  function InstitutionName(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var institute_name = $(obj).val(); 
    fix_institute_name = institute_name;
    $("#courseinstitute_"+id).html(institute_name);
    if(template_id != 21){
                  if(fix_institute_name != '' && fix_course_title != ''){
                    $("#courseinstitute_"+id).html(', '+institute_name);
                  }
                }
        ajaxCourseSave(id);
      }, 2000);
  }

  function CourseStartDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#course_startdate_"+id).html(obj.value);
    ajaxCourseSave(id);
      }, 2000);
  }

  function CourseEndDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
        $("#course_enddate_"+id).val(obj.value)
    // $("#course_enddate_"+id).html(' - ' + obj.value);
    ajaxCourseSave(id);
      }, 2000);
  }

  function DeleteCourseSection() {
      $("#CourseSection").css('display','none');
      $("#AddCoursesForm").prop('disabled', false);
      $("#ShowCoursesForm").empty();
      $(".course-section").remove();
      $("#CourseSectionDetails_Text").hide();
      getcourseSectionids(r_id);
  }

  function getcourseSectionids(r_id) {
    $.ajax({
      url: "get-course-section-ids/" + r_id,
      dataType: 'json',
      success: function (data, textStatus, jqXHR) { 
        saveReloadPDF();
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
    });
  }