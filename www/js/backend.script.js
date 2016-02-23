$(function () {
    $('#nestable-menu').on('click', function (e) {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    var formToggle = $(".form-toggle");
    if (formToggle.length) {
        formToggle.each(function () {
            var $this = $(this);
            if (($this.find("input[type!=\"submit\"]:first").length && $this.find("input[type!=\"submit\"]:first").val() !== '') || $this.hasClass('open')) {
                $this.addClass('open');
                $this.children().show();
            }
            else {
                $this.children(":not(legend)").hide();
            }
        });
    }

    formToggle.on("click", "legend", function () {
        var $this = $(this);
        $this.parent().toggleClass('open');
        $this.siblings('').slideToggle(400);

    });

	function hightlight(row, column) {
        $('#assign-students-table tr:eq('+row+')').addClass('active');
        $('#assign-students-table tr:eq(0) td:eq('+column+')').addClass('active'); // <==
        /*$('#assign-students-table tr').each(function(){
            $(this).find('td:eq('+column+')').addClass('active');
        });*/
    }
    function unhighlight(row, column) {
        $('#assign-students-table tr:eq('+row+')').removeClass('active');
        $('#assign-students-table tr:eq(0) td:eq('+column+')').removeClass('active'); // <==
        /*$('#assign-students-table tr').each(function(){
            $(this).find('td:eq('+column+')').removeClass('active');
        });*/
    }


 $("#assign-students-table").on("click", "td", function() {
     var $this = $(this);
     if (!$this.hasClass('nohover') &&((!($this.closest('tr').hasClass('disabled')))||($this.hasClass('assignedst'))))
     {
       var $table = $('#assign-students-table');
       if(!$this.hasClass('assignedst')) {
           $this.addClass('assignedst');
            $this.addClass('hider');
          console.log($this.data('assigned'));
//          var url = $table.data('approve-link');
//        var form = $('<form action="' + url + '" method="post">' +
//            '<input type="text" name="userId" value="' + $this.data('user-id') + '" />' +
//             '<input type="text" name="projectId" value="' + $this.data('project-id') + '" />' +
//             '</form>');
//            $('body').append(form);
//            form.submit();
           $.nette.ajax({
               url: $table.data('approve-link'),
               data: {
                   user_id : $this.data('user-id'),
                   projects_id : $this.data('project-id')
               }
           });
           
       } else {
            $this.removeClass('assignedst');    
            console.log($this.data('assigned'));
           $.nette.ajax({
               url: $table.data('cancel-approve-link'),
               data: {
                   user_id : $this.data('user-id'),
                   projects_id : $this.data('project-id')
               }
           });
       }
   }
   });
   /*on hover podfarbenie tabulky*/
    $(document).ready(function()
        {
             var colCount = 0;
    $('table.scroll tr:nth-child(1) td').each(function () {
        if ($(this).attr('colspan')) {
            colCount += +$(this).attr('colspan');
        } else {
            colCount++;
        }
    });
    
    $("table.scroll").attr('style', 'min-width: '+(((colCount/2)*23)+180+'px !important'));
    //alert(colCount/2);
            
            var cellClassName = false;
            $("table.scroll td, table.scroll th").hover
            (
                    function()
                    {
                            cellClassName = $(this).attr("class").split(' ')[0];
                            if (cellClassName != "nohover"){
                            $("." + cellClassName).addClass("hover");
                        }       
                    },
                    function()
                    {
                           if (cellClassName != "nohover"){
                            $("." + cellClassName).removeClass("hover");
                        }     
                    }
            );
        }); 
   
    $('#assign-students-table input').change(function() {
       var $this = $(this);
       var $table = $('#assign-students-table');
       if($this.prop('checked')) {
           $.nette.ajax({
               url: $table.data('approve-link'),
               data: {
                   userId : $this.data('user-id'),
                   projectId : $this.data('project-id')
               }
           });
       } else {
           $.nette.ajax({
               url: $table.data('cancel-approve-link'),
               data: {
                   userId : $this.data('user-id'),
                   projectId : $this.data('project-id')
               }
           });
       }
    });

   // ================================================================================================

    var offset = 10;

    $('#keep').on('click', function(){
        if ($(this).is(':checked')) {
            $('#assign-students-table tr.disabled, #assign-students-table td.disabled').hide();
        } else {
            $('#assign-students-table tr.disabled, #assign-students-table td.disabled').show();
        }
    });

    $('#zeroApp').on('click', function(){
        if ($(this).is(':checked')) {
            $('#assign-students-table td.col_disabled').hide();
        } else {
            $('#assign-students-table td.col_disabled').show();
        }
    });

    $('#zeroStud').on('click', function(){
        if ($(this).is(':checked')) {
            $('#assign-students-table td.col_disabled_st').hide();
        } else {
            $('#assign-students-table td.col_disabled_st').show();
        }
    });

    $(document).on('click', '.hider', function(){
        var row = $(this).data('row')-1;
        var column = $(this).data('column');
        var size = $('#assign-students-table').find('tr').length;
        var $project = $('#assign-students-table tr:eq(0) td:eq('+column+')');
        var need = $project.data('need');
        var assigned = $('#assign-students-table tr:eq(4) td:eq('+column+') span.assigned').text() * 1;
        var newVal = assigned;

        /* student */
        if ($('#keep').is(':checked')) {
            $('#assign-students-table tr:eq('+row+')').hide();
        }
        if ($(this).hasClass("dis")) {
            $(this).removeClass("dis")
            $(this).removeClass("hider")
            $('#assign-students-table tr:eq('+row+')').removeClass('disabled');
            newVal--;
        } else {
            if ($('#assign-students-table tr:eq('+row+')').hasClass('disabled')) {
                $('#assign-students-table tr:eq('+row+') input').prop('checked', false);
            }
            $(this).addClass("dis")
            $('#assign-students-table tr:eq('+row+')').addClass('disabled');
            newVal++;
        }
        $('#assign-students-table tr:eq(4) td:eq('+column+') span.assigned').text(newVal);

        /* projekt */
        if (need == 1) {
            for (var i = 0; i < size; i++) {
                if (i != column) {
                    $('#assign-students-table tr:eq('+i+') td:eq('+column+')').addClass('disabled');
                }
                if (!$('#keep').is(':checked')) {
                    $('#assign-students-table tr:eq('+i+') td:eq('+column+')').hide();
                }
            }
        }
        if (need > 0) {
            need--;
            $project.data('need', need);
        }
        //unhighlight(row, column);
        $('#tooltip').hide();

        $(document).trigger('triggerProjectChange');

    }).on('mouseover', '.tt', function(e){
        var row = $(this).data('row')-1;
        var column = $(this).data('column');

        //hightlight(row, column);

        var text = "<span>Projekt:</span> " +
            $(this).data('project') +
            "<br><br><span>Študent:</span> " +
            $('#assign-students-table tr:eq('+row+') td:eq(0)').text() +
            "<br><span>Študijný priemer:</span> " +
            $('#assign-students-table tr:eq('+row+') td:eq(0)').data('average');

        $('#tooltip').html(text).css({left:(e.pageX+offset)+"px", top:(e.pageY+offset)+"px"}).show();
    }).on('mouseleave', '.tt', function(){
        var row = $(this).data('row');
        var column = $(this).data('column');

        //unhighlight(row, column);
        $('#tooltip').hide();
    });

    $(document).on('triggerProjectChange', function(){
        $('#assign-students-table tr').each(function(){
            if ($(this).hasClass('disabled')) {
                $(this).find('input').each(function(){
                    if ($(this).hasClass('dis')) {
                        $(this).prop('disabled', false);
                    } else {
                        $(this).prop('disabled', true);
                    }
                });
            } else {
                $(this).find('input').each(function(){
                    $(this).prop('disabled', false);
                });
            }
        });
    });

    $(document).on('mouseover', '.project', function(e){
        var row = $(this).data('row');
        var column = $(this).data('column');
        
        var text = "<span>Projekt:</span> " + $(this).data('project') +
                "<br><br><span>Garant:</span> " + $(this).data('garant')+
                "<br><span>Učitelia:</span> " + $(this).data('teachers');
    
        $('#tooltip').html(text).css({left:(e.pageX+offset)+"px", top:(e.pageY+offset)+"px"}).show();
    }).on('mouseleave', '.project', function(){
        $('#tooltip').hide();
    });

    // ================================================================================================


    $(".delete").on("click", function() {
        return confirm($(this).data("message"));
    });


    $('.grido .actions a,.menu-action').tooltip();

    // webalize
    var nodiac = {
        'á': 'a', 'ä': 'a', 'č': 'c', 'ď': 'd', 'é': 'e', 'ě': 'e', 'í': 'i',
        'ľ': 'l', 'ĺ': 'l', 'ň': 'n', 'ó': 'o', 'ô': 'o','ř': 'r', 'š': 's',
        'ť': 't', 'ú': 'u', 'ů': 'u', 'ý': 'y', 'ž': 'z'
    };

    $.brosland = {
        webalize: function(s) {
            s = s.toLowerCase();
            var s2 = '';

            for(var i = 0; i < s.length; i++) {
                s2 += (typeof nodiac[s.charAt(i)] !== 'undefined' ?
                    nodiac[s.charAt(i)] : s.charAt(i));
            }

            return s2.replace(/[^a-z0-9_]+/g, '-').replace(/^-|-$/g, '');
        }
    };

    $(document).trigger('triggerProjectChange');
});

$(document).ready(function() {

    $('.ing_toggleProjectClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle1').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle1').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });

    $('.ing_toggleDetailsClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(
          function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle2').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle2').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });

    $('.ing_toggleGridStudentsClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle3').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle3').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });

    $('.ing_toggleGridOldStudentsClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle4').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle4').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });

    $('.ing_toggleAssignProjectClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle5').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle5').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });
    
    $('.ing_toggleFileClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle6').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle6').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });
});