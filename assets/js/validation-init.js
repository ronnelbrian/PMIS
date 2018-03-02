var Script = function () {

    $(document).ready(function() {
        // validate signup form on keyup and submit
        //yovi
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        $("#loginform").validate({
            rules: {
               password : "required",
               username : "required",
            },
            messages: {
               password : "Please enter your password",
               username : "Please enter your username",
            }
        });

        // validate signup form on keyup and submit
        $("#setupForm").validate({
            rules: {
                sub_ : "required",
                sched_ : "required",
                sub_code: "required",
                sub_name: "required",
                sub_desc: "required",
                c_units: "required",
                sub_grade: "required",
               
                subject: "required",
                sub_e: "required",
                p_desc : "required",
                p_tf_rate : "required", 
                p_misc_rate : "required", 
                p_other_rate: "required", 
                payment: "required", 
                p_surcharge_rate: "required", 
                p_date_start: "required", 
                p_date_end: "required", 
                p_no : "required",
                yr_lvl : "required",
                yr_lvl_a: "required",
                sycode : "required",
                syname : "required",
                bldgcode : "required",
                bldgname : "required",
                bldgcampus : "required",
                yr_course : "required",
                yr_percentage : "required",
                yr_priority_lvl : "required",
                discount_code : "required",
                discount_name : "required",
                fee_type : "required",
                fee_code : "required",
                fee_name : "required",
                fee_priority : "required",
                ss_sy : "required",
                ss_sem : "required",
                 ss_sem_a : "required",
                ss_code : "required",
                tf_sy: "required",
                tf_rate_type: "required",
                tf_amount: "required",
                rf_amount:"required",
                cf_amount : "required",
                code : "required",
                name : "required",
                address : "required",
                programtypename : "required",
                coursecategoryname : "required",
                collegecode : "required",
                collegename : "required",
                campusSelect : "required",
               
                curriculumcode : "required",
                curriculumname : "required",
                curriculumCourse : "required",
                SYStart : "required",
                selectedSubjects : "required",
                year_level : "required",
                term : "required",
                lec_units : "required",
                lab_units : "required",
                credited_units : "required",
                lec_hr : "required",
                lab_hr : "required",
                tuition_hr : "required",
                academic_type : "required",
                p_desc : "required",

                // 07/20/2014
                fname : "required",
                lname : "required",
                dob : "required",
                pob : "required",
                gender : "required",
                civilstatus : "required",
                nationality : "required",
                res_region : "required",
                res_province : "required",
                res_municipality : "required",
                res_address : "required",
                per_region : "required",
                per_province : "required",
                per_municipality : "required",
                per_address : "required",
                contact : "required",
                campus : "required",
                first_choice : "required",
                second_choice : "required",

                applicanttype : "required",
                hsname : "required",
                hsaddress : "required",
                hsgrad : "required",
                hsgwa : "required",
                dateapplied : "required",

                medexam : "required",
                med_result : "required",


                doctype : "required",
                datesubmitted : "required",

                // 07/20/2014

                //START from YOVI
                ftpt : {
                        required: true,
                        min: 0.0,
                        number: true
                },
                ftreg : {
                        required: true,
                        min: 0.0,
                        number: true
                },
                fttl : {
                        required: true,
                        min: 0.0,
                        number: true
                },
                ftdesc : "required"

                //END FROM YOVI
            
            },
            messages: {
                sub_ : "Please select subject to add.",
                sched_ : "Please select Schedule.",
                sub_code: "Please input subject code.",
                sub_name: "Please input subject name",
                sub_desc: "Please input subject description",
                c_units: "Please input no. of credited units",
                sub_grade: "Please input grade",
                subject: "Please select subject",
                sub_e: "Please equivalent Subject Equivalent.",
                p_desc : "Please input description.",
                p_tf_rate : "Please input tuition fee rate to be paid.", 
                p_misc_rate : "Please input miscellaneous fee rate to be paid.", 
                p_other_rate: "Please input other fee rate to be paid.", 
                payment: "Please input surcharge type.", 
                p_surcharge_rate: "Please input surcharge rate/amount.", 
                p_date_start: "Please input date payment start.", 
                p_date_end: "Please input date payment end.", 
                p_desc : "Please input payment description.",
                p_no : "Please input no. of payment.",
                 yr_lvl : "Please select year level.",
                yr_lvl_a: "Please select year level.",
                sycode : "Plese input SY Code.",
                syname : "Please input SY Description.",
                bldgcode : "Please input Building Code.",
                bldgname : "Please input Building Description.",
                bldgcampus : "Please select campus.",
                yr_course : "Please Select Course",
                yr_percentage : "Please input Percentage.",
                yr_priority_lvl : "Please select Priority Level",
                discount_code : "Please input discount Code",
                discount_name : "Please input discount Description.",
                fee_type : "Please select fee type.",
                fee_code : "Please input fee Code.",
                fee_name : "Please input fee Description.",
                fee_priority : "Please input priority level.",
                ss_sy : "Please select School Year",
                ss_sem : "Please select Semester",
                ss_sem_a : "Please select Semester",
                ss_code : "Please input code",
                tf_sy: "Please Select School Year Semester",
                tf_rate_type: "Please select rate type.",
                tf_amount: "Please input amount",
                rf_amount: "Please input amount",
                cf_amount : "Please input amount",
                name : "Please enter Campus Name",
                address : "Please enter Campus Address",
                programtypename : "Please enter Program Type name",
                coursecategoryname : "Please enter Course Category name",
                collegecode : "Please enter College Code",
                collegename : "Please enter College Name",
                campusSelect : "Please select the Campus for the College",

                curriculumcode : "Please enter Curriculum Code",
                curriculumname : "Please enter Curriculum Name",
                curriculumCourse : "Please select Course for the Curriculum",
                SYStart : "Please select an SY",
                selectedSubjects : "Please select a Subject",
                year_level : "Please select a Year Level",
                term : "Please select a Term",
                lec : "Please enter lecture units",
                units : "Please enter the number of credited units",
                academic_type : "Please enter the number of credited units",
                lec_units : "Please enter the number of Lecture units",
                lab_units : "Please enter the number of Lab units",
                credited_units : "Please enter the number of credited units",
                lec_hr : "Please enter the number of Lecture hours",
                lab_hr : "Please enter the number of Lab hours",
                tuition_hr : "Please enter the number of Tuition hours",

                // 07/20/2014
                fname : "Please enter applicant's first name",
                lname : "Please enter applicant's last name",
                dob : "Please enter applicant's date of birth",
                pob : "Please enter applicant's place of birth",
                gender : "Please select applicant's gender",
                civilstatus : "Please select applicant's civil status",
                nationality : "Please enter applicant's nationality",
                res_region : "Please enter applicant's region",
                res_province : "Please enter the applicant's province",
                res_municipality : "Please enter applicant's municipality",
                res_address : "Please enter applicant's address",
                per_region : "Please enter applicant's region",
                per_province : "Please enter applicant's province",
                per_municipality : "Please enter applicant's municipality",
                per_address : "Please enter applicant's address",
                contact : "Please enter applicant's contact number",
                campus : "Please enter applicant's selected campus",
                first_choice : "Please select applicant's first choice",
                second_choice : "Please select applicant's second choice",

                applicanttype : "Please select applicant's applicant type",
                hsname : "Please enter applicant's High School",
                hsaddress : "Please enter applicant's High School Address",
                hsgwa : "Please enter applicant's High School GWA",
                hsgrad : "Please enter applicant's year of HS graduation",
                dateapplied : "Please enter the date of application",

                doctype : "Please select the document type",
                datesubmitted : "Please enter the date of submission",

                medexam : "Please select the medical exam",
                med_result : "Please select the result",

                // 07/20/2014

                //START FROM YOVI

                ftdesc : "Please enter the type description",
                ftpt : {
                    required: "Please enter max load for part-time",
                    number: "Please enter numeric values only",
                    min: "Enter values greater than or equal to 0"
                },
                fttl : {
                    required: "Please enter max load for temp load",
                    number: "Please enter numeric values only",
                    min: "Enter values greater than or equal to 0"
                },
                ftreg : {
                    required: "Please enter max load for regular",
                    number: "Please enter numeric values only",
                    min: "Enter values greater than or equal to 0"
                }
            },
            errorClass: "error",
            validClass: "valid"
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("red");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("red");
            topicInputs.attr("disabled", !this.checked);
        });

         // validate signup form on keyup and submit
        $("#editForm").validate({
            rules: {
                docnameedit : "required",
                docmandatoryedit: "required",
                docstudtypeedit: "required",
                sycodeedit : "required",
                sydescedit : "required",
                sypresentedit : "required",
                courseedit: "required",
                curredit: "required",
                subedit: "required",
                slotsedit: "required",
                isopenedit: "required",
                dayedit: "required",
                timeinedit: "required",
                timeoutedit: "required",
                syedit: "required",
                semedit: "required",
                sectionedit: "required",

                courseedit: "required",
                sectionnameedit: "required",
                sectioncodeedit: "required",
                yearleveledit: "required",
                campuscode: "required",
                campusname: "required",
                campusnameselect: "required",
                city: "required",
                country: "required",
                departmentcode: "required",
                departmentname: "required",
                college: "required",
                collegecode: "required",
                collegename: "required",
                coursecode: "required",
                coursename: "required",
                roomcode: "required",
                roomname: "required",
                buildingcode: "required",
                buildingname: "required",
                buildingnameselect: "required",

                fixed_amount2: {
                    required: true,
                    min: 0.0,
                    number: true
                },
                otherfeecode: "required",
                otherfeename: "required",
                feetypeselect: "required",
                mandatory: "required",
                prioritylevel: "required",
                year_no: "required",
                months_no: "required",
                semester_no: "required",
                curriculumcode: "required",
                curriculumname: "required",
                course: "required",
                subjectcode: "required",
                subjectname: "required",
                feeid: "required",
                feeid2: "required",
                tuitionfeedescription: "required",
                tuitionfeeamount: {
                    required: true,
                    min: 1
                },
                

                


                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                // password: {
                //     required: true,
                //     minlength: 5
                // },
                // confirm_password: {
                //     required: true,
                //     minlength: 5,
                //     equalTo: "#password"
                // },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                docnameedit : "This field is required.",
                docmandatoryedit: "This field is required.",
                docstudtypeedit: "This field is required.",
                 sycodeedit : "This field is required.",
                sydescedit : "This field is required.",
                sypresentedit : "This field is required.",
                 courseedit: "Please Select Course.",
                curredit: "Please Select Curriculum.",
                subedit: "Please Select Subject.",
                slotsedit: "This field is required.",
                isopenedit: "This field is required.",
                dayedit: "This field is required.",
                timeinedit: "This field is required.",
                timeoutedit: "This field is required.",
                syedit: "This field is required.",
                semedit: "This field is required.",
                sectionedit: "This field is required.",
                sectioncodeedit: "Please enter a section code",
                selectedcourseedit: "Please select a course",
                yearleveledit: "Please select a year level",
                campuscode: "Please enter a campus code",
                campusname: "Please enter a campus name",
                campusnameselect: "Please select a campus",
                city: "Please enter a city",
                country: "Please enter a country",
                departmentcode: "Please enter a department code",
                departmentname: "Please enter a department name",
                college: "Please select a college",
                collegecode: "Please enter a college code",
                collegename: "Please enter a college name",
                coursecode: "Please enter a course code",
                coursename: "Please enter a course name",
                year_no: "Please select the number of years. Select 0 if none.",
                months_no: "Please select the number of months. Select 0 if none.",
                semester_no: "Please select the number of semester. Select 0 if none.",
                roomcode: "Please enter a room code",
                roomname: "Please enter a room name",
                buildingcode: "Please enter a building code",
                buildingname: "Please enter a building name",
                buildingnameselect: "Please select a building",
                fixed_amount2: {
                    required: "Please enter an amount",
                    number: "Please enter numeric values only"
                },
                otherfeecode: "Please enter a fee code",
                otherfeename: "Please enter a fee name",
                feetypeselect: "Please select fee type",
                mandatory: "Please indicate whether the fee is mandatory or not",
                prioritylevel: "Please select the priority level",
                curriculumcode: "Please enter a curriculum code",
                curriculumname: "Please enter a curriculum name",
                course: "Please select a course",
                subjectcode: "Please enter a subject code",
                subjectname: "Please enter a subject name",
                tuitionfeedescription: "Please enter the tuition fee description",
                tuitionfeeamount: {
                    required: "Please enter the tuition fee amount",
                    number: "Please enter numeric values only"
                },
                feeid: "Please select a fee",
                feeid2: "Please select a fee",

                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                // password: {
                //     required: "Please provide a password",
                //     minlength: "Your password must be at least 5 characters long"
                // },
                // confirm_password: {
                //     required: "Please provide a password",
                //     minlength: "Your password must be at least 5 characters long",
                //     equalTo: "Please enter the same password as above"
                // },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("red");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("red");
            topicInputs.attr("disabled", !this.checked);
        });
});
}();