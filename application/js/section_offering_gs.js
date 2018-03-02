function Save(){
    $("#message_line").css('display', 'block');
    //e.preventDefault();
    if ($("#setupForm2").valid()){
        var s_s = checkSchedLine();
        if(s_s == 1 || s_s.length >= 1){
            var c = (s_s == 1)?true: false;
            if(s_s.length >= 1){
                bootbox.confirm("There are "+s_s.length+" enrolled students in the subject.\nDo you want to continue?", function(result){
                    bootbox.confirm("Show students enrolled students?", function(result2){
                        if(result2){
                            var cnt = "";
                            for(k=0; k<s_s.length; k++){
                                cnt += "<tr>";
                                cnt += "<td>"+s_s[k]["CODE"]+"</td>";
                                cnt += "<td>"+s_s[k]["NAME"]+"</td>";
                                cnt += "</tr>";
                            }
                            $("#enr_table_body1").html(cnt);
                            $("#enr_table1").dataTable();
                            $('#modal1').modal('show');
                        }
                    });
                    if(result){
                         $("#save_type2").val('saveSubjectOffering');
                        var data = $("#setupForm2").serializeArray();
                        $.ajax({
                            type: "post",
                            data: data,
                            async: false,
                            dataType: 'json',           
                            success: function(data){
                                $.pnotify({
                                    title: "Success",
                                    text: "Subject Offering Successfully Saved!",
                                    type: "success"
                                });
                                // saveFacultyLoading();
                                //save sos_id and so_id
                                $("#so_id").val(data["SO_ID"]);
                                $("#sos_id2").val(data["SOS_ID"]);
                                saveFacultyLoading();

                            },error: function(){
                                Error();
                            }
                        });
                    }
                });
            }
            if(c){
                $("#save_type2").val('saveSubjectOffering');
                var data = $("#setupForm2").serialize();
                $.ajax({
                    type: "post",
                    data: data,
                    async: true,
                    dataType: 'json',           
                    success: function(data){
                        $.pnotify({
                            title: "Success",
                            text: "Subject Offering Successfully Saved!",
                            type: "success"
                        });
                        // saveFacultyLoading();

                        //save sos_id and so_id
                                $("#so_id").val(data["SO_ID"]);
                                $("#sos_id2").val(data["SOS_ID"]);
                                saveFacultyLoading();
                    },error: function(){
                        Error();
                    }
                });
            }
        }
    }
    $("#message_line").css('display', 'none');
}

function loadLine(SY, Sec, Subj, curr, SO, Term, row){
    $("#loadingModal").modal('show');
    $("#line_sy").val(SY);
    $("#line_sec").val(Sec);
    $("#line_subj").val(Subj);
    $("#line_curr").val(curr);
    $("#line_term").val(Term);
    $("#line_SO").val(SO);
    if(SO == null){        
        $.ajax({
            type: "post",
            data: $("#lineForm").serialize(),
            dataType: "JSON",
            success: function(data){
                loadLineData(data, row);
            }
        });
    }else{
        $.ajax({
            type: "post",
            data: $("#lineForm").serialize(),
            dataType: "JSON",
            success: function(data){
                loadLineData(data, row);
            }
        });
    }
}

var rooms = new Array();
var subj_line = 0;
var total_u;
function loadLineData(dtl, row){
    $.ajax({
        type: "post",
        url: "section_offering_gs_template",
        success: function(data){
            $("#row_div").slideUp();
            $("#opt_line").remove();
            $("#"+row).after("<tr id='opt_line' style='background-color: rgb(252, 252, 252);'><td colspan=10 style='padding:20px; '><div id='row_div' style='width:100%; display:none'>"+data+"</div></td></tr>");
            $("#row_div").slideDown("slow");
            var d = dtl["s_o"][0];
            $("#slots").val(d["SLOTS"]);
            $("#tutorial").prop('checked', (d["IS_TUTORIAL"] == "yes")?true:false);
            $("#petition").prop('checked', (d["IS_PETITION"] == "yes")?true:false);
            //$("#is_open_yes").prop('checked', (d["IS_OPEN"] == "no")?false:true);
            //$("#is_open_no").prop('checked', (d["IS_OPEN"] == "no")?true:false);
            //$("#is_open_yes").prop('disabled', (d["TYPE"] == "open")?true:false);
            //$("#is_open_no").prop('disabled', (d["TYPE"] == "open")?true:false);
            $("[name='is_open_course'][value='yes']").prop('checked', (d["IS_OPEN_COURSE"] == "no")?false:true);
            $("[name='is_open_course'][value='no']").prop('checked', (d["IS_OPEN_COURSE"] == "no")?true:false);
            $("[name='is_open_course'][value='yes']").prop('disabled', (d["TYPE"] == "open")?true:false);
            $("[name='is_open_course'][value='no']").prop('disabled', (d["TYPE"] == "open")?true:false);
            if(d["TYPE"] == "open")
                $("#is_open_div").slideUp();
            else
                $("#is_open_div").slideDown();
            $("#load_type2").val(dtl["f_curr"]["LOAD_TYPE"]).select2("val", dtl["f_curr"]["LOAD_TYPE"]);
            $("#so_id").val(d["SO_ID"]);
            $("#type_so").val(d["TYPE"]);
            $("#sos_id2").val(d["SOS_ID"]);
            $("#yr_lvl").val((d["YR_LVL"]!= null)?d["YR_LVL"]:"");
            $("#term").val(d["TERM"]);
            $("#loadSY").val(dtl["input"]["loadSY"]);
            $("#loadSec").val(dtl["input"]["loadSec"]);
            $("#loadSO").val(dtl["input"]["loadSO"]);
            $("#sy").val(dtl["input"]["loadSY"]);
            $("#loadSubject").val(dtl["input"]["loadSubject"]);
            $("#loadCurr").val(dtl["input"]["loadCurr"]);
            $("#loadCampus").val(d["CAMPUS"]);

            //get faculty
            var fac = "<option></option>";
            for(i=0; i<dtl["faculty"].length; i++){
                var sel = (dtl["faculty"][i]["ID"] == dtl["f_curr"]["FACULTY"])?'selected':'';
                fac += "<option value='"+dtl["faculty"][i]["ID"]+"' "+sel+">"+dtl["faculty"][i]["NAME"]+"</option>";
            }
            $("#faculty").html(fac);
            //initialize rooms
            var temp;
            rooms = Array();
            for(i=0; i<dtl["room"].length; i++){
                temp = {
                    "ID" : dtl["room"][i]["ID"],
                    "CODE": dtl["room"][i]["CODE"]
                }
                rooms.push(temp);
            }
            $("select.form-select2").each(function(){
                $(this).select2({width: 'resolve'});
            });
            for(j=0; j<dtl["s_o"].length; j++){
                $("#sosl_ids").val(((dtl["s_o"][j]["SOSL"] == null)?$("#sosl_ids").val()+"0, ":$("#sosl_ids").val()+dtl["s_o"][j]["SOSL"]+", "));
                addSubjLineEdit(dtl["s_o"][j]["DAY"], dtl["s_o"][j]["TIME_START"], dtl["s_o"][j]["TIME_END"], dtl["s_o"][j]["ROOM"], dtl["s_o"][j]["S_TYPE"]);
            }
            $("#loadingModal").modal('hide');
        }
    });
}

function checkUnits(){
    var msg = "";
    var t_min = 0;
    var data = [];
    for(var i = 1; i<=subj_line; i++){
        if(typeof $("[name='time_s_"+i+"']").val() !== "undefined" && typeof $("[name='time_e_"+i+"']").val() !== "undefined")
            data.push({time_s_v: $("[name='time_s_"+i+"']").val(), time_e_v: $("[name='time_e_"+i+"']").val()});
    }
    $.ajax({
        type: "post",
        async: false,
        data: {check_unit_time: data},
        success: function(data){
            t_min = parseInt(data);
        }
    });
    if(t_min == total_u * 60){
        //valid date and time
        return 0;
    }else{
        return (total_u);
    }
}

function checkSchedLine(){
    $(".subj_line").each(function(){
        $(this).css('background-color', 'white');
    });

    if($("#setupForm2").valid()){
        //conflict inline
        var dates_s = Array();
        var dates_e = Array();
        var days = Array();
        $("[name*='day_']").each(function(){
            if($(this).prop('checked')){
                var num = $(this).attr("name").replace("day_", "").replace("[]","");
                var day = $(this).val();
                var start = $("[name='time_s_"+num+"']").val();
                var end = $("[name='time_e_"+num+"']").val();
                days.push(day);
                dates_s.push(Date.parse("01/01/2011 "+start));
                dates_e.push(Date.parse("01/01/2011 "+end));
            }
        });
        var conflict = false;
        for(ix=0; ix<days.length; ix++){
            var is_brk = false;
            for(jx=0; jx<days.length; jx++){
                console.log(ix+" "+jx);
                if(ix!=jx){
                    if(days[ix] == days[jx] && (
                            (
                                dates_s[ix] > dates_s[jx] && dates_s[ix] < dates_e[jx]
                                || dates_e[ix] > dates_s[jx] && dates_e[ix] < dates_e[jx]
                            )||(
                                dates_s[ix] == dates_s[jx] && dates_e[ix] == dates_e[jx]
                            )||(
                                dates_s[jx] > dates_s[ix] && dates_s[jx] < dates_e[ix]
                                || dates_e[jx] > dates_s[ix] && dates_e[jx] < dates_e[ix]
                            )
                        )
                    ){
                        conflict = true;
                        is_brk = true;
                        break;
                    }
                }
            }
            if(is_brk)
                break;
        }
        if(conflict){
            $.pnotify({
                title: "Invalid",
                text: "Conflict within the schedule. Please recheck.",
                type: "error"
            });
            return 0;
        }else{
            //conflict from database
            $("#save_type2").val('checkSchedLine');
            $("#subj_line").val(subj_line);
            var data = $("#setupForm2").serializeArray();
            var res;
            $.ajax({
                type:"post",
                async: false,
                data: data,
                dataType: "json",
                success:function(data){
                    if(data[1]["RESULT"] == "Error"){
                        Error();
                        res = 0;
                    }else if(data[1]["RESULT"] == "No" && data[0].length == 0){
                        $.pnotify({
                            title: "Valid",
                            text: "The subject offering does not interfere with any subject offering.",
                            type: "success"
                        });
                        res = 1;
                    }else if(data[0].length >= 1)
                        res = data[0];
                    else if(data[1]["RESULT"] != "No" && data[1]["RESULT"] != ""){
                        $.pnotify({
                            title: "Invalid",
                            text: data[1]["RESULT"],
                            type: "error"
                        });
                        $("#subj_line_"+data[1]["NUM_LINE"]).css('background-color', '#F5AFAF');
                        res = 0;
                    }
                    else
                        res = 0;
                }
            });
        return res;
        }
    }   
}
function backSO(){
    $("#back_form").submit();
}
function checkSched(){
    var count = 0;
    $(".subj_line").each(function(){
        count++;
    });
    if(($("#setupForm2").valid() && checkSchedLine() != 0) || count == 0){
        addSubjLine();
    }
}
function addSubjLine(){
    subj_line++;
    var type = "<select class='form-select2_b"+subj_line+"' style='width:100%' name='type_"+subj_line+"' required>"+
            "<option value='lec'>Lec</option><option value='lab'>Lab</option></select>";
    var days = "";
    var d_val = Array('M', 'T', 'W', 'TH', 'F', 'S', 'SU');
    for(ind = 0; ind<d_val.length; ind++){
        days += "<input type='checkbox' name='day_"+subj_line+"[]' value='"+d_val[ind]+"' required/></td><td>";
    }
    var btn = "<a href='javascript:delSubjLine("+subj_line+")' class='btn btn-danger subj_line_remove' line_no='"+subj_line+"'><i class='fa fa-trash-o'></i></a>";
    var rooms_sel = "<select class='form-select2_b"+subj_line+"' required style='width:100%' name='room_"+subj_line+"'><option value='TBA'>TBA</option>";
    for(i=0; i<rooms.length; i++){
        rooms_sel+= "<option value='"+rooms[i]["ID"]+"'>"+rooms[i]["CODE"]+"</option>";
    }
    rooms_sel+= "</select>";
    
    $("#subj_line_body").append("<tr id='subj_line_"+ subj_line +"' class='subj_line'><td>"+type+"</td><td>"+days+"<input type='time' class='form-control' required name='time_s_"+subj_line+"'/>"+
    "</td><td><input type='time' class='form-control' required name='time_e_"+subj_line+"'/></td><td>"+rooms_sel+"</td><td>"+btn+"</td></tr>");
    $(".form-select2_b"+subj_line).each(function(){
        $(this).select2();
    });
}
function addSubjLineEdit(day, time_s, time_e, room, type){
    subj_line++;
    day = (day == null)?"":day;
    var days_val = day.split(",");
    //var days = "<select class='form-select2_b"+subj_line+"' value='"+day+"' style='width:100%' name='day_"+subj_line+"' required>";
    var days = "";
    var days_code = ['M', 'T', 'W', 'TH', 'F', 'S', 'SU'];
    var days_name = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    for(i=0; i<days_code.length; i++){
        var sel = (days_val.indexOf(days_code[i]) !== -1)?"checked":"";
        //if (days_code[i] == day)
        //    sel = "selected";
        //days+="<option value='"+days_code[i]+"' "+sel+">"+days_name[i]+"</option>";
        days += "<input type='checkbox' value='"+days_code[i]+"' "+sel+" name='day_"+subj_line+"[]' required/></td><td>";
    }
    //days+="</select>";
    var types = "<select class='form-select2_b"+subj_line+"' value='"+type+"' style='width:100%' name='type_"+subj_line+"' required>";
    var t_code = ['lec', 'lab'];
    var t_name = ['Lec', 'Lab'];
    for(i=0; i<t_code.length; i++){
        var sel = "";
        if (t_code[i] == type)
            sel = "selected";
        types+="<option value='"+t_code[i]+"' "+sel+">"+t_name[i]+"</option>";
    }
    types+="</select>";
    var btn = "<a href='javascript:delSubjLine("+subj_line+")' class='btn btn-danger subj_line_remove' line_no='"+subj_line+"'><i class='fa fa-trash-o'></i></a>";
    var rooms_sel ="";
    if(room == 'TBA')
        rooms_sel+= "<select class='form-select2_b"+subj_line+"' value='"+room+"' required style='width:100%' name='room_"+subj_line+"'><option value='TBA' selected>TBA</option>";
    else
        
        rooms_sel+= "<select class='form-select2_b"+subj_line+"' value='"+room+"' required style='width:100%' name='room_"+subj_line+"'><option value='TBA'>TBA</option>";
    for(i=0; i<rooms.length; i++){
        var sel = "";
        if (rooms[i]["ID"] == room)
            sel = "selected";
        rooms_sel+= "<option value='"+rooms[i]["ID"]+"' "+sel+">"+rooms[i]["CODE"]+"</option>";
    }
    rooms_sel+= "</select>";
    $("#subj_line_body").append("<tr id='subj_line_"+ subj_line +"' class='subj_line'><td>"+types+"</td><td>"+days+"<input type='time' class='form-control' value='"+time_s+"' required name='time_s_"+subj_line+"'/>"+
    "</td><td><input type='time' class='form-control' value='"+time_e+"' required name='time_e_"+subj_line+"'/></td><td>"+rooms_sel+"</td><td>"+btn+"</td></tr>");
    $(".form-select2_b"+subj_line).each(function(){
        $(this).select2();
    });
}
function saveFacultyLoading(){
    $("#save_type2").val('getFaculty');
    $.ajax({
        type: "post",
        data: $("#setupForm2").serialize(),
        async: true,   
        dataType: "JSON",  
        success: function(data){
            if(data == "1" || $("#faculty").val() == "" || data == "11"){
                if(data == 11)
                    $.pnotify({
                        title: "Maximum Hours Override",
                        text: "Faculty exceeds maximum hours for load type but load is permitted due to maximum hours override.",
                        type: "info"
                    });
                $("#save_type2").val('saveFaculty');
                $.ajax({
                    type: "post",
                    data: $("#setupForm2").serialize(),
                    async: true,    
                    success: function(data){
                        $.pnotify({
                            title: "Success",
                            text: "Faculty Loading Successfully Saved!",
                            type: "success"
                        });

                        $("#load").trigger('click');
                    }
                });
            }else{
                $.pnotify({
                    title: "Invalid",
                    text: data,
                    type: "error"
                });
            }
        },error: function(){
            Error();
        }
    });
}
function delSubjLine(no){
    $("#subj_line_"+no).remove();
}

//SECTION OFFERING DISSOLVE
function dismissSOS(sos_id){
    $.ajax({
        type: "post",
        data: {"get_enrolled_stud": sos_id},
        success: function(stud){
            //remove first initialization
            //if($.fn.DataTable.fnIsDataTable( $("#enr_table") ))
            //    $('#enr_table').dataTable().fnDestroy();
            $("#dis_sos_id").val(sos_id);
            $("#enr_table").css("width", "100%");
            $("#enr_table_body").html(stud);
            var inputs = [];
            $("#enr_table_body tr").each(function(){
                if($(this).attr("class") == "enr_row_dtl"){
                    var test = $(this).wrap('<div class="wrap-unwrap"></div>');
                    var str = test.parent().html();
                    test.unwrap();
                    inputs.push(str);
                    $(this).remove();
                }
            });
            $("#EnrolledStudModal").modal('show');
            //$('#enr_table').dataTable();
            var i = 0;
            $("#enr_table_body tr").each(function(){
                if($(this).attr("class") != "enr_row_dtl"){
                    $(this).after(inputs[i]);
                }
            });
        },
        error: function(){
            Error();
        }
    });
}

$(document).on('click','#enr_table tbody td img',function () {
    if($(this).attr("type") == "closed"){
        $(".enr_row_dtl[row_no='"+$(this).attr("row_no")+"']").show();
        $(this).attr('src', $(this).attr("close"));
        $(this).attr("type", "open");
    }else{
        $(".enr_row_dtl[row_no='"+$(this).attr("row_no")+"']").hide();
        $(this).attr('src', $(this).attr("open_img"));
        $(this).attr("type", "closed");
    }

});

$("#dismiss_cont").click(function(e){
    e.preventDefault();
    if($("#enrolled_form").valid()){
        $.ajax({
            type: "post",
            data: $("#enrolled_form").serialize(),
            dataType: "JSON",
            success: function(data){
                $("#EnrolledStudModal").modal('hide');
                $("#load").trigger('click');
            },error: function(){
                Error();
            }
        });
    }
});

function changeAmount(student, this_){
    $(".enrolled_amt[student='"+student+"']").prop("checked", $(this_).prop("checked"));
}

function mergeSOS(sos_id){
    $("body").append("<form action='section_offering_merge' method='post' id='mergeForm'><input type='hidden' name='sos_id' value='"+sos_id+"'></form>");
    $("#mergeForm").submit();
}